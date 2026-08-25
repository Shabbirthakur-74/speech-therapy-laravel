<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinical Report - {{ $patient->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/report.css') }}">
</head>

<body>
    <header class="topnav">
        <div class="topnav__brand">Clinical Report</div>
        <a href="{{ url()->previous() }}" class="back-button">← Back</a>
    </header>

    <main class="page">
        <section class="report-header">
            <h1 class="report-title">Patient Details</h1>

            <div class="patient-info">
                <div class="patient-info-item">
                    <span class="patient-info-label">Name:</span>
                    <span class="patient-info-value">{{ $patient->name }}</span>
                </div>

                <div class="patient-info-item">
                    <span class="patient-info-label">Age:</span>
                    <span class="patient-info-value">{{ $patient->age ?? '—' }}</span>
                </div>

                <div class="patient-info-item">
                    <span class="patient-info-label">Gender:</span>
                    <span class="patient-info-value">{{ $patient->gender ?? '—' }}</span>
                </div>

                <div class="patient-info-item">
                    <span class="patient-info-label">Address:</span>
                    <span class="patient-info-value">{{ $patient->address ?? '—' }}</span>
                </div>

                <div class="patient-info-item">
                    <span class="patient-info-label">Phone:</span>
                    <span class="patient-info-value">{{ $patient->phone ?? '—' }}</span>
                </div>
            </div>
        </section>

        <section>
            <h2 class="section-title">Assessment Sessions</h2>

            <div class="table-card">
                <table id="sessions-table">
                    <thead>
                        <tr>
                            <th style="width:80px;">S.No</th>
                            <th>Session</th>
                            <th>Date &amp; Time</th>
                            <th style="width:150px;">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </section>

        <section id="results-section" class="results-section">
            <div class="results-header">
                <div>
                    <h2 class="results-title" id="results-title">Assessment Results</h2>
                    <p class="results-subtitle" id="results-subtitle">Selected session results</p>
                </div>

                <button type="button" id="close-results" class="close-results-button">Close</button>
            </div>

            <div id="results-body" class="results-body">
                <div class="results-loading">Loading results...</div>
            </div>
        </section>
    </main>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            const sessionsTable = $('#sessions-table').DataTable({
                processing:true,
                serverSide:true,
                ajax:"{{ route('admin.patient.sessions.data', $patient->id) }}",
                pageLength:10,
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
                        orderable:false
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
                    }
                ],
                language:{
                    emptyTable:"No assessment sessions available for this patient.",
                    processing:"Loading sessions..."
                }
            });

            $('#sessions-table').on('click','.view-results-button',function() {
                const patientId = $(this).data('patient');
                const sessionId = $(this).data('session');
                loadSessionResults(patientId,sessionId);
            });

            $('#close-results').on('click',function() {
                $('#results-section').removeClass('is-visible');
                $('#results-body').html('');

                $('html, body').animate({
                    scrollTop:$('#sessions-table').offset().top - 100
                },300);
            });

            function loadSessionResults(patientId,sessionId) {
                const resultsSection = $('#results-section');
                const resultsBody = $('#results-body');

                resultsSection.addClass('is-visible');

                resultsBody.html(`
                    <div class="results-loading">
                        Loading assessment results...
                    </div>
                `);

                $('html, body').animate({
                    scrollTop:resultsSection.offset().top - 100
                },300);

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

                        const firstResult = response.results[0];

                        $('#results-title').text('Assessment Results');
                        $('#results-subtitle').text('Session: ' + sessionId);

                        let html = '';

                        response.results.forEach(function(result) {
                            html += `
                                <div class="assessment-row">
                                    <div class="assessment-name">
                                        ${escapeHtml(result.assessment_type || 'Assessment')}
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
                                            <strong>${escapeHtml(formatLabel(key))}:</strong>
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

            function escapeHtml(value) {
                return String(value)
                    .replace(/&/g,'&amp;')
                    .replace(/</g,'&lt;')
                    .replace(/>/g,'&gt;')
                    .replace(/"/g,'&quot;')
                    .replace(/'/g,'&#039;');
            }
        });
    </script>
</body>
</html>