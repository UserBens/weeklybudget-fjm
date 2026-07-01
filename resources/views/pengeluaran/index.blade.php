<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Daftar Rencana Pengeluaran — Weekly Budget</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <style>
        :root {
            --green: #1A7A3C;
            --green2: #22A050;
            --green-light: #E8F5EE;
            --green-mid: rgba(26, 122, 60, 0.12);
            --blue: #2D4B9E;
            --red: #D0021B;
            --amber: #D97706;
            --dark: #1A1D2E;
            --gray: #64748B;
            --gray-light: #94A3B8;
            --border: rgba(0, 0, 0, 0.08);
            --bg: #F5F6FA;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--dark);
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.12);
            border-radius: 4px;
        }

        /* ── SIDEBAR ── */
        #sidebar {
            width: 240px;
            min-width: 240px;
            background: #fff;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow-y: auto;
        }

        /* Topbar dalam sidebar (sama seperti screenshot: logo WB + text) */
        .sb-top {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 16px 18px;
            border-bottom: 1px solid var(--border);
        }

        .sb-logo-badge {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
            color: #fff;
            letter-spacing: 0.05em;
            flex-shrink: 0;
        }

        .sb-app-name {
            font-size: 15px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: -0.01em;
        }

        /* Nav section */
        .sb-nav {
            flex: 1;
            padding: 12px 10px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 10px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.12s;
        }

        .nav-item:hover {
            background: #F5F6FA;
        }

        .nav-item.active {
            background: var(--green);
        }

        .nav-item.active .nav-icon {
            color: #fff;
        }

        .nav-item.active .nav-label {
            color: #fff;
            font-weight: 600;
        }

        .nav-icon {
            width: 16px;
            height: 16px;
            color: var(--gray-light);
            flex-shrink: 0;
        }

        .nav-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--gray);
            line-height: 1;
        }

        .nav-divider {
            height: 1px;
            background: var(--border);
            margin: 8px 0;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            color: var(--gray-light);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 4px 10px 6px;
        }

        .sb-bottom {
            padding: 10px;
            border-top: 1px solid var(--border);
        }

        /* ── TOPBAR ── */
        #topbar {
            height: 54px;
            background: #fff;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 24px;
            flex-shrink: 0;
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--dark);
        }

        .topbar-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 10px 5px 5px;
            border: 1px solid var(--border);
            border-radius: 8px;
            cursor: pointer;
            background: #F9FAFB;
        }

        .topbar-avatar {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            background: var(--green-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            flex-shrink: 0;
        }

        .topbar-user-info {
            line-height: 1.25;
        }

        .topbar-username {
            font-size: 12px;
            font-weight: 600;
            color: var(--dark);
        }

        .topbar-role {
            font-size: 10px;
            color: var(--gray-light);
        }

        /* ── MAIN CONTENT ── */
        #main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        #page-content {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            margin-bottom: 20px;
        }

        .page-header-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .page-eyebrow {
            font-size: 11px;
            font-weight: 600;
            color: var(--gray-light);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: -0.02em;
        }

        .page-subtitle {
            font-size: 13px;
            color: var(--gray-light);
            margin-top: 3px;
        }

        .page-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.12s;
            display: flex;
            align-items: center;
            gap: 6px;
            border: none;
        }

        .btn-outline {
            background: #fff;
            border: 1px solid var(--border);
            color: var(--gray);
        }

        .btn-outline:hover {
            border-color: var(--green);
            color: var(--green);
        }

        .btn-primary {
            background: var(--green);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--green2);
        }

        /* ── STAT CARDS ── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-bottom: 16px;
        }

        .stat-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            cursor: pointer;
            transition: box-shadow 0.15s, transform 0.15s;
        }

        .stat-card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.07);
            transform: translateY(-1px);
        }

        .stat-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .stat-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-light);
        }

        .stat-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-value {
            font-size: 26px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: -0.02em;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-sub {
            font-size: 11px;
            color: var(--gray-light);
        }

        .stat-trend {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 11px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 999px;
            margin-top: 6px;
        }

        .trend-up {
            color: var(--green);
            background: var(--green-light);
        }

        .trend-down {
            color: var(--red);
            background: rgba(208, 2, 27, 0.07);
        }

        .trend-neutral {
            color: var(--amber);
            background: rgba(217, 119, 6, 0.08);
        }

        .sparkline-wrap {
            height: 32px;
            margin-top: 8px;
        }

        /* ── CONTENT GRID ── */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 14px;
        }

        /* ── CARDS ── */
        .card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 18px;
        }

        .card-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--dark);
        }

        .card-sub {
            font-size: 11.5px;
            color: var(--gray-light);
            margin-top: 2px;
        }

        .view-all {
            font-size: 12px;
            font-weight: 600;
            color: var(--green);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            white-space: nowrap;
        }

        /* ── CHART TABS ── */
        .chart-tabs {
            display: flex;
            gap: 4px;
        }

        .chart-tab {
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid var(--border);
            font-size: 11px;
            font-weight: 600;
            color: var(--gray-light);
            cursor: pointer;
            background: #F9FAFB;
            transition: all 0.12s;
        }

        .chart-tab.active {
            background: var(--green);
            color: #fff;
            border-color: var(--green);
        }

        /* ── TABLE ── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            font-size: 10.5px;
            font-weight: 700;
            color: var(--gray-light);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0 10px 10px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .data-table td {
            font-size: 12.5px;
            color: var(--dark);
            padding: 10px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
            vertical-align: middle;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .data-table tr:hover td {
            background: #F9FAFB;
        }

        /* ── STATUS PILLS ── */
        .pill {
            display: inline-flex;
            align-items: center;
            padding: 3px 9px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
        }

        .pill-green {
            background: var(--green-light);
            color: var(--green);
        }

        .pill-amber {
            background: rgba(217, 119, 6, 0.09);
            color: var(--amber);
        }

        .pill-red {
            background: rgba(208, 2, 27, 0.08);
            color: var(--red);
        }

        .pill-blue {
            background: rgba(45, 75, 158, 0.09);
            color: var(--blue);
        }

        .pill-gray {
            background: #F1F5F9;
            color: var(--gray);
        }

        /* ── DONUT ── */
        .donut-wrap {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .donut-canvas-wrap {
            width: 96px;
            height: 96px;
            position: relative;
            flex-shrink: 0;
        }

        .donut-center {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .donut-center-val {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
            line-height: 1;
        }

        .donut-center-lbl {
            font-size: 10px;
            color: var(--gray-light);
            font-weight: 500;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 7px;
        }

        .legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .legend-label {
            font-size: 12px;
            color: var(--gray);
            font-weight: 500;
        }

        .legend-pct {
            margin-left: auto;
            font-size: 12px;
            font-weight: 700;
            color: var(--dark);
        }

        /* ── PROGRESS BARS ── */
        .progress-item {
            margin-bottom: 14px;
        }

        .progress-item:last-child {
            margin-bottom: 0;
        }

        .progress-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .progress-name {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--dark);
        }

        .progress-nums {
            font-size: 11.5px;
            color: var(--gray-light);
        }

        .progress-track {
            height: 6px;
            background: #F1F5F9;
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 999px;
        }

        /* ── ACTIVITY FEED ── */
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 9px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .act-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .act-text {
            font-size: 12px;
            color: var(--dark);
            font-weight: 500;
            line-height: 1.45;
        }

        .act-time {
            font-size: 10.5px;
            color: var(--gray-light);
            margin-top: 2px;
        }

        /* ── RIGHT PANEL ── */
        .right-panel {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        /* ── BUDGET SUMMARY ── */
        .budget-summary {
            background: var(--green);
            border-radius: 12px;
            padding: 16px;
            color: #fff;
        }

        .budget-summary-label {
            font-size: 11px;
            font-weight: 600;
            opacity: 0.75;
            margin-bottom: 4px;
        }

        .budget-summary-val {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.1;
        }

        .budget-summary-sub {
            font-size: 11.5px;
            opacity: 0.7;
            margin-top: 4px;
        }

        .budget-meta {
            display: flex;
            gap: 16px;
            margin-top: 14px;
        }

        .budget-meta-item {
            flex: 1;
        }

        .budget-meta-label {
            font-size: 10px;
            opacity: 0.65;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .budget-meta-val {
            font-size: 14px;
            font-weight: 700;
        }

        .budget-divider {
            width: 1px;
            background: rgba(255, 255, 255, 0.2);
        }

        /* ── WEEK TABS ── */
        .week-tabs {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 4px;
            padding: 4px;
            background: #F1F5F9;
            border-radius: 9px;
            margin-bottom: 14px;
        }

        .week-tab {
            padding: 6px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            color: var(--gray-light);
            text-align: center;
            cursor: pointer;
            transition: all 0.12s;
            border: none;
            background: transparent;
        }

        .week-tab.active {
            background: #fff;
            color: var(--green);
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.07);
        }

        /* ── CATEGORY LIST ── */
        .cat-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        }

        .cat-item:last-child {
            border-bottom: none;
        }

        .cat-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 14px;
        }

        .cat-name {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--dark);
        }

        .cat-type {
            font-size: 10.5px;
            color: var(--gray-light);
        }

        .cat-amount {
            margin-left: auto;
            font-size: 13px;
            font-weight: 700;
            color: var(--dark);
        }

        .cat-amount.minus {
            color: var(--red);
        }

        /* ── TIPE BADGE ── */
        .tipe-bapp {
            background: rgba(45, 75, 158, 0.09);
            color: var(--blue);
        }

        .tipe-um {
            background: var(--green-light);
            color: var(--green);
        }

        @media (max-width: 1200px) {
            body {
                flex-direction: column;
            }

            #sidebar {
                width: 100%;
                min-width: 0;
                height: auto;
                position: relative;
                border-right: none;
                border-bottom: 1px solid var(--border);
            }

            #topbar {
                padding: 0 18px;
            }

            #page-content {
                padding: 24px 20px;
            }

            .form-card,
            .table-wrap,
            .result-header,
            .page-actions {
                margin-bottom: 18px;
            }
        }

        @media (max-width: 768px) {
            #topbar {
                flex-wrap: wrap;
                align-items: flex-start;
                gap: 12px;
                padding: 16px;
                height: auto;
            }

            .topbar-right {
                width: 100%;
                justify-content: space-between;
            }

            .topbar-user {
                width: 100%;
                justify-content: space-between;
                padding: 10px;
            }

            .topbar-username {
                font-size: 12px;
            }

            .topbar-role {
                font-size: 10px;
            }

            .page-header,
            .page-header-top,
            .result-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .page-title {
                font-size: 18px;
            }

            .page-subtitle {
                font-size: 12px;
            }

            .form-row {
                gap: 16px;
            }

            .form-row.cols-2,
            .form-row.cols-3,
            .form-row.cols-4 {
                grid-template-columns: 1fr;
            }

            .table-wrap {
                overflow-x: auto;
            }

            table {
                font-size: 12px;
            }

            th,
            td {
                padding: 10px 12px;
            }

            .week-tabs {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        /* Kustomisasi scrollbar agar tetap elegan */
        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, .12);
            border-radius: 4px;
        }

        /* Toast Styles */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            display: flex;
            align-items: center;
            background-color: #1a7a3c;
            /* Warna FJM Green */
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
    <!-- Konfigurasi Tailwind untuk warna khusus FJM -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        fjm: {
                            green: '#1A7A3C',
                            green2: '#22A050',
                            light: '#E8F5EE',
                            blue: '#2D4B9E',
                            red: '#D0021B',
                            amber: '#D97706',
                            dark: '#1A1D2E',
                            bg: '#F5F6FA',
                            /* Background tetap dipertahankan */
                            border: 'rgba(0, 0, 0, .08)'
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="flex h-screen overflow-hidden bg-fjm-bg">

    <!-- Sidebar -->
    {{-- @include('partial.sidebar') --}}

    <aside id="sidebar">
        <div class="sb-top">
            <div class="sb-logo-badge">WB</div>
            <span class="sb-app-name">Weekly Budget</span>
        </div>

        <nav class="sb-nav">
            <div class="nav-section-label">Menu</div>

            <a class="nav-item {{ request()->routeIs('pengeluaran.*') ? 'active' : '' }}"
                href="{{ route('pengeluaran.index') }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="nav-label">Input Rencana Pengeluaran</span>
            </a>
    </aside>

    <!-- Main Content -->
    <div id="main-content" class="flex-1 flex flex-col overflow-hidden">

        <!-- Topbar -->
        <!-- Topbar -->
        <div id="topbar" class="flex justify-between items-center px-6 py-4 bg-white border-b border-gray-100">

            <!-- KIRI: Logo & Judul -->
            <div class="flex items-center gap-2">
                {{-- <div
                    class="sb-logo-badge w-7 h-7 flex items-center justify-center bg-gray-800 text-white rounded text-[10px]">
                    WB</div> --}}
                <span class="topbar-title font-bold text-gray-700">Input Rencana Pengeluaran</span>
            </div>

            <!-- KANAN: User Profile & Dropdown -->
            <div class="relative">
                <!-- Area Klik (Nama & NIK) -->
                <button onclick="toggleDropdown()"
                    class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 px-3 py-1.5 rounded-lg transition-colors">
                    <div class="text-right">
                        <div class="text-[13px] font-bold text-gray-800 leading-tight">{{ session('name') }}</div>
                        <div class="text-[10px] text-gray-500 uppercase tracking-wide">NIK: {{ session('user_id') }}
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Menu Dropdown -->
                <div id="userDropdown"
                    class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-100 rounded-xl shadow-lg py-1 z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-[13px] text-red-600 hover:bg-red-50 transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content" class="flex-1 overflow-y-auto p-7">

            <!-- Header Halaman -->
            <!-- Header Halaman -->
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <div class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-1">
                        Weekly Budget · PT. Fokus Jasa Mitra
                    </div>
                    <h1 class="text-2xl font-bold mb-1">Daftar Rencana Pengeluaran</h1>
                    <p class="text-[13px] text-gray-500">Tabel berisi data rencana pengeluaran mingguan yang sudah
                        diinput.</p>
                </div>

                <!-- Tombol Tambah -->
                <!-- Tombol Tambah (Di Header Halaman) -->
                <a href="{{ route('pengeluaran.create') }}" style="background-color: rgb(26 122 60);"
                    class="flex items-center gap-2 text-white px-4 py-2.5 rounded-lg text-sm font-semibold hover:opacity-90 transition-opacity shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Rencana
                </a>
            </div>

            <!-- Card Utama -->
            <div class="bg-white border border-fjm-border rounded-xl p-6 shadow-sm">

                <!-- Form Filter -->
                <form method="GET" action="{{ route('pengeluaran.index') }}" class="mb-5">
                    <div class="flex flex-wrap gap-3 items-center">
                        <input type="search" name="q" placeholder="Cari nama, keterangan, dokumen..."
                            class="px-3 py-2 border border-gray-300 rounded-lg text-[13px] focus:outline-none focus:ring-1 focus:ring-fjm-green focus:border-fjm-green flex-1 min-w-[220px]"
                            value="{{ request('q') }}" />

                        <select name="kategori"
                            class="px-3 py-2 border border-gray-300 rounded-lg text-[13px] focus:outline-none focus:ring-1 focus:ring-fjm-green focus:border-fjm-green bg-white">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoriList as $kat)
                                <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                                    {{ $kat }}</option>
                            @endforeach
                        </select>

                        <select name="bulan"
                            class="px-3 py-2 border border-gray-300 rounded-lg text-[13px] focus:outline-none focus:ring-1 focus:ring-fjm-green focus:border-fjm-green bg-white">
                            <option value="">Semua Bulan</option>
                            @foreach (range(1, 12) as $b)
                                @php $nama = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'][$b]; @endphp
                                <option value="{{ $b }}"
                                    {{ (string) request('bulan') === (string) $b ? 'selected' : '' }}>
                                    {{ $nama }}</option>
                            @endforeach
                        </select>

                        <select name="minggu"
                            class="px-3 py-2 border border-gray-300 rounded-lg text-[13px] focus:outline-none focus:ring-1 focus:ring-fjm-green focus:border-fjm-green bg-white">
                            <option value="">Semua Minggu</option>
                            @foreach ([1, 2, 3, 4] as $m)
                                <option value="{{ $m }}"
                                    {{ (string) request('minggu') === (string) $m ? 'selected' : '' }}>Minggu
                                    {{ $m }}</option>
                            @endforeach
                        </select>

                        <select name="tipe"
                            class="px-3 py-2 border border-gray-300 rounded-lg text-[13px] focus:outline-none focus:ring-1 focus:ring-fjm-green focus:border-fjm-green bg-white">
                            <option value="">Semua Tipe</option>
                            <option value="BAPP" {{ request('tipe') == 'BAPP' ? 'selected' : '' }}>BAPP</option>
                            <option value="Uang Muka" {{ request('tipe') == 'Uang Muka' ? 'selected' : '' }}>Uang Muka
                            </option>
                        </select>

                        <select name="per_page"
                            class="px-3 py-2 border border-gray-300 rounded-lg text-[13px] focus:outline-none focus:ring-1 focus:ring-fjm-green focus:border-fjm-green bg-white">
                            @foreach ([5, 10, 20, 50] as $n)
                                <option value="{{ $n }}"
                                    {{ (int) request('per_page', 10) === $n ? 'selected' : '' }}>{{ $n }} /
                                    halaman</option>
                            @endforeach
                        </select>

                        <div class="flex gap-2">
                            <button type="submit"
                                class="px-4 py-2 bg-fjm-green text-white font-medium rounded-lg text-[13px] hover:bg-fjm-green2 transition-colors">
                                Terapkan
                            </button>
                            <a href="{{ route('pengeluaran.index') }}"
                                class="px-4 py-2 border border-gray-300 text-gray-700 bg-white font-medium rounded-lg text-[13px] hover:bg-gray-50 transition-colors">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Tabel Data -->
                <div class="overflow-x-auto border border-gray-100 rounded-lg">
                    <table class="w-full text-[13px] text-left border-collapse">
                        <thead class="bg-slate-50 text-slate-500">
                            <tr>
                                <th class="px-4 py-3 font-semibold border-b border-gray-100">Tanggal</th>
                                <th class="px-4 py-3 font-semibold border-b border-gray-100">Kategori</th>
                                <th class="px-4 py-3 font-semibold border-b border-gray-100">Tipe</th>
                                <th class="px-4 py-3 font-semibold border-b border-gray-100">Dibayarkan Kepada</th>
                                <th class="px-4 py-3 font-semibold border-b border-gray-100">Keterangan</th>
                                <th class="px-4 py-3 font-semibold border-b border-gray-100 text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($pengeluarans ?? collect() as $item)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-fjm-dark">
                                            {{ optional($item->tanggal_input)->format('d M Y') ?? '-' }}</div>
                                        <div class="text-[11px] text-gray-400 mt-0.5">Minggu {{ $item->minggu }} ·
                                            {{ $item->nama_bulan }}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-[11px] font-medium">{{ $item->kategori }}</span>
                                    </td>
                                    <td class="px-4 py-3">{{ $item->tipe }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $item->dibayarkan_kepada }}</td>
                                    <td class="px-4 py-3 max-w-xs truncate text-gray-600"
                                        title="{{ $item->keterangan }}">{{ $item->keterangan ?: '-' }}</td>
                                    <td class="px-4 py-3 text-right font-bold text-fjm-dark">
                                        {{ $item->nominal_format }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-gray-400">
                                        Belum ada data rencana pengeluaran untuk kriteria ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginasi -->
                <div class="flex items-center justify-between mt-5">
                    <div class="text-[13px] text-gray-500">
                        Menampilkan <span
                            class="font-medium text-fjm-dark">{{ $pengeluarans->firstItem() ?? 0 }}</span> -
                        <span class="font-medium text-fjm-dark">{{ $pengeluarans->lastItem() ?? 0 }}</span> dari
                        <span class="font-medium text-fjm-dark">{{ $pengeluarans->total() ?? 0 }}</span> data
                    </div>

                    <div class="flex gap-1">
                        <!-- Prev Button -->
                        @if ($pengeluarans->onFirstPage())
                            <button
                                class="px-3 py-1.5 border border-gray-200 rounded-md text-[13px] text-gray-400 bg-gray-50 cursor-not-allowed"
                                disabled>Prev</button>
                        @else
                            <a href="{{ $pengeluarans->previousPageUrl() }}"
                                class="px-3 py-1.5 border border-gray-300 rounded-md text-[13px] hover:bg-gray-50 transition-colors">Prev</a>
                        @endif

                        <!-- Page Numbers -->
                        @foreach (range(1, $pengeluarans->lastPage()) as $p)
                            @if ($p == $pengeluarans->currentPage())
                                <span
                                    class="px-3 py-1.5 bg-fjm-green text-white border border-fjm-green rounded-md text-[13px] font-semibold">{{ $p }}</span>
                            @else
                                <a href="{{ $pengeluarans->url($p) }}"
                                    class="px-3 py-1.5 border border-gray-300 rounded-md text-[13px] hover:bg-gray-50 transition-colors">{{ $p }}</a>
                            @endif
                        @endforeach

                        <!-- Next Button -->
                        @if ($pengeluarans->hasMorePages())
                            <a href="{{ $pengeluarans->nextPageUrl() }}"
                                class="px-3 py-1.5 border border-gray-300 rounded-md text-[13px] hover:bg-gray-50 transition-colors">Next</a>
                        @else
                            <button
                                class="px-3 py-1.5 border border-gray-200 rounded-md text-[13px] text-gray-400 bg-gray-50 cursor-not-allowed"
                                disabled>Next</button>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Toast Notifikasi -->
    @if (session('success'))
        <div id="toast" class="toast-container">
            <div class="toast">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        </div>

        <script>
            // Menghilangkan toast otomatis setelah 3 detik
            setTimeout(function() {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.style.transition = 'opacity 0.5s ease';
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }
            }, 3000);
        </script>
    @endif

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Menutup dropdown jika user klik di luar area
        window.onclick = function(event) {
            if (!event.target.matches('button') && !event.target.closest('.relative')) {
                const dropdown = document.getElementById('userDropdown');
                if (!dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                }
            }
        }
    </script>
</body>

</html>
