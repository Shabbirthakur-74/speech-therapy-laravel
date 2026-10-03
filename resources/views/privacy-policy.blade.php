<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Speech Therapy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:opsz,wght@8..60,500;8..60,600&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #FBFCFE;
            --surface: #F4F8FB;
            --ink: #15202B;
            --muted: #5B6B7C;
            --accent: #208AEF;
            --flag-bg: #FCF1E1;
            --flag-ink: #8A4B06;
            --flag-border: #ECC98C;
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

        .mono, .label { font-family: "IBM Plex Mono", ui-monospace, monospace; }

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

        .draft-banner {
            background: var(--flag-bg);
            border: 1px solid var(--flag-border);
            color: var(--flag-ink);
            border-radius: 10px;
            padding: 18px 20px;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 32px;
        }
        .draft-banner strong { font-family: "IBM Plex Mono", monospace; }
        .draft-banner ul { margin: 10px 0 0; padding-left: 20px; }
        .draft-banner li { margin-bottom: 4px; }

        section {
            padding-top: 30px;
            border-top: 1px solid var(--border);
        }
        section:first-of-type { border-top: none; padding-top: 0; }
        .section-head { display: flex; align-items: baseline; gap: 10px; margin-bottom: 10px; }
        .section-num { font-family: "IBM Plex Mono", monospace; color: var(--accent); font-size: 14px; }
        h2 { font-size: 21px; margin: 0; }
        h3 { font-size: 16px; margin: 20px 0 8px; }
        p { margin: 0 0 12px; }
        p.lead { color: var(--muted); }
        ul { margin: 0 0 12px; padding-left: 22px; }
        li { margin-bottom: 6px; }

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

        footer.doc-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="page">

    <header class="masthead">
        <span class="eyebrow">Privacy Policy &mdash; Draft</span>
        <h1>Speech Therapy App</h1>
        <div class="meta-row">
            <span>Last updated: <strong>[30/09/2026]</strong></span>
            <span>Applies to: <strong>Speech Therapy mobile app (Android)</strong></span>
        </div>
    </header>

    <section>
        <div class="section-head"><span class="section-num">01</span><h2>Who we are</h2></div>
        <p class="lead">This policy explains what the Speech Therapy app collects, why, and how it's handled.</p>
        <p>The Speech Therapy app is operated by Dr Noorain Alam, NEW OPD,4TH FLOOR, SPEECH AND HEARING UNIT, ENT DEPT. PGIMER CHANDIGARH 160012. This policy covers the mobile app and the backend services it talks to.</p>
    </section>

    <section>
        <div class="section-head"><span class="section-num">02</span><h2>Information we collect</h2></div>

        <h3>Registration details</h3>
        <p>When you register in the app, we collect:</p>
        <table>
            <tr><th>Field</th><th>Why</th></tr>
            <tr><td>Full name</td><td class="muted">Identifies your records and clinical report</td></tr>
            <tr><td>Phone number</td><td class="muted">Unique identifier; prevents duplicate registrations</td></tr>
            <tr><td>Address</td><td class="muted">Recorded as part of the patient record</td></tr>
            <tr><td>Age</td><td class="muted">Used to interpret assessment results appropriately</td></tr>
            <tr><td>Gender</td><td class="muted">Used to interpret assessment results appropriately</td></tr>
        </table>

        <h3>Assessment recordings</h3>
        <p>The app guides you through a set of speech and voice exercises. During these, we record:</p>
        <ul>
            <li><strong>Audio recordings</strong> &mdash; captured during the Voice Task, Counting, Sustained Phonation, Resonatory Control, and Prosody Reading exercises, and analyzed for clinical measurements (such as pitch, loudness, and reading rate).</li>
            <li><strong>Photos</strong> &mdash; captured during the Facial Articulation exercise, and analyzed for facial movement measurements.</li>
        </ul>

        <div class="callout">
            <span class="label">Note</span>
            These recordings are health-related data used specifically to generate your clinical assessment report. They are not used for any purpose beyond that assessment.
        </div>
    </section>

    <section>
        <div class="section-head"><span class="section-num">03</span><h2>How we use your information</h2></div>
        <p>We use the information above only to:</p>
        <ul>
            <li>Run the speech, voice, and articulation assessment exercises</li>
            <li>Generate your clinical report</li>
            <li>Support the clinician or institution administering your assessment</li>
        </ul>
        <p>We do not use your information for advertising, and the app does not include any third-party advertising or analytics software.</p>
    </section>

    <section>
        <div class="section-head"><span class="section-num">04</span><h2>Storage &amp; security</h2></div>
        <p>Your information is transmitted to and stored on servers that we operate. We take reasonable steps to protect it, including:</p>
        <ul>
            <li>Transmitting data over an encrypted (HTTPS) connection.</li>
            <li>Restricting access to stored data to authorized personnel.</li>
        </ul>
        <p>We retain your information for 3 Years, after which it is deleted.</p>
    </section>

    <section>
        <div class="section-head"><span class="section-num">05</span><h2>Who we share it with</h2></div>
        <p>We do not sell your information, and we do not share it with advertisers.</p>
        <p>We may share your information with:</p>
        <ul>
            <li>The clinician or institution administering your assessment Dr Noorain Alam </li>
            <li>Service providers who host our servers, under terms that require them to protect your data Hostinger</li>
        </ul>
    </section>

    <section>
        <div class="section-head"><span class="section-num">06</span><h2>Your choices &amp; rights</h2></div>
        <p>You can ask us to access, correct, or delete your information at any time by contacting us at noorain.apps@gmail.com . We will respond to deletion requests within 3 Business Days.</p>
        <div class="callout">
            <span class="label">Current process</span>
            Deletion requests are currently handled manually by our team rather than through an in-app control. 
        </div>
    </section>

    <section>
        <div class="section-head"><span class="section-num">07</span><h2>Children's privacy</h2></div>
        <p>This app could be used by minors. Any Permissions and consent will be taken from parents or guardians.</p>
    </section>

    <section>
        <div class="section-head"><span class="section-num">08</span><h2>Device permissions</h2></div>
        <p>The app requests the following device permissions, only to run the assessment exercises:</p>
        <table>
            <tr><th>Permission</th><th>Used for</th></tr>
            <tr><td>Microphone</td><td class="muted">Recording your voice during speech and voice exercises</td></tr>
            <tr><td>Camera</td><td class="muted">Capturing a photo during the Facial Articulation exercise</td></tr>
        </table>
        <p>You can review or revoke these permissions at any time in your device's system settings. Revoking a permission will prevent the related exercise from working.</p>
    </section>

    <section>
        <div class="section-head"><span class="section-num">09</span><h2>Changes to this policy</h2></div>
        <p>We may update this policy from time to time. We'll update the "Last updated" date above when we do. If changes are significant, we'll let you know through the app.</p>
    </section>

    <section>
        <div class="section-head"><span class="section-num">10</span><h2>Contact us</h2></div>
        <p>Questions about this policy or your data can be sent to:</p>
        <p>
            Dr Noorain Alam <br>
            noorain.apps@gmail.com <br>
            NEW OPD,4TH FLOOR, SPEECH AND HEARING UNIT, ENT DEPT. PGIMER CHANDIGARH 160012
        </p>
    </section>

</div>

</body>
</html>
