<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speech-Therapy Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
</head>
<body>
    <header class="topnav">
        <div class="topnav__brand">SPEECH-THERAPY DASHBOARD</div>
        <div class="topnav__right">
            <div class="topnav__admin">
                <span class="topnav__avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</span>
                <span>{{ auth()->user()->name ?? 'Admin' }}</span>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="topnav__logout">Log out</button>
            </form>
        </div>
    </header>

    <main class="page">
        <div class="page__header">
            <h1 class="page__title">Welcome <span>{{ auth()->user()->name ?? 'Admin' }}</span> </h1>
        </div>
        <section class="cards">
            <div class="card">
                <div class="card__icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <p class="card__label">Total Patients</p>
                <div class="card__value">{{ number_format($totalPatientsCount) }}</div>
            </div>
            <div class="card">
                <div class="card__icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <p class="card__label">Active Today</p>
                <div class="card__value">{{ number_format($activeTodayCount) }}</div>
            </div>
        </section>

        <div class="tabs" role="tablist">
            <button type="button" class="tab is-active" data-target="panel-all" role="tab" aria-selected="true">ALL</button>
            <button type="button" class="tab" data-target="panel-active" role="tab" aria-selected="false">ACTIVE TODAY</button>
        </div>

        {{-- ALL patients panel --}}
        <section id="panel-all" class="table-panel is-visible">
            <h2 class="table-section__title">All Patients</h2>

            <div class="table-card">
                <table id="patients-table" class="display">
                    <thead>
                        <tr>
                            <th style="width: 70px;">S.No</th>
                            <th>Name</th>
                            <th>ID</th>
                            <th>Phone Number</th>
                            <th>Report</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>

        {{-- ACTIVE TODAY panel --}}
        <section id="panel-active" class="table-panel">
            <h2 class="table-section__title">Active Today</h2>

            <div class="table-card">
                <table id="active-patients-table" class="display">
                    <thead>
                        <tr>
                            <th style="width: 100px;">S.No</th>
                            <th>Name</th>
                            <th>ID</th>
                            <th>Last Login</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>
    </main>

    <!-- datatabels javascript -->
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.min.js') }}"></script>

    <!-- datatable all patient intialisation -->
    <script>
        $(document).ready(function () {

            $('#patients-table').DataTable({
                processing: true,
                serverSide: true,

                ajax: "{{ route('admin.dashboard.patients') }}",

                pageLength: 10,

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
                        name: 'name'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'report',
                        name: 'report',
                        orderable: false,
                        searchable: false
                    }
                ],

                language: {
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

                ajax: "{{ route('admin.dashboard.active-patients') }}",

                pageLength: 10,

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
                        name: 'name'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'last_login',
                        name: 'last_login',
                        searchable: false
                    }
                ],

                language: {
                    emptyTable: "No patients have been active today.",
                    processing: "Loading active patients..."
                }
            });
        }
    </script>

    <!-- Tabs changing functionality -->
    <script>
        (function () {

            var tabs = document.querySelectorAll('.tab');
            var panels = document.querySelectorAll('.table-panel');

            tabs.forEach(function (tab) {

                tab.addEventListener('click', function () {

                    tabs.forEach(function (t) {
                        t.classList.remove('is-active');
                        t.setAttribute('aria-selected', 'false');
                    });

                    panels.forEach(function (p) {
                        p.classList.remove('is-visible');
                    });

                    tab.classList.add('is-active');
                    tab.setAttribute('aria-selected', 'true');

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

                });

            });

        })();
    </script>
</body>
</html>