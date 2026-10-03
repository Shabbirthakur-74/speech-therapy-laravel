<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Your Account - Speech Therapy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:opsz,wght@8..60,500;8..60,600&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #FBFCFE;
            --surface: #F4F8FB;
            --ink: #15202B;
            --muted: #5B6B7C;
            --accent: #208AEF;
            --border: #E2E8F0;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font-family: "IBM Plex Sans", Arial, sans-serif;
            font-size: 16px;
            line-height: 1.65;
        }

        h1, h2, h3 {
            font-family: "Source Serif 4", Georgia, serif;
            font-weight: 600;
            color: var(--ink);
        }

        .label { font-family: "IBM Plex Mono", ui-monospace, monospace; }

        .page {
            max-width: 760px;
            margin: 0 auto;
            padding: 48px 20px 80px;
        }

        header.masthead {
            padding-bottom: 28px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 24px;
        }
        .eyebrow {
            font-family: "IBM Plex Mono", monospace;
            font-size: 12px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--accent);
        }
        header.masthead h1 { font-size: 34px; margin: 6px 0 10px; }
        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            color: var(--muted);
            font-size: 13.5px;
        }
        .meta-row strong { color: var(--ink); font-family: "IBM Plex Mono", monospace; font-weight: 500; }

        section {
            padding-top: 30px;
            border-top: 1px solid var(--border);
        }
        section:first-of-type { border-top: none; padding-top: 0; }
        .section-head { display: flex; align-items: baseline; gap: 10px; margin-bottom: 10px; }
        .section-num { font-family: "IBM Plex Mono", monospace; color: var(--accent); font-size: 14px; }
        h2 { font-size: 21px; margin: 0; }
        p { margin: 0 0 12px; }
        p.lead { color: var(--muted); }
        a { color: var(--accent); }

        table { width: 100%; border-collapse: collapse; margin: 12px 0 18px; font-size: 14px; }
        th, td { text-align: left; padding: 9px 12px; border-bottom: 1px solid var(--border); vertical-align: top; }
        th {
            font-family: "IBM Plex Mono", monospace;
            font-size: 11.5px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 500;
        }
        td.muted { color: var(--muted); }

        .steps { list-style: none; counter-reset: step; padding: 0; margin: 14px 0 18px; }
        .steps li {
            counter-increment: step;
            position: relative;
            padding: 12px 16px 12px 52px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .steps li::before {
            content: counter(step);
            position: absolute;
            left: 16px;
            top: 12px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--accent);
            color: #fff;
            font-family: "IBM Plex Mono", monospace;
            font-size: 13px;
            text-align: center;
            line-height: 24px;
        }

        .btn {
            display: inline-block;
            background: var(--accent);
            color: #fff;
            text-decoration: none;
            padding: 11px 20px;
            border-radius: 8px;
            font-weight: 500;
        }

        .template {
            white-space: pre-wrap;
            font-family: "IBM Plex Mono", monospace;
            font-size: 13.5px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px 16px;
            margin: 12px 0;
        }

        .callout {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px 16px;
            font-size: 14px;
            margin: 14px 0;
        }
        .callout .label {
            display: block;
            font-size: 11px;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 6px;
        }
    </style>
</head>
<body>

<div class="page">

    <header class="masthead">
        <span class="eyebrow">Account &amp; Data Deletion</span>
        <h1>Delete your Speech Therapy account</h1>
        <div class="meta-row">
            <span>App: <strong>Speech Therapy</strong></span>
            <span>Developer: <strong>Dr Noorain Alam</strong></span>
        </div>
    </header>

    <section>
        <div class="section-head"><span class="section-num">01</span><h2>How to request deletion</h2></div>
        <p class="lead">Deletion of your <strong>Speech Therapy</strong> account and its data is handled by email. There is no in-app deletion option.</p>
        <ol class="steps">
            <li>Send an email to <a href="mailto:noorain.apps@gmail.com?subject=Account%20deletion%20request%20-%20Speech%20Therapy%20app">noorain.apps@gmail.com</a> with the subject <strong>Account deletion request &ndash; Speech Therapy app</strong>.</li>
            <li>Include the <strong>full name</strong> and <strong>phone number</strong> you registered with, so we can find and verify your account.</li>
            <li>If the account belongs to a child, the request must come from their parent or guardian.</li>
            <li>We will confirm by email and complete the deletion within <strong>3 business days</strong> of your request.</li>
        </ol>
        <p><a class="btn" href="mailto:noorain.apps@gmail.com?subject=Account%20deletion%20request%20-%20Speech%20Therapy%20app&amp;body=Please%20delete%20my%20Speech%20Therapy%20account%20and%20associated%20data.%0D%0A%0D%0AFull%20name%3A%20%0D%0APhone%20number%3A%20">Email a deletion request</a></p>
        <div class="template">Subject: Account deletion request - Speech Therapy app

Please delete my Speech Therapy account and associated data.

Full name:
Phone number:</div>
    </section>

    <section>
        <div class="section-head"><span class="section-num">02</span><h2>What is deleted</h2></div>
        <table>
            <tr><th>Data</th><th>Result</th></tr>
            <tr><td>Registration details (name, phone number, address, age, gender)</td><td class="muted">Deleted</td></tr>
            <tr><td>Audio recordings from the speech and voice exercises</td><td class="muted">Deleted</td></tr>
            <tr><td>Photos from the Facial Articulation exercise</td><td class="muted">Deleted</td></tr>
            <tr><td>Assessment results and generated clinical reports</td><td class="muted">Deleted</td></tr>
            <tr><td>Login records and session tokens</td><td class="muted">Deleted</td></tr>
        </table>
    </section>

    <section>
        <div class="section-head"><span class="section-num">03</span><h2>What is kept, and for how long</h2></div>
        <table>
            <tr><th>Data</th><th>Why</th><th>Kept for</th></tr>
            <tr><td>Your deletion request email and our reply</td><td class="muted">Record that the request was handled</td><td class="muted">3 years</td></tr>
        </table>
        <p>Nothing else is retained once deletion is complete. If you do not request deletion, we keep your information for 3 years and then delete it. See our <a href="{{ route('privacy-policy') }}">Privacy Policy</a>.</p>
        <div class="callout">
            <span class="label">Note</span>
            Deletion is permanent. Your assessment history and reports cannot be recovered afterwards. If a report has already been shared with a clinician or institution, we cannot delete their copy.
        </div>
    </section>

    <section>
        <div class="section-head"><span class="section-num">04</span><h2>Contact</h2></div>
        <p>
            Dr Noorain Alam <br>
            noorain.apps@gmail.com <br>
            NEW OPD, 4TH FLOOR, SPEECH AND HEARING UNIT, ENT DEPT. PGIMER CHANDIGARH 160012
        </p>
    </section>

</div>

</body>
</html>
