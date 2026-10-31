@extends('admin.layouts.app')

@section('title', 'Clinical Report - ' . $patient->name)

@section('nav')
    <a href="{{ route('admin.dashboard') }}" class="nav-item">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        <span>All Patients</span>
    </a>
    <a href="{{ route('admin.dashboard') }}#active" class="nav-item">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <span>Active Today</span>
    </a>
@endsection

@section('content')
    <nav class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}" class="breadcrumb__back">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            All Patients
        </a>
        <span class="breadcrumb__sep">/</span>
        <span class="breadcrumb__current">{{ $patient->name }}</span>
    </nav>

    <section class="report-header">
        <div class="report-header__top">
            <div>
                <p class="report-header__eyebrow">Patient Details</p>
                <h1 class="report-title">{{ $patient->name }}</h1>
                <span class="report-header__id">Patient ID #{{ $patient->id }}</span>
            </div>
        </div>

        <div class="patient-info">
            <div class="patient-info-item">
                <span class="patient-info-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                <div class="patient-info-text">
                    <span class="patient-info-label">Age</span>
                    <span class="patient-info-value">{{ $patient->age ?? '—' }}</span>
                </div>
            </div>

            <div class="patient-info-item">
                <span class="patient-info-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a6 6 0 0 1 6-6h4a6 6 0 0 1 6 6v1"/></svg></span>
                <div class="patient-info-text">
                    <span class="patient-info-label">Gender</span>
                    <span class="patient-info-value">{{ $patient->gender ?? '—' }}</span>
                </div>
            </div>

            <div class="patient-info-item">
                <span class="patient-info-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
                <div class="patient-info-text">
                    <span class="patient-info-label">Phone</span>
                    <span class="patient-info-value">{{ $patient->phone ?? '—' }}</span>
                </div>
            </div>

            <div class="patient-info-item">
                <span class="patient-info-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></span>
                <div class="patient-info-text">
                    <span class="patient-info-label">Address</span>
                    <span class="patient-info-value">{{ $patient->address ?? '—' }}</span>
                </div>
            </div>
        </div>
    </section>

    <section class="table-card">
        <div class="table-card__head">
            <div>
                <h2 class="table-card__title">Assessment Sessions</h2>
                <p class="table-card__sub">Completed assessment sessions for this patient</p>
            </div>
        </div>

        <table id="sessions-table">
            <thead>
                <tr>
                    <th style="width:80px;">S.No</th>
                    <th>Session</th>
                    <th>Date &amp; Time</th>
                    <th><span class="th-merged">Actions</span></th>
                    <th aria-label="Delete"></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </section>

    {{-- Session results popup --}}
    <div class="results-modal" id="results-modal" hidden role="dialog" aria-modal="true" aria-labelledby="results-title">
        <div class="modal__backdrop" data-close-results></div>
        <div class="results-modal__card">
            <div class="results-header">
                <span class="results-header__icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </span>
                <div class="results-header__text">
                    <h2 class="results-title">
                        <span id="results-title">Assessment Results</span>
                        <span class="results-chip" id="results-date" hidden></span>
                    </h2>
                    <p class="results-subtitle">Patient: {{ $patient->name }}</p>
                </div>
                <button type="button" id="close-results" class="close-results-button" aria-label="Close" data-close-results>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            <div id="results-body" class="results-body">
                <div class="results-loading">Loading results...</div>
            </div>

            <div class="results-footer">
                <span class="results-footer__dot"></span>
                <span id="results-footer-text">Session results</span>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const sessionsTable = $('#sessions-table').DataTable({
                processing:true,
                serverSide:true,
                autoWidth: false,
                ajax:"{{ route('admin.patient.sessions.data', $patient->id) }}",
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                order:[[2,'desc']],
                columns:[
                    {
                        data:'DT_RowIndex',
                        name:'DT_RowIndex',
                        orderable:false,
                        searchable:false
                    },
                    {
                        data:'session',
                        name:'session',
                        orderable:false,
                        render:function(data,type) {
                            return type === 'display'
                                ? '<span class="session-label"><span class="status-dot"></span>' + escapeHtml(data) + '</span>'
                                : data;
                        }
                    },
                    {
                        data:'date_time',
                        name:'session_started_at'
                    },
                    {
                        data:'action',
                        name:'action',
                        orderable:false,
                        searchable:false
                    },
                    {
                        data:'delete',
                        name:'delete',
                        orderable:false,
                        searchable:false
                    }
                ],
                language:{
                    search:'',
                    searchPlaceholder:'Search sessions...',
                    emptyTable:"No assessment sessions available for this patient.",
                    processing:"Loading sessions..."
                }
            });

            $('#sessions-table').on('click','.view-results-button',function() {
                const patientId = $(this).data('patient');
                const sessionId = $(this).data('session');
                loadSessionResults(patientId,sessionId,$(this).data('label'),$(this).data('date'));
            });

            const resultsModal = $('#results-modal');

            function closeResults() {
                resultsModal.prop('hidden',true).removeData('session');
                $('#results-body').html('');
                $('body').css('overflow','');
            }

            $(document).on('click','[data-close-results]',closeResults);

            $(document).on('keydown',function(e) {
                if (e.key === 'Escape' && !resultsModal.prop('hidden')) {
                    closeResults();
                }
            });

            // After a session is deleted: reload the list, close its results if open
            document.addEventListener('admin:deleted',function(e) {
                if (e.detail.kind !== 'session') { return; }

                sessionsTable.ajax.reload(null,false);

                if (resultsModal.data('session') === e.detail.sessionId) {
                    closeResults();
                }
            });

            function loadSessionResults(patientId,sessionId,label,date) {
                const resultsBody = $('#results-body');

                resultsModal.prop('hidden',false).data('session',sessionId);
                $('body').css('overflow','hidden');

                $('#results-title').text('Assessment Results' + (label ? ': ' + label : ''));
                $('#results-date').text(date || '').prop('hidden',!date);
                $('#results-footer-text').text('Session: ' + sessionId);

                resultsBody.html(`
                    <div class="results-loading">
                        Loading assessment results...
                    </div>
                `);
                const url = "{{ url('/admin/patients') }}" +
                    "/" + patientId +
                    "/assessment-results/" + sessionId;

                $.ajax({
                    url:url,
                    method:'GET',
                    dataType:'json',
                    success:function(response) {
                        if (!response.success || !response.results || !response.results.length) {
                            resultsBody.html(`
                                <div class="results-empty">
                                    No assessment results are available for this session.
                                </div>
                            `);
                            return;
                        }

                        $('#results-footer-text').text(
                            response.results.length + ' exercise results · Session: ' + sessionId
                        );

                        let html = '';

                        response.results.forEach(function(result,index) {
                            html += `
                                <div class="assessment-row">
                                    <div class="assessment-name">
                                        Task ${String(index + 1).padStart(2,'0')} &bull; ${escapeHtml(formatLabel(result.assessment_type || 'Assessment'))}
                                    </div>
                                    <div class="assessment-result">
                            `;

                            if (result.result_data && typeof result.result_data === 'object') {
                                const entries = Object.entries(result.result_data);

                                entries.forEach(function([key,value]) {
                                    let displayValue;

                                    if (typeof value === 'object') {
                                        displayValue = JSON.stringify(value);
                                    } else {
                                        displayValue = value ?? '—';
                                    }

                                    html += `
                                        <div class="result-item">
                                            <strong>${escapeHtml(formatLabel(key))}</strong>
                                            ${escapeHtml(String(displayValue))}
                                        </div>
                                    `;
                                });
                            } else {
                                html += `
                                    <div class="result-item">
                                        ${escapeHtml(result.result_data || 'No result available')}
                                    </div>
                                `;
                            }

                            html += `
                                    </div>
                                </div>
                            `;
                        });

                        resultsBody.html(html);
                    },
                    error:function(xhr) {
                        console.error('Failed to load assessment results:',xhr);

                        resultsBody.html(`
                            <div class="results-empty">
                                Unable to load the assessment results. Please try again.
                            </div>
                        `);
                    }
                });
            }

            function formatLabel(value) {
                return String(value)
                    .replace(/_/g,' ')
                    .replace(/\b\w/g,function(letter) {
                        return letter.toUpperCase();
                    });
            }
        });
    </script>
@endpush
