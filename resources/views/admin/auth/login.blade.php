<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login - Speech Therapy</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0F766E;
            --primary-dark: #0B5F58;
            --mint: #5EEAD4;
            --ink: #0F172A;
            --muted: #64748B;
            --line: #E2E8F0;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 0% 0%, rgba(45, 212, 191, 0.18), transparent 40%),
                radial-gradient(circle at 100% 100%, rgba(15, 118, 110, 0.10), transparent 45%),
                #F4F7FA;
            -webkit-font-smoothing: antialiased;
        }

        .login {
            width: 100%;
            max-width: 1080px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-radius: 28px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 30px 70px rgba(15, 23, 42, 0.14);
        }

        /* ---------- Left brand panel ---------- */
        .brand {
            position: relative;
            padding: 48px 48px 36px;
            color: #fff;
            background: linear-gradient(160deg, #0F172A 0%, #0B3B3A 100%);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .brand::after {
            content: "";
            position: absolute;
            left: -80px;
            bottom: -100px;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(45, 212, 191, 0.25), transparent 70%);
            pointer-events: none;
        }

        .brand__top {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand__logo {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            border: 1px solid rgba(94, 234, 212, 0.5);
            background: rgba(94, 234, 212, 0.08);
            color: var(--mint);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand__tag {
            padding: 6px 14px;
            border-radius: 999px;
            border: 1px solid rgba(94, 234, 212, 0.35);
            background: rgba(94, 234, 212, 0.08);
            color: var(--mint);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .brand h1 {
            margin: 40px 0 12px;
            font-size: 30.5px;
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .brand p {
            margin: 0;
            max-width: 380px;
            font-size: 13.5px;
            line-height: 1.6;
            color: #A8B6C8;
        }

        .brand__list {
            margin: 36px 0 0;
            padding: 20px 22px;
            list-style: none;
            border: 1px solid rgba(94, 234, 212, 0.2);
            border-radius: 18px;
            background: rgba(15, 23, 42, 0.55);
            position: relative;
            z-index: 1;
        }

        .brand__list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 12.5px;
            line-height: 1.5;
            color: #E2E8F0;
        }

        .brand__list li + li {
            margin-top: 16px;
        }

        .brand__list svg {
            flex: none;
            margin-top: 2px;
            color: var(--mint);
        }

        .brand__foot {
            margin-top: auto;
            padding-top: 28px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--mint);
            position: relative;
            z-index: 1;
        }

        /* ---------- Right form panel ---------- */
        .panel {
            padding: 64px 56px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--primary);
        }

        .panel h2 {
            margin: 10px 0 6px;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .panel .sub {
            margin: 0 0 30px;
            color: var(--muted);
            font-size: 13.5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #334155;
        }

        .field {
            position: relative;
        }

        .field > svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            pointer-events: none;
        }

        input {
            width: 100%;
            padding: 14px 44px 14px 44px;
            border: 1px solid var(--line);
            border-radius: 14px;
            background: #F8FAFC;
            color: var(--ink);
            font: inherit;
            font-size: 13.5px;
            transition: all 0.2s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.12);
        }

        .toggle {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 10px;
            background: transparent;
            color: #94A3B8;
            cursor: pointer;
        }

        .toggle:hover {
            color: var(--primary);
            background: #EEF2F6;
        }

        .submit {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 8px;
            padding: 15px;
            border: none;
            border-radius: 14px;
            background: var(--primary);
            color: #fff;
            font: inherit;
            font-size: 14.5px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 22px rgba(15, 118, 110, 0.28);
            transition: all 0.2s ease;
        }

        .submit:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .secure {
            margin-top: 26px;
            padding-top: 20px;
            border-top: 1px solid #EEF2F6;
            text-align: center;
            font-size: 11.5px;
            color: var(--muted);
        }

        .error {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            padding: 12px 14px;
            border: 1px solid #FECACA;
            border-radius: 12px;
            background: #FEF2F2;
            color: #B91C1C;
            font-size: 12.5px;
            font-weight: 500;
        }

        @media (max-width: 860px) {
            .login { grid-template-columns: 1fr; max-width: 520px; }
            .brand { padding: 32px 28px 28px; }
            .brand h1 { margin-top: 24px; font-size: 23.5px; }
            .brand__list, .brand__foot { display: none; }
            .panel { padding: 36px 28px 40px; }
        }
    </style>
</head>

<body>

<div class="login">

    <section class="brand">
        <div class="brand__top">
            <span class="brand__logo">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="10" x2="4" y2="14"/><line x1="8" y1="6" x2="8" y2="18"/><line x1="12" y1="3" x2="12" y2="21"/><line x1="16" y1="7" x2="16" y2="17"/><line x1="20" y1="10" x2="20" y2="14"/></svg>
            </span>
            <span class="brand__tag">PGIMER Chandigarh</span>
        </div>

        <h1>Empowering Voices &amp; Clinical Care</h1>
        <p>A unified platform for clinician documentation, patient speech assessments and progress review.</p>

        <ul class="brand__list">
            <li>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Patient speech profiles and assessment tracking
            </li>
            <li>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                Secure clinical records and report access
            </li>
        </ul>

        <div class="brand__foot">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Protected Clinical Portal
        </div>
    </section>

    <section class="panel">
        <span class="eyebrow">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            Secure clinical access
        </span>
        <h2>Admin Sign In</h2>
        <p class="sub">Access patient clinical records</p>

        @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">

            @csrf

            <div class="form-group">
                <label for="email">Email</label>

                <div class="field">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22 6 12 13 2 6"/></svg>
                    <input
                        id="email"
                        type="text"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="username"
                        required
                    >
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <div class="field">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        autocomplete="current-password"
                        required
                    >
                    <button type="button" class="toggle" id="toggle-password" aria-label="Show password">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="submit">
                Sign In to Portal
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>

        </form>

    </section>

</div>

<script>
    document.getElementById('toggle-password').addEventListener('click', function () {
        var input = document.getElementById('password');
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        this.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
    });
</script>

</body>
</html>
