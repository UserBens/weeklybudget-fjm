<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Dashboard — Weekly Budget FJM</title>
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
            overflow: hidden;
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
            font-weight: 600;
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
    </style>
</head>

<body class="flex h-screen overflow-hidden">
    <!-- ══════ SIDEBAR ══════ -->
    @include('partial.sidebar')

    <!-- ══════ MAIN ══════ -->
    <div id="main-content">

        <!-- TOPBAR (sama dengan screenshot: logo WB + nama app di kiri, user info di kanan) -->
        <div id="topbar">
            <div style="display:flex;align-items:center;gap:8px;">
                <div class="sb-logo-badge" style="width:28px;height:28px;font-size:10px;">WB</div>
                <span class="topbar-title">Weekly Budget</span>
            </div>
            <div class="topbar-right">
                <div class="topbar-user">
                    <div class="topbar-avatar">
                        <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="topbar-user-info">
                        <div class="topbar-username">giant123–</div>
                        <div class="topbar-role">User Input Rencana Pengeluaran</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT -->
        <div id="page-content">

            <!-- PAGE HEADER -->
            <div class="page-header">
                <div class="page-header-top">
                    <div>
                        <div class="page-eyebrow">Weekly Budget · PT. Fokus Jasa Mitra</div>
                        <div class="page-title">Dashboard Anggaran</div>
                        <div class="page-subtitle">Pantau rencana dan realisasi pengeluaran mingguan Anda.</div>
                    </div>
                    <div class="page-actions">
                        <button class="btn btn-outline">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Ekspor
                        </button>
                        <button class="btn btn-primary">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Input Pengeluaran
                        </button>
                    </div>
                </div>
            </div>

            <!-- STAT CARDS -->
            <div class="stat-grid">
                <!-- Total Anggaran -->
                <div class="stat-card">
                    <div class="stat-card-top">
                        <span class="stat-label">Total Anggaran</span>
                        <div class="stat-icon" style="background:var(--green-light);">
                            <svg style="width:16px;height:16px;color:var(--green)" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">Rp 48,5 Jt</div>
                    <div class="stat-sub">Minggu ini (Agustus)</div>
                    <span class="stat-trend trend-up">↑ +8% vs minggu lalu</span>
                    <div class="sparkline-wrap"><canvas id="spark1"></canvas></div>
                </div>

                <!-- Realisasi -->
                <div class="stat-card">
                    <div class="stat-card-top">
                        <span class="stat-label">Realisasi</span>
                        <div class="stat-icon" style="background:rgba(45,75,158,0.09);">
                            <svg style="width:16px;height:16px;color:var(--blue)" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">Rp 31,2 Jt</div>
                    <div class="stat-sub">64,3% dari anggaran</div>
                    <span class="stat-trend trend-up">↑ Sesuai rencana</span>
                    <div class="sparkline-wrap"><canvas id="spark2"></canvas></div>
                </div>

                <!-- Uang Muka -->
                <div class="stat-card">
                    <div class="stat-card-top">
                        <span class="stat-label">Uang Muka</span>
                        <div class="stat-icon" style="background:rgba(217,119,6,0.09);">
                            <svg style="width:16px;height:16px;color:var(--amber)" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">Rp 12,7 Jt</div>
                    <div class="stat-sub">7 transaksi UM aktif</div>
                    <span class="stat-trend trend-neutral">⏳ Menunggu SPJ</span>
                    <div class="sparkline-wrap"><canvas id="spark3"></canvas></div>
                </div>

                <!-- Sisa Anggaran -->
                <div class="stat-card">
                    <div class="stat-card-top">
                        <span class="stat-label">Sisa Anggaran</span>
                        <div class="stat-icon" style="background:rgba(208,2,27,0.08);">
                            <svg style="width:16px;height:16px;color:var(--red)" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                            </svg>
                        </div>
                    </div>
                    <div class="stat-value">Rp 17,3 Jt</div>
                    <div class="stat-sub">35,7% belum terpakai</div>
                    <span class="stat-trend trend-down">↓ Perlu segera direalisasi</span>
                    <div class="sparkline-wrap"><canvas id="spark4"></canvas></div>
                </div>
            </div>

            <!-- CONTENT GRID -->
            <div class="content-grid">

                <!-- LEFT: Chart + Tabel -->
                <div style="display:flex;flex-direction:column;gap:14px;">

                    <!-- Area Chart -->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Tren Pengeluaran</div>
                                <div class="card-sub">Rencana vs Realisasi per minggu — Agustus 2026</div>
                            </div>
                            <div class="chart-tabs">
                                <button class="chart-tab active" onclick="setTab(this)">Minggu</button>
                                <button class="chart-tab" onclick="setTab(this)">Bulan</button>
                                <button class="chart-tab" onclick="setTab(this)">Tahun</button>
                            </div>
                        </div>
                        <div style="height:210px;position:relative;">
                            <canvas id="areaChart"></canvas>
                        </div>
                    </div>

                    <!-- Tabel Rencana Pengeluaran Terbaru -->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <div class="card-title">Rencana Pengeluaran Terbaru</div>
                                <div class="card-sub">Minggu 3 — Agustus 2026</div>
                            </div>
                            <button class="view-all">Lihat Semua →</button>
                        </div>

                        <!-- Week selector (mirip design screenshot: tab minggu) -->
                        <div class="week-tabs">
                            <button class="week-tab">Minggu 1</button>
                            <button class="week-tab">Minggu 2</button>
                            <button class="week-tab active">Minggu 3</button>
                            <button class="week-tab">Minggu 4</button>
                        </div>

                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Dibayarkan Kepada</th>
                                    <th>Tipe</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight:600;">Operasional Kantor</td>
                                    <td style="color:var(--gray-light);">PT. Arta Niaga</td>
                                    <td><span class="pill tipe-bapp">BAPP</span></td>
                                    <td style="color:var(--gray-light);">25 Jun 2026</td>
                                    <td style="font-weight:700;">Rp 4.500.000</td>
                                    <td><span class="pill pill-green">Disetujui</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600;">Transportasi</td>
                                    <td style="color:var(--gray-light);">Joko Susanto</td>
                                    <td><span class="pill tipe-um">Uang Muka</span></td>
                                    <td style="color:var(--gray-light);">24 Jun 2026</td>
                                    <td style="font-weight:700;">Rp 1.200.000</td>
                                    <td><span class="pill pill-amber">Menunggu SPJ</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600;">Pemeliharaan</td>
                                    <td style="color:var(--gray-light);">CV Mitra Teknik</td>
                                    <td><span class="pill tipe-bapp">BAPP</span></td>
                                    <td style="color:var(--gray-light);">23 Jun 2026</td>
                                    <td style="font-weight:700;">Rp 8.750.000</td>
                                    <td><span class="pill pill-blue">Diproses</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600;">ATK & Perlengkapan</td>
                                    <td style="color:var(--gray-light);">Toko Sumber Makmur</td>
                                    <td><span class="pill tipe-um">Uang Muka</span></td>
                                    <td style="color:var(--gray-light);">22 Jun 2026</td>
                                    <td style="font-weight:700;">Rp 650.000</td>
                                    <td><span class="pill pill-green">Disetujui</span></td>
                                </tr>
                                <tr>
                                    <td style="font-weight:600;">Konsumsi Rapat</td>
                                    <td style="color:var(--gray-light);">Catering Berkah</td>
                                    <td><span class="pill tipe-bapp">BAPP</span></td>
                                    <td style="color:var(--gray-light);">21 Jun 2026</td>
                                    <td style="font-weight:700;">Rp 2.100.000</td>
                                    <td><span class="pill pill-gray">Draft</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- RIGHT PANEL -->
                <div class="right-panel">

                    <!-- Budget Summary Card (green card) -->
                    <div class="budget-summary">
                        <div class="budget-summary-label">TOTAL ANGGARAN BULAN INI</div>
                        <div class="budget-summary-val">Rp 185.400.000</div>
                        <div class="budget-summary-sub">Agustus 2026 · 4 Minggu</div>
                        <div class="budget-meta">
                            <div class="budget-meta-item">
                                <div class="budget-meta-label">BAPP</div>
                                <div class="budget-meta-val">Rp 112 Jt</div>
                            </div>
                            <div class="budget-divider"></div>
                            <div class="budget-meta-item">
                                <div class="budget-meta-label">Uang Muka</div>
                                <div class="budget-meta-val">Rp 73 Jt</div>
                            </div>
                        </div>
                    </div>

                    <!-- Donut: Distribusi per Tipe -->
                    <div class="card">
                        <div class="card-header" style="margin-bottom:12px;">
                            <div>
                                <div class="card-title">Distribusi Tipe</div>
                                <div class="card-sub">BAPP vs Uang Muka</div>
                            </div>
                        </div>
                        <div class="donut-wrap">
                            <div class="donut-canvas-wrap">
                                <canvas id="donutChart"></canvas>
                                <div class="donut-center">
                                    <div class="donut-center-val">48</div>
                                    <div class="donut-center-lbl">Transaksi</div>
                                </div>
                            </div>
                            <div style="flex:1;">
                                <div class="legend-item">
                                    <span class="legend-dot" style="background:var(--green);"></span>
                                    <span class="legend-label">BAPP</span>
                                    <span class="legend-pct">60%</span>
                                </div>
                                <div class="legend-item">
                                    <span class="legend-dot" style="background:var(--amber);"></span>
                                    <span class="legend-label">Uang Muka</span>
                                    <span class="legend-pct">40%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress per Kategori -->
                    <div class="card">
                        <div class="card-header" style="margin-bottom:14px;">
                            <div>
                                <div class="card-title">Realisasi per Kategori</div>
                                <div class="card-sub">Minggu 3 — Agustus 2026</div>
                            </div>
                        </div>
                        <div class="progress-item">
                            <div class="progress-row">
                                <span class="progress-name">Operasional</span>
                                <span class="progress-nums">Rp 28 Jt / 40 Jt</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" style="width:70%;background:var(--green);"></div>
                            </div>
                        </div>
                        <div class="progress-item">
                            <div class="progress-row">
                                <span class="progress-name">Pemeliharaan</span>
                                <span class="progress-nums">Rp 15 Jt / 25 Jt</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" style="width:60%;background:var(--blue);"></div>
                            </div>
                        </div>
                        <div class="progress-item">
                            <div class="progress-row">
                                <span class="progress-name">Transportasi</span>
                                <span class="progress-nums">Rp 6 Jt / 8 Jt</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" style="width:75%;background:var(--amber);"></div>
                            </div>
                        </div>
                        <div class="progress-item" style="margin-bottom:0;">
                            <div class="progress-row">
                                <span class="progress-name">Konsumsi</span>
                                <span class="progress-nums">Rp 3 Jt / 10 Jt</span>
                            </div>
                            <div class="progress-track">
                                <div class="progress-fill" style="width:30%;background:var(--red);"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Aktivitas Terkini -->
                    <div class="card">
                        <div class="card-header" style="margin-bottom:8px;">
                            <div>
                                <div class="card-title">Aktivitas Terkini</div>
                                <div class="card-sub">Input terbaru hari ini</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="act-icon" style="background:var(--green-light);">
                                <svg style="width:14px;height:14px;color:var(--green)" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div>
                                <div class="act-text">Rencana Operasional Kantor Rp 4.500.000 diinput.</div>
                                <div class="act-time">1 jam lalu · giant123</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="act-icon" style="background:rgba(217,119,6,0.09);">
                                <svg style="width:14px;height:14px;color:var(--amber)" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="act-text">Uang Muka Transportasi Rp 1.200.000 menunggu SPJ.</div>
                                <div class="act-time">3 jam lalu · giant123</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="act-icon" style="background:rgba(45,75,158,0.09);">
                                <svg style="width:14px;height:14px;color:var(--blue)" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="act-text">BAPP Pemeliharaan CV Mitra Teknik Rp 8.750.000 disetujui.</div>
                                <div class="act-time">5 jam lalu · admin</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script>
        const clGreen = '#1A7A3C',
            clBlue = '#2D4B9E',
            clAmber = '#D97706',
            clRed = '#D0021B';

        function mkSparkline(id, data, color) {
            const ctx = document.getElementById(id);
            if (!ctx) return;
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map((_, i) => i),
                    datasets: [{
                        data,
                        borderColor: color,
                        borderWidth: 1.5,
                        fill: true,
                        backgroundColor: color + '18',
                        pointRadius: 0,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                    },
                    scales: {
                        x: {
                            display: false
                        },
                        y: {
                            display: false
                        }
                    }
                }
            });
        }

        mkSparkline('spark1', [30, 35, 38, 36, 40, 42, 44, 43, 46, 45, 47, 48, 46, 48, 49, 50, 48, 50, 49, 51], clGreen);
        mkSparkline('spark2', [20, 22, 24, 23, 26, 28, 28, 30, 29, 31, 30, 31, 32, 31, 33, 32, 33, 32, 34, 34], clBlue);
        mkSparkline('spark3', [8, 9, 10, 11, 10, 12, 11, 13, 12, 13, 14, 13, 13, 14, 13, 14, 13, 14, 13, 13], clAmber);
        mkSparkline('spark4', [22, 20, 18, 19, 17, 16, 18, 15, 16, 15, 14, 16, 15, 17, 16, 15, 17, 16, 17, 17], clRed);

        // Area chart
        const areaCtx = document.getElementById('areaChart');
        new Chart(areaCtx, {
            type: 'line',
            data: {
                labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                datasets: [{
                        label: 'Rencana',
                        data: [42000000, 38000000, 48500000, 56900000],
                        borderColor: clGreen,
                        backgroundColor: 'rgba(26,122,60,0.08)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: clGreen
                    },
                    {
                        label: 'Realisasi',
                        data: [39000000, 35500000, 31200000, null],
                        borderColor: clBlue,
                        backgroundColor: 'rgba(45,75,158,0.06)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: clBlue,
                        borderDash: [0]
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end',
                        labels: {
                            boxWidth: 8,
                            boxHeight: 8,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: {
                                size: 11,
                                family: 'Inter'
                            },
                            color: '#64748B'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1A1D2E',
                        titleColor: '#fff',
                        bodyColor: 'rgba(255,255,255,0.7)',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: ctx => ' ' + ctx.dataset.label + ': Rp ' + (ctx.raw / 1000000).toFixed(1) + ' Jt'
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11,
                                family: 'Inter'
                            },
                            color: '#94A3B8'
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(0,0,0,0.04)'
                        },
                        ticks: {
                            font: {
                                size: 11,
                                family: 'Inter'
                            },
                            color: '#94A3B8',
                            callback: v => 'Rp ' + (v / 1000000).toFixed(0) + ' Jt'
                        }
                    }
                }
            }
        });

        // Donut chart
        new Chart(document.getElementById('donutChart'), {
            type: 'doughnut',
            data: {
                labels: ['BAPP', 'Uang Muka'],
                datasets: [{
                    data: [29, 19],
                    backgroundColor: [clGreen, clAmber],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1A1D2E',
                        titleColor: '#fff',
                        bodyColor: 'rgba(255,255,255,0.7)',
                        padding: 8,
                        cornerRadius: 8,
                        titleFont: {
                            size: 11,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 11
                        }
                    }
                }
            }
        });

        function setTab(el) {
            document.querySelectorAll('.chart-tab').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
        }

        document.querySelectorAll('.week-tab').forEach(t => {
            t.addEventListener('click', function() {
                document.querySelectorAll('.week-tab').forEach(x => x.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>
