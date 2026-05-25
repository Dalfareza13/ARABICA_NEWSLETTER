<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- ✅ SEO & performa --}}
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kelola Berita - Admin PLN</title>

    {{-- ✅ Preconnect CDN agar lebih cepat --}}
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://use.fontawesome.com" crossorigin>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* ══════════════════════════════════════════
           ROOT & BASE
        ══════════════════════════════════════════ */
        :root {
            --pln-blue:   #005691;
            --pln-dark:   #002d5d;
            --pln-yellow: #ffc107;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            background-color: #f4f7f6;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ══════════════════════════════════════════
           SIDEBAR
        ══════════════════════════════════════════ */
        .sidebar {
            background: var(--pln-blue);
            min-height: 100vh;
            color: white;
            transition: left 0.3s ease-in-out;
            z-index: 1050;
            will-change: left; /* ✅ GPU hint untuk animasi sidebar */
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            background: rgba(0, 0, 0, 0.15);
            border-bottom: 1px solid rgba(255,255,255,.1);
        }

        .sidebar-header img {
            max-width: 100%;
            height: auto;
            max-height: 60px;
        }

        .nav-link-item {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 15px 25px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background .25s, border-left-color .25s;
            border-left: 4px solid transparent;
            font-size: .95rem;
        }

        .nav-link-item.active {
            background: var(--pln-dark);
            color: white;
            border-left-color: var(--pln-yellow);
        }

        .nav-link-item:hover:not(.active) {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: rgba(255,255,255,.3);
        }

        .nav-link-item i {
            width: 18px;
            text-align: center;
            flex-shrink: 0;
        }

        /* ══════════════════════════════════════════
           MOBILE NAV
        ══════════════════════════════════════════ */
        .mobile-nav {
            display: none;
            background: var(--pln-blue);
            color: white;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 1040;
        }
        .mobile-nav img { height: 30px; }

        /* ══════════════════════════════════════════
           MAIN CONTENT
        ══════════════════════════════════════════ */
        .main-content {
            padding: 40px;
            min-height: 100vh;
        }

        /* ══════════════════════════════════════════
           TABLE CONTAINER
        ══════════════════════════════════════════ */
        .table-container {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: var(--pln-dark);
            border-bottom: 2px solid #dee2e6;
            white-space: nowrap;
        }

        @media (min-width: 768px) {
            .table tbody tr {
                transition: background .2s;
            }
            .table tbody tr:hover {
                background-color: #f0f7ff;
            }
        }

        /* ══════════════════════════════════════════
           GAMBAR THUMBNAIL
        ══════════════════════════════════════════ */
        .thumb-img {
            width: 80px;
            height: 55px;
            object-fit: cover;
            border-radius: 8px;
            display: block;
            background: #e9ecef;
        }

        /* ══════════════════════════════════════════
           EMPTY STATE
        ══════════════════════════════════════════ */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #6c757d;
        }
        .empty-state i { font-size: 4rem; color: #dee2e6; margin-bottom: 20px; }

        /* ══════════════════════════════════════════
           OVERLAY SIDEBAR (mobile)
        ══════════════════════════════════════════ */
        #sidebarOverlay {
            position: fixed; inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1045;
            display: none;
        }
        #sidebarOverlay.active { display: block; }

        /* ══════════════════════════════════════════
           MODAL IMPROVEMENTS
        ══════════════════════════════════════════ */
        .modal-content { border-radius: 15px; border: none; }

        .img-preview-box {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            min-height: 90px; /* ✅ cegah layout shift */
        }
        .img-preview-box img {
            max-width: 100%;
            max-height: 160px;
            object-fit: contain;
            border-radius: 6px;
        }
        .img-preview-label {
            font-size: .72rem;
            color: #6c757d;
            margin-top: 6px;
            display: block;
        }

        /* Loading overlay saat submit */
        .modal-loading-overlay {
            position: absolute; inset: 0;
            background: rgba(255,255,255,.88);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            border-radius: 15px;
            z-index: 10;
            gap: 12px;
        }

        /* ══════════════════════════════════════════
           RESPONSIVE MOBILE
        ══════════════════════════════════════════ */
        @media (max-width: 767.98px) {
            .mobile-nav { display: flex; align-items: center; justify-content: space-between; }

            .sidebar {
                position: fixed;
                left: -100%;
                width: 280px;
                box-shadow: none !important;
            }
            .sidebar.show {
                left: 0;
                box-shadow: 10px 0 20px rgba(0,0,0,.15) !important;
            }

            .main-content { padding: 20px 15px; }
            h2 { font-size: 1.4rem; }
            .table-container { padding: 15px; }

            .table-responsive { border: none; }
            .table thead { display: none; }
            .table, .table tbody, .table tr, .table td { display: block; width: 100%; }

            .table tr {
                margin-bottom: 15px;
                border: 1px solid #e0e0e0;
                border-radius: 12px;
                padding: 15px;
                box-shadow: 0 2px 8px rgba(0,0,0,.06);
                background: white;
            }

            .table td {
                text-align: right;
                padding: 9px 0;
                border: none;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #f5f5f5;
            }
            .table td:last-child { border-bottom: none; margin-top: 5px; }

            .table td::before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--pln-blue);
                font-size: .8rem;
                text-transform: uppercase;
                letter-spacing: .5px;
                flex-shrink: 0;
                margin-right: 8px;
            }

            .thumb-img {
                width: 110px !important;
                height: 75px !important;
            }

            .table td[data-label="Judul"] {
                text-align: left;
                display: block;
            }
            .table td[data-label="Judul"]::before {
                display: block;
                margin-bottom: 4px;
            }

            .table td[data-label="Aksi"] { justify-content: flex-end; }
            .table td[data-label="Aksi"]::before { content: none; }

            .btn-group-action { display: flex; gap: 8px; }
        }

        @media (min-width: 768px) {
            .btn-group-action { display: flex; gap: 6px; justify-content: center; }
        }

        /* ══════════════════════════════════════════
           SKELETON LOADING ROW
        ══════════════════════════════════════════ */
        .skeleton-row td {
            padding: 14px 10px !important;
        }
        .skeleton-box {
            background: linear-gradient(90deg, #e9ecef 25%, #f8f9fa 50%, #e9ecef 75%);
            background-size: 400% 100%;
            animation: sk-shimmer 1.4s infinite;
            border-radius: 6px;
            display: inline-block;
        }
        @keyframes sk-shimmer {
            0%   { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>

<body>

    <!-- ══ MOBILE NAVBAR ══ -->
    <div class="mobile-nav shadow-sm">
        <div class="d-flex align-items-center">
            <img src="{{ asset('assets/Logo_PLN.svg.png') }}" alt="Logo PLN" loading="lazy">
            <span class="ms-2 fw-bold">Admin PLN</span>
        </div>
        <button class="btn text-white p-1" id="toggleSidebar" aria-label="Buka menu" aria-expanded="false">
            <i class="fas fa-bars fa-lg"></i>
        </button>
    </div>

    <!-- ══ OVERLAY SIDEBAR ══ -->
    <div id="sidebarOverlay" role="presentation"></div>

    <div class="container-fluid">
        <div class="row flex-nowrap">

            <!-- ══ SIDEBAR ══ -->
            <nav class="col-md-3 col-lg-2 px-0 sidebar shadow" id="sidebarMenu" aria-label="Menu admin">
                <div class="sidebar-header d-none d-md-flex flex-column align-items-center">
                    <img src="{{ asset('assets/Logo_PLN.svg.png') }}" alt="Logo PLN">
                    <p class="mt-2 fw-bold mb-0 small text-uppercase text-white">Admin PLN Jambi</p>
                </div>

                <div class="nav-links mt-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link-item">
                        <i class="fas fa-plus-circle"></i> Tambah Berita
                    </a>
                    <a href="{{ route('admin.kelola_berita') }}" class="nav-link-item active" aria-current="page">
                        <i class="fas fa-tasks"></i> Kelola Berita
                    </a>
                    <a href="{{ route('admin.profil') }}" class="nav-link-item">
                        <i class="fas fa-building"></i> Profil Perusahaan
                    </a>

                    <div style="margin-top: 30px; padding: 0 20px;">
                        <button type="button" onclick="confirmLogout()"
                            class="nav-link-item w-100 border-0 bg-transparent text-start"
                            style="color:rgba(255,255,255,.8);cursor:pointer;">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </button>
                    </div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </nav>

            <!-- ══ MAIN CONTENT ══ -->
            <main class="col main-content" id="mainContent">
                <div class="container-fluid px-0">

                    <h2 class="fw-bold mb-4" style="color: var(--pln-dark);">
                        <i class="fas fa-newspaper me-2 opacity-75"></i>Daftar Berita Terbit
                    </h2>

                    {{-- ── Alert Session ── --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4"
                             role="alert" id="successAlert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                        </div>
                    @endif

                    {{-- ── Table Container ── --}}
                    <div class="table-container">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="beritaTable">
                                <thead class="text-center">
                                    <tr>
                                        <th width="50">No</th>
                                        <th width="110">Gambar</th>
                                        <th class="text-start">Judul Berita</th>
                                        <th width="130">Tanggal Post</th>
                                        <th width="120">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @forelse($berita as $key => $d)
                                        <tr class="text-center">
                                            <td data-label="No">{{ $key + 1 }}</td>
                                            <td data-label="Gambar">
                                                <img src="{{ asset('assets/berita/' . $d->gambar) }}"
                                                    class="thumb-img mx-auto"
                                                    loading="lazy"
                                                    decoding="async"
                                                    alt="{{ e($d->judul) }}"
                                                    onerror="this.src='https://placehold.co/80x55/e9ecef/6c757d?text=Foto';this.onerror=null;">
                                            </td>
                                            <td data-label="Judul" class="text-start fw-semibold">
                                                {{ $d->judul }}
                                            </td>
                                            {{-- ✅ Format tampilan tetap d M Y --}}
                                            <td data-label="Tanggal">{{ date('d M Y', strtotime($d->tanggal)) }}</td>
                                            <td data-label="Aksi">
                                                <div class="btn-group-action">
                                                    {{--
                                                        ✅ BUG FIX UTAMA:
                                                        data-tanggal menggunakan format Y-m-d
                                                        agar input type="date" bisa membacanya dengan benar.
                                                        Sebelumnya jika DB menyimpan format berbeda,
                                                        tanggal tidak muncul di form edit.
                                                    --}}
                                                    <button type="button"
                                                        class="btn btn-warning btn-sm rounded shadow-sm px-3 btn-edit"
                                                        data-id="{{ $d->id }}"
                                                        data-judul="{{ e($d->judul) }}"
                                                        data-tanggal="{{ date('Y-m-d', strtotime($d->tanggal)) }}"
                                                        data-gambar="{{ $d->gambar }}"
                                                        data-gambar-url="{{ asset('assets/berita/' . $d->gambar) }}"
                                                        data-update-url="{{ route('berita.update', $d->id) }}"
                                                        title="Edit Berita"
                                                        aria-label="Edit berita {{ e($d->judul) }}">
                                                        <i class="fas fa-edit text-white"></i>
                                                    </button>

                                                    <button type="button"
                                                        class="btn btn-danger btn-sm rounded shadow-sm px-3 btn-delete"
                                                        data-id="{{ $d->id }}"
                                                        data-judul="{{ e($d->judul) }}"
                                                        data-delete-url="{{ route('berita.delete', $d->id) }}"
                                                        title="Hapus Berita"
                                                        aria-label="Hapus berita {{ e($d->judul) }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">
                                                <div class="empty-state">
                                                    <i class="fas fa-inbox d-block mb-3"></i>
                                                    <p class="mb-1 fw-bold">Belum Ada Berita</p>
                                                    <small>Silakan tambah berita baru dari menu Tambah Berita</small>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- /table-container --}}

                </div>
            </main>

        </div>
    </div>

    {{-- ════════════════════════════════════════════════════════════
         MODAL EDIT — satu modal, diisi dinamis oleh JS
    ════════════════════════════════════════════════════════════ --}}
    <div class="modal fade" id="editModal" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg position-relative">

                {{-- Loading overlay --}}
                <div class="modal-loading-overlay d-none" id="editLoadingOverlay" aria-live="polite">
                    <div class="spinner-border text-primary" role="status" style="width:2.5rem;height:2.5rem;">
                        <span class="visually-hidden">Menyimpan...</span>
                    </div>
                    <span class="text-muted fw-semibold" style="font-size:.9rem;">Menyimpan perubahan…</span>
                </div>

                <form id="editForm" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold" id="editModalLabel" style="color:var(--pln-dark);">
                            <i class="fas fa-edit me-2 text-warning"></i>Perbarui Berita
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body px-4 pt-3">

                        {{-- ✅ Hidden input id (digunakan jika controller butuh id via field) --}}
                        <input type="hidden" id="editId" name="id">

                        <div class="mb-3">
                            <label for="editJudul" class="form-label fw-bold small">Judul Berita</label>
                            <input type="text" id="editJudul" name="judul"
                                class="form-control border-2" required
                                placeholder="Masukkan judul berita"
                                maxlength="255">
                            <div class="invalid-feedback">Judul tidak boleh kosong.</div>
                        </div>

                        <div class="mb-3">
                            <label for="editTanggal" class="form-label fw-bold small">Tanggal Terbit</label>
                            {{--
                                ✅ BUG FIX: input[type=date] WAJIB format Y-m-d.
                                Nilai diisi oleh JS dari data-tanggal yang sudah diformat Y-m-d di atas.
                                Tanggal lama akan SELALU muncul saat modal dibuka.
                            --}}
                            <input type="date" id="editTanggal" name="tanggal"
                                class="form-control border-2" required>
                            <div class="invalid-feedback">Tanggal tidak boleh kosong.</div>
                        </div>

                        <div class="mb-3">
                            <label for="editGambar" class="form-label fw-bold small">
                                Ganti Gambar
                                <span class="text-muted fw-normal">(kosongkan jika tidak diganti)</span>
                            </label>
                            <input type="file" id="editGambar" name="gambar"
                                class="form-control border-2"
                                accept="image/jpeg,image/png,image/gif,image/webp">
                            <div class="form-text text-muted" style="font-size:.75rem;">
                                Format: JPG, PNG, GIF, WebP. Maks. 5MB.
                            </div>
                        </div>

                        {{-- Preview gambar --}}
                        <div class="row g-2 mt-1">
                            <div class="col-6">
                                <div class="img-preview-box">
                                    <img id="previewSaatIni" src="" alt="Gambar saat ini"
                                         onerror="this.src='https://placehold.co/160x100/e9ecef/6c757d?text=Foto';this.onerror=null;">
                                    <span class="img-preview-label">📌 Gambar saat ini</span>
                                </div>
                            </div>
                            <div class="col-6" id="previewBaruWrap" style="display:none;">
                                <div class="img-preview-box" style="border-color:var(--pln-blue);">
                                    <img id="previewBaru" src="" alt="Preview gambar baru">
                                    <span class="img-preview-label" style="color:var(--pln-blue);">✨ Gambar baru</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer border-0 px-4">
                        <button type="button" class="btn btn-light rounded-pill px-4"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4" id="editSubmitBtn">
                            <i class="fas fa-save me-1"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- /editModal --}}

    {{-- Form hapus terpusat --}}
    <form id="deleteForm" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>

    {{-- ════════════════════════════════════════
         SCRIPTS — defer agar tidak blok render
    ════════════════════════════════════════ --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

    <script>
    /* ─── Tunggu DOM + script selesai load ─── */
    document.addEventListener('DOMContentLoaded', function () {

        /* ══════════════════════════════════════════════════════
           HELPER: escape HTML untuk tampilan di SweetAlert
        ══════════════════════════════════════════════════════ */
        function escHtml(s) {
            return String(s)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;');
        }

        /* ══════════════════════════════════════════════════════
           SIDEBAR TOGGLE
        ══════════════════════════════════════════════════════ */
        var toggleBtn = document.getElementById('toggleSidebar');
        var sidebar   = document.getElementById('sidebarMenu');
        var overlay   = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.add('show');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            toggleBtn.setAttribute('aria-expanded', 'true');
        }
        function closeSidebar() {
            sidebar.classList.remove('show');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            toggleBtn.setAttribute('aria-expanded', 'false');
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                sidebar.classList.contains('show') ? closeSidebar() : openSidebar();
            });
        }
        if (overlay) overlay.addEventListener('click', closeSidebar);

        sidebar.querySelectorAll('.nav-link-item').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth < 768) closeSidebar();
            });
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && sidebar.classList.contains('show')) closeSidebar();
        });

        /* ══════════════════════════════════════════════════════
           AUTO-DISMISS SUCCESS ALERT (5 detik)
        ══════════════════════════════════════════════════════ */
        var successAlert = document.getElementById('successAlert');
        if (successAlert) {
            setTimeout(function () {
                var bsAlert = bootstrap.Alert.getOrCreateInstance(successAlert);
                if (bsAlert) bsAlert.close();
            }, 5000);
        }

        /* ══════════════════════════════════════════════════════
           LOGOUT CONFIRMATION
        ══════════════════════════════════════════════════════ */
        window.confirmLogout = function () {
            Swal.fire({
                title: 'Ingin Keluar?',
                text: 'Pastikan semua pekerjaan Anda telah tersimpan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Keluar!',
                cancelButtonText: 'Batal',
            }).then(function (result) {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Sedang Keluar…',
                        allowOutsideClick: false,
                        didOpen: function () { Swal.showLoading(); }
                    });
                    document.getElementById('logout-form').submit();
                }
            });
        };

        /* ══════════════════════════════════════════════════════
           MODAL EDIT
        ══════════════════════════════════════════════════════ */
        var editModal      = document.getElementById('editModal');
        var editForm       = document.getElementById('editForm');
        var loadingOverlay = document.getElementById('editLoadingOverlay');
        var fId            = document.getElementById('editId');
        var fJudul         = document.getElementById('editJudul');
        var fTanggal       = document.getElementById('editTanggal');
        var fGambar        = document.getElementById('editGambar');
        var prevNow        = document.getElementById('previewSaatIni');
        var prevBaru       = document.getElementById('previewBaru');
        var prevBaruW      = document.getElementById('previewBaruWrap');
        var submitBtn      = document.getElementById('editSubmitBtn');

        /* Fungsi reset state modal ke kondisi bersih */
        function resetEditModal() {
            if (fGambar)   fGambar.value   = '';
            if (prevBaru)  prevBaru.src    = '';
            if (prevBaruW) prevBaruW.style.display = 'none';
            if (editForm)  editForm.classList.remove('was-validated');
            if (loadingOverlay) loadingOverlay.classList.add('d-none');
            if (submitBtn) submitBtn.disabled = false;
        }

        /* Klik tombol EDIT → isi modal dengan data berita */
        document.addEventListener('click', function (e) {
            var btn = e.target.closest('.btn-edit');
            if (!btn) return;

            var d = btn.dataset;

            /* ✅ Set action form ke URL update berita ini */
            editForm.action = d.updateUrl;

            /* ✅ Isi field dengan data lama */
            fId.value      = d.id;
            fJudul.value   = d.judul;

            /*
             * ✅ BUG FIX UTAMA — TANGGAL:
             * d.tanggal sudah dalam format Y-m-d (diformat di Blade).
             * input[type="date"] hanya menerima Y-m-d, sehingga
             * tanggal lama SELALU muncul, pengguna tidak perlu mengisi ulang.
             */
            fTanggal.value = d.tanggal;

            /* Preview gambar saat ini */
            prevNow.src = d.gambarUrl;

            /* Reset sisa state */
            resetEditModal();

            /* Buka modal */
            bootstrap.Modal.getOrCreateInstance(editModal).show();
        });

        /* Preview gambar baru saat file dipilih */
        if (fGambar) {
            fGambar.addEventListener('change', function () {
                var file = this.files[0];

                /* Tidak ada file → sembunyikan preview baru */
                if (!file) {
                    prevBaru.src = '';
                    prevBaruW.style.display = 'none';
                    return;
                }

                /* Validasi tipe file */
                var allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!allowed.includes(file.type)) {
                    this.value = '';
                    prevBaruW.style.display = 'none';
                    Swal.fire({
                        icon: 'error',
                        title: 'File Tidak Valid',
                        text: 'Harap pilih file gambar (JPG, PNG, GIF, WebP).',
                        confirmButtonColor: '#005691'
                    });
                    return;
                }

                /* Validasi ukuran maksimal 5MB */
                if (file.size > 5 * 1024 * 1024) {
                    this.value = '';
                    prevBaruW.style.display = 'none';
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: 'Ukuran maksimal gambar adalah 5MB.',
                        confirmButtonColor: '#005691'
                    });
                    return;
                }

                /* Tampilkan preview gambar baru */
                var reader = new FileReader();
                reader.onload = function (ev) {
                    prevBaru.src = ev.target.result;
                    prevBaruW.style.display = 'block';
                };
                reader.readAsDataURL(file);
            });
        }

        /* Submit form edit dengan validasi Bootstrap */
        if (editForm) {
            editForm.addEventListener('submit', function (e) {
                e.preventDefault();
                editForm.classList.add('was-validated');
                if (!editForm.checkValidity()) return;

                /* Tampilkan loading & nonaktifkan tombol agar tidak double-submit */
                loadingOverlay.classList.remove('d-none');
                submitBtn.disabled = true;

                editForm.submit();
            });
        }

        /* Reset penuh saat modal ditutup */
        if (editModal) {
            editModal.addEventListener('hidden.bs.modal', function () {
                resetEditModal();
            });
        }

        /* ══════════════════════════════════════════════════════
           HAPUS BERITA — satu form terpusat
        ══════════════════════════════════════════════════════ */
        var deleteForm = document.getElementById('deleteForm');

        document.addEventListener('click', function (e) {
            var btn = e.target.closest('.btn-delete');
            if (!btn) return;

            var judul = btn.dataset.judul || 'berita ini';
            var url   = btn.dataset.deleteUrl;

            Swal.fire({
                title: 'Hapus Berita?',
                html: 'Anda akan menghapus:<br><strong>' + escHtml(judul) + '</strong>' +
                      '<br><small class="text-muted">Data tidak bisa dikembalikan.</small>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '<i class="fas fa-trash me-1"></i>Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then(function (result) {
                if (result.isConfirmed) {
                    deleteForm.action = url;
                    Swal.fire({
                        title: 'Menghapus…',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: function () { Swal.showLoading(); }
                    });
                    deleteForm.submit();
                }
            });
        });

    }); /* end DOMContentLoaded */
    </script>

</body>
</html>