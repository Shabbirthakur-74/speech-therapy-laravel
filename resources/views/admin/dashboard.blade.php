@extends('admin.layouts.app')

@section('title', 'Speech-Therapy Dashboard')

@section('nav')
    <button type="button" class="nav-item is-active" data-target="panel-all">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        <span>All Patients</span>
        <span class="nav-badge" data-count="total">{{ number_format($totalPatientsCount) }}</span>
    </button>
    <button type="button" class="nav-item" data-target="panel-active">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <span>Active Today</span>
        <span class="nav-badge" data-count="active">{{ number_format($activeTodayCount) }}</span>
    </button>
@endsection

@section('content')
    <section class="hero">
        <span class="chip chip--dark">
            <span class="chip__dot"></span>
            PGIMER Chandigarh &bull; Speech and Hearing Unit
        </span>
        <h1 class="hero__title">Welcome back, {{ auth()->user()->name ?? 'Admin' }} <span class="hero__wave">&#128075;</span></h1>
        <p class="hero__text">Review registered patients, their assessment sessions and clinical reports.</p>
    </section>

    <section class="cards">
        <div class="card">
            <div class="card__icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="card__body">
                <p class="card__label">Total Registered Patients</p>
                <p class="card__hint">Patients enrolled through the app</p>
                <div class="card__value" data-count="total">{{ number_format($totalPatientsCount) }}</div>
            </div>
        </div>
        <div class="card">
            <div class="card__icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="card__body">
                <p class="card__label">Active Today</p>
                <p class="card__hint">Patients who logged in today</p>
                <div class="card__value" data-count="active">{{ number_format($activeTodayCount) }}</div>
            </div>
        </div>
    </section>

    {{-- ALL patients panel --}}
    <section id="panel-all" class="table-panel is-visible">
        <div class="table-card">
            <div class="table-card__head">
                <h2 class="table-card__title">All Patients</h2>
            </div>
            <table id="patients-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">S.No</th>
                        <th>Patient Name</th>
                        <th>Patient ID</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </section>

    {{-- ACTIVE TODAY panel --}}
    <section id="panel-active" class="table-panel">
        <div class="table-card">
            <div class="table-card__head">
                <h2 class="table-card__title">Active Today</h2>
            </div>
            <table id="active-patients-table">
                <thead>
                    <tr>
                        <th style="width: 100px;">S.No</th>
                        <th>Patient Name</th>
                        <th>Patient ID</th>
                        <th>Last Login</th>
                    </tr>
                </thead>
            </table>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        var patientsUrl = "{{ route('admin.dashboard.patients') }}";
        var activePatientsUrl = "{{ route('admin.dashboard.active-patients') }}";

        function renderPatientName(name, row) {
            var parts = String(name || '').trim().split(/\s+/);
            var initials = (parts[0] ? parts[0][0] : '') + (parts[1] ? parts[1][0] : '');

            return '<div class="person">' +
                '<span class="avatar avatar--c' + (Number(row.id) % 5) + '">' + escapeHtml(initials.toUpperCase()) + '</span>' +
                '<span class="person__name">' + escapeHtml(name) + '</span>' +
                '</div>';
        }

        function renderPatientId(id) {
            return '<span class="id-pill">#' + escapeHtml(id) + '</span>';
        }

        function renderPhone(phone) {
            return '<span class="phone">' +
                '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>' +
                escapeHtml(phone || '—') +
                '</span>';
        }
    </script>

    <!-- datatable all patient intialisation -->
    <script>
        var patientsTable;

        $(document).ready(function () {

            patientsTable = $('#patients-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,

                ajax: patientsUrl,

                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],

                order: [
                    [1, 'asc']
                ],

                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function (data, type, row) {
                            return type === 'display' ? renderPatientName(data, row) : data;
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function (data, type) {
                            return type === 'display' ? renderPatientId(data) : data;
                        }
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        render: function (data, type) {
                            return type === 'display' ? renderPhone(data) : data;
                        }
                    },
                    {
                        data: 'report',
                        name: 'report',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'delete',
                        name: 'delete',
                        orderable: false,
                        searchable: false
                    }
                ],

                language: {
                    search: '',
                    searchPlaceholder: 'Search by patient name, ID or phone...',
                    emptyTable: "No patients registered yet.",
                    processing: "Loading patients..."
                }
            });

        });
    </script>

    <!-- active patients datatable intialisation -->
    <script>
        let activePatientsTable = null;

        function initializeActivePatientsTable() {

            if (activePatientsTable !== null) {
                return;
            }

            activePatientsTable = $('#active-patients-table').DataTable({

                processing: true,
                serverSide: true,
                autoWidth: false,

                ajax: activePatientsUrl,

                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],

                order: [
                    [3, 'desc']
                ],

                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        render: function (data, type, row) {
                            return type === 'display' ? renderPatientName(data, row) : data;
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function (data, type) {
                            return type === 'display' ? renderPatientId(data) : data;
                        }
                    },
                    {
                        data: 'last_login',
                        name: 'last_login',
                        searchable: false
                    }
                ],

                language: {
                    search: '',
                    searchPlaceholder: 'Search by patient name or ID...',
                    emptyTable: "No patients have been active today.",
                    processing: "Loading active patients..."
                }
            });
        }
    </script>

    <!-- Sidebar navigation (switches between the two tables) -->
    <script>
        (function () {

            var tabs = document.querySelectorAll('.nav-item[data-target]');
            var panels = document.querySelectorAll('.table-panel');

            function openPanel(tab) {

                tabs.forEach(function (t) {
                    t.classList.remove('is-active');
                });

                panels.forEach(function (p) {
                    p.classList.remove('is-visible');
                });

                tab.classList.add('is-active');

                var target = document.getElementById(
                    tab.dataset.target
                );

                target.classList.add('is-visible');

                /*
                * Initialize Active Today DataTable
                * only when the tab is opened.
                */
                if (tab.dataset.target === 'panel-active') {

                    initializeActivePatientsTable();

                    /*
                    * DataTables needs a resize calculation
                    * when initialized inside a hidden panel.
                    */
                    if (activePatientsTable !== null) {
                        activePatientsTable.columns.adjust();
                    }
                }
            }

            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    openPanel(tab);
                });
            });

            // Deep link from other pages: /admin/dashboard#active
            if (window.location.hash === '#active') {
                openPanel(document.querySelector('.nav-item[data-target="panel-active"]'));
            }

        })();
    </script>

    <!-- After a delete: reload tables and refresh the counters -->
    <script>
        function setCount(key, value) {
            document.querySelectorAll('[data-count="' + key + '"]').forEach(function (el) {
                el.textContent = Number(value).toLocaleString();
            });
        }

        function refreshCounts() {
            $.getJSON(patientsUrl, { draw: 1, start: 0, length: 1 }, function (json) {
                setCount('total', json.recordsTotal);
            });
            $.getJSON(activePatientsUrl, { draw: 1, start: 0, length: 1 }, function (json) {
                setCount('active', json.recordsTotal);
            });
        }

        document.addEventListener('admin:deleted', function (e) {
            if (e.detail.kind !== 'patient') { return; }

            patientsTable.ajax.reload(null, false);

            if (activePatientsTable !== null) {
                activePatientsTable.ajax.reload(null, false);
            }

            refreshCounts();
        });
    </script>
@endpush
