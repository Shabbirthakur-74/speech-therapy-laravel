<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Speech-Therapy Dashboard')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
@php
    $admin = auth()->user();
    $adminName = $admin->name ?? 'Admin';
    $adminInitials = strtoupper(mb_substr($adminName, 0, 1)) . strtoupper(mb_substr(trim(strstr($adminName . ' ', ' ')) ?: '', 0, 1));
@endphp

<div class="app">
    <aside class="sidebar" id="sidebar">
        <div class="sidebar__brand">
            <span class="sidebar__logo">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="10" x2="4" y2="14"/><line x1="8" y1="6" x2="8" y2="18"/><line x1="12" y1="3" x2="12" y2="21"/><line x1="16" y1="7" x2="16" y2="17"/><line x1="20" y1="10" x2="20" y2="14"/></svg>
            </span>
            <div>
                <div class="sidebar__title">Speech Therapy</div>
                <div class="sidebar__subtitle">PGIMER Chandigarh</div>
            </div>
        </div>

        <nav class="sidebar__nav">
            <p class="sidebar__label">Clinical Roster</p>
            @yield('nav')
        </nav>

        <div class="sidebar__footer">
            <div class="sidebar__admin">
                <span class="avatar avatar--lg">{{ $adminInitials }}</span>
                <div class="sidebar__admin-text">
                    <div class="sidebar__admin-name">{{ $adminName }}</div>
                    <div class="sidebar__admin-role">{{ $admin->email ?? 'Administrator' }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="sidebar__signout">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>
    <div class="sidebar-backdrop" id="sidebar-backdrop"></div>

    <div class="app__main">
        <header class="topbar">
            <div class="topbar__left">
                <button type="button" class="topbar__menu" id="sidebar-toggle" aria-label="Open menu">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
                <span class="chip chip--soft">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/></svg>
                    PGIMER Chandigarh
                </span>
                <span class="topbar__date">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    {{ now()->format('D, d M Y') }}
                </span>
            </div>
            <div class="topbar__admin">
                <div class="topbar__admin-text">
                    <div class="topbar__admin-name">{{ $adminName }}</div>
                    <div class="topbar__admin-role">{{ $admin->email ?? 'Administrator' }}</div>
                </div>
                <span class="avatar avatar--lg">{{ $adminInitials }}</span>
            </div>
        </header>

        <main class="page">
            @yield('content')
        </main>
    </div>
</div>

@include('admin.partials.delete-modal')

<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/dataTables.min.js') }}"></script>
<script>
    // Mobile sidebar toggle
    (function () {
        var sidebar = document.getElementById('sidebar');
        var backdrop = document.getElementById('sidebar-backdrop');
        function setOpen(open) {
            sidebar.classList.toggle('is-open', open);
            backdrop.classList.toggle('is-open', open);
        }
        document.getElementById('sidebar-toggle').addEventListener('click', function () { setOpen(true); });
        backdrop.addEventListener('click', function () { setOpen(false); });
        sidebar.addEventListener('click', function (e) {
            if (e.target.closest('.nav-item')) { setOpen(false); }
        });
    })();

    // Shared helpers for the page scripts
    function escapeHtml(value) {
        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }
</script>
@stack('scripts')
</body>
</html>
