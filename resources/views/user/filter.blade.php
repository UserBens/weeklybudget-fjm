<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Filter Data User — Weekly Budget</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        :root {
            --green: #1A7A3C;
            --green2: #22A050;
            --green-light: #E8F5EE;
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
            font-family: 'Inter', sans-serif;
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

        .sb-top {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 16px 18px;
            border-bottom: 1px solid var(--border);
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

        .topbar-username {
            font-size: 12px;
            font-weight: 600;
            color: var(--dark);
        }

        .topbar-role {
            font-size: 10px;
            color: var(--gray-light);
        }

        /* ── MAIN ── */
        #main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        #page-content {
            flex: 1;
            overflow-y: auto;
            padding: 28px 32px;
        }

        /* ── PAGE HEADER ── */
        .page-eyebrow {
            font-size: 11px;
            font-weight: 600;
            color: var(--gray-light);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .page-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: -0.02em;
        }

        .page-subtitle {
            font-size: 13px;
            color: var(--gray-light);
            margin-top: 3px;
        }

        /* ── FORM CARD ── */
        .form-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 28px 28px 32px;
            max-width: 100%;
            margin-bottom: 24px;
        }

        .form-card-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .form-card-sub {
            font-size: 13px;
            color: var(--gray-light);
            margin-bottom: 28px;
        }

        .form-row {
            display: grid;
            gap: 20px;
            margin-bottom: 16px;
        }

        /* Tambahan cols-4 untuk form filter */
        .form-row.cols-4 {
            grid-template-columns: repeat(1, 1fr);
        }

        @media (min-width: 768px) {
            .form-row.cols-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .form-row.cols-4 {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
        }

        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            background: #fff;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-input::placeholder {
            color: #9CA3AF;
        }

        .form-input:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(26, 122, 60, 0.1);
        }

        /* ── FORM ACTIONS ── */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .btn {
            padding: 9px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.12s;
            display: flex;
            align-items: center;
            gap: 6px;
            border: none;
            text-decoration: none;
        }

        .btn-outline {
            background: #fff;
            border: 1px solid #D1D5DB;
            color: var(--gray);
        }

        .btn-outline:hover {
            border-color: #9CA3AF;
            background: #F9FAFB;
        }

        .btn-primary {
            background: var(--green);
            color: #fff;
            border: 1px solid var(--green);
        }

        .btn-primary:hover {
            background: var(--green2);
        }

        /* ── DATA TABLE ── */
        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th {
            background: #F8FAFC;
            color: var(--gray);
            font-weight: 600;
            text-align: left;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            color: var(--dark);
        }

        tbody tr:hover {
            background: #F8FAFC;
        }

        .empty-state {
            padding: 32px;
            text-align: center;
            color: var(--gray);
            font-size: 13px;
        }
    </style>
</head>

<body class="flex h-screen overflow-hidden">

    <!-- ══════ SIDEBAR ══════ -->
    @include('partial.sidebar')

    <!-- ══════ MAIN ══════ -->
    <div id="main-content">

        <!-- TOPBAR -->
        <div id="topbar">
            <div style="display:flex;align-items:center;gap:8px;">
                <div class="sb-logo-badge" style="width:28px;height:28px;font-size:10px;">WB</div>
                <span style="font-size:15px;font-weight:700;color:var(--dark);">Weekly Budget</span>
            </div>
            <div class="topbar-right">
                <div class="topbar-user">
                    <div class="topbar-avatar">
                        <svg style="width:14px;height:14px" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <div class="topbar-username">{{ auth()->user()->name ?? 'giant123–' }}</div>
                        <div class="topbar-role">Administrator</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT -->
        <div id="page-content">

            <!-- Page header -->
            <div style="margin-bottom:24px;">
                <div class="page-eyebrow">Weekly Budget · PT. Fokus Jasa Mitra</div>
                <div class="page-title">Data Pengguna</div>
                <div class="page-subtitle">Filter dan kelola data seluruh pengguna sistem.</div>
            </div>

            <!-- FORM FILTER CARD -->
            <div class="form-card">
                <div class="form-card-title">Filter Pencarian</div>
                <div class="form-card-sub">Cari spesifik data berdasarkan form di bawah ini</div>

                <form method="GET" action="{{ route('user.index') }}">
                    <div class="form-row cols-4">
                        <div class="form-group">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" class="form-input"
                                placeholder="Masukkan nama..." value="{{ request('nama') }}" />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="ktp">Nomor KTP</label>
                            <input type="text" id="ktp" name="ktp" class="form-input"
                                placeholder="Masukkan NIK/KTP..." value="{{ request('ktp') }}" />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">Alamat Email</label>
                            <input type="email" id="email" name="email" class="form-input"
                                placeholder="Masukkan email..." value="{{ request('email') }}" />
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="no_hp">No. Handphone</label>
                            <input type="text" id="no_hp" name="no_hp" class="form-input"
                                placeholder="Masukkan no hp..." value="{{ request('no_hp') }}" />
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('user.index') }}" class="btn btn-outline">
                            Reset Filter
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari Data
                        </button>
                    </div>
                </form>
            </div>

            <!-- HASIL PENCARIAN (TABEL) -->
            <div class="form-card" style="padding: 0; overflow: hidden;">
                <div style="padding: 24px; border-bottom: 1px solid var(--border);">
                    <div class="form-card-title" style="margin-bottom: 0;">Hasil Pencarian</div>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 50px; text-align: center;">No</th>
                                <th>Nama Lengkap</th>
                                <th>Nomor KTP</th>
                                <th>Email</th>
                                <th>No. Handphone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr>
                                    <td style="text-align: center; color: var(--gray);">
                                        {{ $users->firstItem() + $index }}
                                    </td>
                                    <td style="font-weight: 500;">{{ $user->name }}</td>
                                    <td>{{ $user->ktp ?? '-' }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            Tidak ada data user yang ditemukan.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links (Jika ada) -->
                @if ($users->hasPages())
                    <div style="padding: 16px 24px; border-top: 1px solid var(--border);">
                        {{ $users->withQueryString()->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

</body>

</html>
