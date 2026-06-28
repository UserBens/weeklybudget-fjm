<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Input Rencana Pengeluaran — Weekly Budget</title>
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
            line-height: 1.3;
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
            max-width: 860px;
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

        .form-divider {
            height: 1px;
            background: var(--border);
            margin: 24px 0;
        }

        /* ── FORM ELEMENTS ── */
        .form-row {
            display: grid;
            gap: 20px;
            margin-bottom: 24px;
        }

        .form-row.cols-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .form-row.cols-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        .form-row.cols-1 {
            grid-template-columns: 1fr;
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

        .form-label span.req {
            color: var(--red);
            margin-left: 2px;
        }

        .form-input,
        .form-select,
        .form-textarea {
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
            appearance: none;
            -webkit-appearance: none;
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #9CA3AF;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(26, 122, 60, 0.1);
        }

        /* Input dengan icon kalender */
        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap .form-input {
            padding-right: 36px;
        }

        .input-end-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-light);
            pointer-events: none;
        }

        /* Select dengan custom arrow */
        .select-wrap {
            position: relative;
        }

        .select-wrap .form-select {
            padding-right: 36px;
            cursor: pointer;
        }

        .select-arrow {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-light);
            pointer-events: none;
        }

        /* Textarea */
        .form-textarea {
            resize: vertical;
            min-height: 100px;
            line-height: 1.55;
        }

        /* ── RADIO GROUP (Tipe) ── */
        .radio-group {
            display: flex;
            gap: 20px;
            padding: 4px 0;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .radio-item input[type="radio"] {
            display: none;
        }

        .radio-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #D1D5DB;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color 0.15s;
            flex-shrink: 0;
        }

        .radio-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--green);
            opacity: 0;
            transition: opacity 0.15s;
        }

        .radio-item input[type="radio"]:checked~.radio-circle {
            border-color: var(--green);
        }

        .radio-item input[type="radio"]:checked~.radio-circle .radio-dot {
            opacity: 1;
        }

        .radio-label {
            font-size: 13.5px;
            font-weight: 500;
            color: var(--dark);
            user-select: none;
        }

        /* ── NOMINAL INPUT ── */
        .nominal-wrap {
            position: relative;
        }

        .nominal-prefix {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
            font-weight: 600;
            color: var(--gray);
            pointer-events: none;
        }

        .nominal-wrap .form-input {
            padding-left: 44px;
        }

        /* ── FORM ACTIONS ── */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 28px;
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

        /* ── ALERT ── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: var(--green-light);
            color: var(--green);
            border: 1px solid rgba(26, 122, 60, 0.2);
        }

        .alert-error {
            background: rgba(208, 2, 27, 0.07);
            color: var(--red);
            border: 1px solid rgba(208, 2, 27, 0.2);
        }

        /* ── HELPER TEXT ── */
        .form-hint {
            font-size: 11.5px;
            color: var(--gray-light);
            margin-top: -2px;
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
                        <div class="topbar-role">User Input Rencana Pengeluaran</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE CONTENT -->
        <div id="page-content">

            <!-- Page header -->
            <div style="margin-bottom:24px;">
                <div class="page-eyebrow">Weekly Budget · PT. Fokus Jasa Mitra</div>
                <div class="page-title">Input Rencana Pengeluaran</div>
                <div class="page-subtitle">Tambah data rencana pengeluaran mingguan baru.</div>
            </div>

            {{-- Alert success --}}
            @if (session('success'))
                <div class="alert alert-success">
                    <svg style="width:16px;height:16px;flex-shrink:0;margin-top:1px" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Alert error umum --}}
            @if ($errors->any())
                <div class="alert alert-error">
                    <svg style="width:16px;height:16px;flex-shrink:0;margin-top:1px" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <div style="font-weight:700;margin-bottom:4px;">Terdapat kesalahan pada form:</div>
                        <ul style="padding-left:16px;font-size:12px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- FORM CARD -->
            <div class="form-card">
                <div class="form-card-title">Form Rencana Pengeluaran</div>
                <div class="form-card-sub">Masukkan data rencana pengeluaran mingguan</div>

                <form method="POST" action="{{ route('pengeluaran.store') }}" id="formPengeluaran">
                    @csrf

                    {{-- ── Baris 1: Tanggal, Bulan, Minggu ── --}}
                    <div class="form-row cols-3">

                        <div class="form-group">
                            <label class="form-label" for="tanggal_input">
                                Tanggal Input <span class="req">*</span>
                            </label>
                            <div class="input-icon-wrap">
                                <input type="date" id="tanggal_input" name="tanggal_input" class="form-input"
                                    value="{{ old('tanggal_input', date('Y-m-d')) }}" required />
                                <span class="input-end-icon">
                                    <svg style="width:15px;height:15px" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="bulan">
                                Bulan <span class="req">*</span>
                            </label>
                            <div class="select-wrap">
                                <select id="bulan" name="bulan" class="form-select" required>
                                    <option value="">Pilih bulan</option>
                                    @php
                                        $bulanList = [
                                            1 => 'Januari',
                                            2 => 'Februari',
                                            3 => 'Maret',
                                            4 => 'April',
                                            5 => 'Mei',
                                            6 => 'Juni',
                                            7 => 'Juli',
                                            8 => 'Agustus',
                                            9 => 'September',
                                            10 => 'Oktober',
                                            11 => 'November',
                                            12 => 'Desember',
                                        ];
                                        $currentBulan = old('bulan', (int) date('n'));
                                    @endphp
                                    @foreach ($bulanList as $num => $nama)
                                        <option value="{{ $num }}"
                                            {{ $currentBulan == $num ? 'selected' : '' }}>
                                            {{ $nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="select-arrow">
                                    <svg style="width:14px;height:14px" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="minggu">
                                Minggu <span class="req">*</span>
                            </label>
                            <div class="select-wrap">
                                <select id="minggu" name="minggu" class="form-select" required>
                                    <option value="">Pilih minggu</option>
                                    @php $currentMinggu = old('minggu', ''); @endphp
                                    @foreach ([1, 2, 3, 4] as $m)
                                        <option value="{{ $m }}"
                                            {{ $currentMinggu == $m ? 'selected' : '' }}>
                                            Minggu {{ $m }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="select-arrow">
                                    <svg style="width:14px;height:14px" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- ── Kategori Pengeluaran ── --}}
                    <div class="form-row cols-1">
                        <div class="form-group">
                            <label class="form-label" for="kategori">
                                Kategori Pengeluaran <span class="req">*</span>
                            </label>
                            <div class="select-wrap">
                                <select id="kategori" name="kategori" class="form-select" required>
                                    <option value="">Pilih kategori</option>
                                    @php
                                        $kategoriList = $kategoriList ?? [
                                            'Operasional Kantor',
                                            'Transportasi',
                                            'Pemeliharaan',
                                            'ATK & Perlengkapan',
                                            'Konsumsi Rapat',
                                            'Lain-lain',
                                        ];
                                    @endphp
                                    @foreach ($kategoriList as $kat)
                                        <option value="{{ $kat }}"
                                            {{ old('kategori') == $kat ? 'selected' : '' }}>
                                            {{ $kat }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="select-arrow">
                                    <svg style="width:14px;height:14px" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- ── Tipe ── --}}
                    <div class="form-row cols-1">
                        <div class="form-group">
                            <label class="form-label">Tipe <span class="req">*</span></label>
                            <div class="radio-group">
                                <label class="radio-item">
                                    <input type="radio" name="tipe" value="BAPP"
                                        {{ old('tipe', 'BAPP') === 'BAPP' ? 'checked' : '' }} />
                                    <span class="radio-circle"><span class="radio-dot"></span></span>
                                    <span class="radio-label">BAPP</span>
                                </label>
                                <label class="radio-item">
                                    <input type="radio" name="tipe" value="Uang Muka"
                                        {{ old('tipe') === 'Uang Muka' ? 'checked' : '' }} />
                                    <span class="radio-circle"><span class="radio-dot"></span></span>
                                    <span class="radio-label">Uang Muka</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- ── Dibayarkan Kepada ── --}}
                    <div class="form-row cols-1">
                        <div class="form-group">
                            <label class="form-label" for="dibayarkan_kepada">
                                Dibayarkan Kepada <span class="req">*</span>
                            </label>
                            <input type="text" id="dibayarkan_kepada" name="dibayarkan_kepada" class="form-input"
                                placeholder="Nama penerima pembayaran" value="{{ old('dibayarkan_kepada') }}"
                                required />
                        </div>
                    </div>

                    {{-- ── Keterangan ── --}}
                    <div class="form-row cols-1">
                        <div class="form-group">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" class="form-textarea" placeholder="Keterangan pengeluaran (opsional)">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>

                    {{-- ── Nominal ── --}}
                    <div class="form-row cols-2">
                        <div class="form-group">
                            <label class="form-label" for="nominal">
                                Nominal (Rp) <span class="req">*</span>
                            </label>
                            <div class="nominal-wrap">
                                <span class="nominal-prefix">Rp</span>
                                <input type="text" id="nominal" name="nominal" class="form-input"
                                    placeholder="0" value="{{ old('nominal') }}" inputmode="numeric" required />
                            </div>
                            <span class="form-hint">Masukkan angka tanpa titik/koma. Contoh: 5000000</span>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="no_dokumen">No. Dokumen</label>
                            <input type="text" id="no_dokumen" name="no_dokumen" class="form-input"
                                placeholder="Opsional — diisi otomatis jika kosong"
                                value="{{ old('no_dokumen') }}" />
                            <span class="form-hint">Nomor referensi BAPP atau Uang Muka</span>
                        </div>
                    </div>

                    {{-- ── Form Actions ── --}}
                    <div class="form-actions">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline">
                            Batal
                        </a>
                        <button type="reset" class="btn btn-outline" onclick="resetForm()">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <svg style="width:13px;height:13px" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Pengeluaran
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <script>
        // ── Format nominal dengan pemisah ribuan saat mengetik ──
        const nominalInput = document.getElementById('nominal');
        nominalInput.addEventListener('input', function() {
            let raw = this.value.replace(/\D/g, '');
            this.value = raw ? parseInt(raw).toLocaleString('id-ID') : '';
        });

        // Sebelum submit: bersihkan format agar value yang dikirim hanya angka
        document.getElementById('formPengeluaran').addEventListener('submit', function() {
            nominalInput.value = nominalInput.value.replace(/\D/g, '');
        });

        // ── Auto-set minggu berdasarkan tanggal yang dipilih ──
        const tanggalInput = document.getElementById('tanggal_input');
        const mingguSelect = document.getElementById('minggu');

        function hitungMinggu(tgl) {
            const d = new Date(tgl);
            const day = d.getDate();
            if (day <= 7) return 1;
            if (day <= 14) return 2;
            if (day <= 21) return 3;
            return 4;
        }

        tanggalInput.addEventListener('change', function() {
            if (this.value) {
                const minggu = hitungMinggu(this.value);
                mingguSelect.value = minggu;
            }
        });

        // Auto-set on load
        if (tanggalInput.value) {
            const minggu = hitungMinggu(tanggalInput.value);
            if (!mingguSelect.value) mingguSelect.value = minggu;
        }

        function resetForm() {
            // Kembalikan tanggal ke hari ini
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_input').value = today;
        }
    </script>
</body>

</html>
