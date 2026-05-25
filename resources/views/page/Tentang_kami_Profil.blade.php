<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Profil - PLN UP3 JAMBI</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">

    {{-- ══ PRECONNECT: kurangi latensi font & icon ══ --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

    {{-- ══ DNS PREFETCH cadangan ══ --}}
    <link rel="dns-prefetch" href="//use.fontawesome.com">

    {{-- ══ FONT: hanya varian yang dipakai ══ --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    {{-- ══ BOOTSTRAP CSS ══ --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- ══ FONT AWESOME — defer via preload trick ══ --}}
    <link rel="preload" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"></noscript>

    {{-- ══ ANIMATE.CSS — defer, hanya dipakai setelah load ══ --}}
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"></noscript>

    <style>
        :root {
            --primary: #00a2e9;
            --secondary: #ffc107;
            --dark-blue: #005691;
            --orange-pln: #ff6600;
            --light-bg: #f4f7f9;
            --skeleton-base: #e2e8f0;
            --skeleton-shine: #f8fafc;
        }

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: #333;
            overflow-x: hidden;
            -webkit-text-size-adjust: 100%;
        }

        h1, h2, h3, h4, h5, .navbar-brand { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* ══════════════════════════════════════════
           SKELETON LOADING — tampil saat gambar belum siap
        ══════════════════════════════════════════ */
        .img-skeleton {
            position: relative;
            overflow: hidden;
            background: var(--skeleton-base);
            border-radius: 12px;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .img-skeleton::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                90deg,
                transparent 0%,
                var(--skeleton-shine) 50%,
                transparent 100%
            );
            background-size: 200% 100%;
            animation: skeleton-sweep 1.4s ease-in-out infinite;
        }

        @keyframes skeleton-sweep {
            0%   { background-position: -200% center; }
            100% { background-position:  200% center; }
        }

        /* ══ Gambar: tersembunyi dulu, fade-in setelah load ══ */
        .lazy-img {
            opacity: 0;
            transition: opacity .45s ease, transform .45s ease;
            transform: translateY(8px);
            width: 100%;
            height: auto;
            display: block;
            border-radius: 10px;
        }

        .lazy-img.loaded {
            opacity: 1;
            transform: translateY(0);
        }

        /* Wrapper pembungkus gambar */
        .img-wrap {
            position: relative;
            background: #f8f9fa;
            border-radius: 15px;
            border: 1px solid #eee;
            overflow: hidden;
            min-height: 180px; /* mencegah layout shift */
        }

        .img-wrap .img-skeleton-inner {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: var(--skeleton-base);
            animation: skeleton-sweep 1.4s ease-in-out infinite;
            background-size: 200% 100%;
            background-image: linear-gradient(
                90deg,
                #e2e8f0 0%,
                #f8fafc 50%,
                #e2e8f0 100%
            );
            transition: opacity .3s;
            z-index: 1;
        }

        .img-wrap .img-skeleton-inner.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .img-wrap .img-placeholder-icon {
            font-size: 2.5rem;
            color: #94a3b8;
            opacity: .6;
        }

        /* ══════════════════════════════════════════
           TOPBAR
        ══════════════════════════════════════════ */
        .topbar {
            background: #f8f9fa;
            font-size: 13px;
            border-bottom: 1px solid #eee;
        }

        /* ══════════════════════════════════════════
           NAVBAR
        ══════════════════════════════════════════ */
        .navbar { padding: 15px 0; transition: all .3s; }
        .navbar-brand img { height: 40px; }
        .nav-link { font-weight: 600; color: #444 !important; transition: .3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }

        @media (max-width:991px) { .navbar-collapse { display: none !important; } }

        /* ── HAMBURGER ── */
        .drawer-toggle {
            background: none; border: none; cursor: pointer;
            width: 44px; height: 44px; display: none;
            flex-direction: column; justify-content: center;
            align-items: center; gap: 5px; border-radius: 10px;
            transition: background .2s; padding: 0;
            -webkit-tap-highlight-color: transparent;
        }
        .drawer-toggle span {
            display: block; width: 24px; height: 2.5px;
            background: #333; border-radius: 4px; transition: all .3s;
        }
        .drawer-toggle.open span:nth-child(1) { transform: translateY(7.5px) rotate(45deg); }
        .drawer-toggle.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .drawer-toggle.open span:nth-child(3) { transform: translateY(-7.5px) rotate(-45deg); }
        @media (max-width:991px) { .drawer-toggle { display: flex; } }

        /* ── DRAWER OVERLAY ── */
        .drawer-overlay {
            position: fixed; inset: 0; background: rgba(0,0,0,.5);
            z-index: 1040; opacity: 0; visibility: hidden;
            transition: opacity .3s, visibility .3s;
            -webkit-tap-highlight-color: transparent;
        }
        .drawer-overlay.show { opacity: 1; visibility: visible; }

        /* ── DRAWER PANEL ── */
        .drawer-panel {
            position: fixed; top: 0; right: 0;
            width: min(300px, 80vw); height: 100%; height: 100dvh;
            background: #fff; z-index: 1050;
            transform: translateX(100%);
            transition: transform .35s cubic-bezier(.4,0,.2,1);
            display: flex; flex-direction: column;
            overflow-y: auto; -webkit-overflow-scrolling: touch;
            box-shadow: -8px 0 40px rgba(0,0,0,.15);
        }
        .drawer-panel.open { transform: translateX(0); }
        .drawer-header {
            background: linear-gradient(135deg,#005691,#00a2e9);
            padding: 20px 20px 24px;
            display: flex; align-items: center; justify-content: space-between;
            flex-shrink: 0;
        }
        .drawer-header .drawer-logo { display: flex; align-items: center; gap: 12px; }
        .drawer-header .drawer-logo img { height: 36px; filter: brightness(0) invert(1); }
        .drawer-header .drawer-logo-text h3 { color:#fff;font-size:.95rem;font-weight:800;margin:0; }
        .drawer-header .drawer-logo-text small { color:rgba(255,255,255,.7);font-size:.65rem;letter-spacing:1px;display:block; }
        .drawer-close {
            background:rgba(255,255,255,.2); border:none; color:#fff;
            width:36px; height:36px; border-radius:50%;
            display:flex; align-items:center; justify-content:center;
            cursor:pointer; font-size:16px; flex-shrink:0;
            -webkit-tap-highlight-color:transparent; transition:background .2s;
        }
        .drawer-close:hover { background:rgba(255,255,255,.35); }
        .drawer-body { flex:1; padding:10px 0; }
        .drawer-nav-item {
            display:flex; align-items:center; gap:14px; padding:15px 22px;
            color:#333; text-decoration:none; font-weight:600; font-size:.95rem;
            border-left:3px solid transparent; transition:all .2s;
            -webkit-tap-highlight-color:transparent;
        }
        .drawer-nav-item:hover, .drawer-nav-item.active {
            background:#f0f7ff; color:var(--primary); border-left-color:var(--primary);
        }
        .drawer-nav-item i { width:20px;text-align:center;font-size:1rem;color:var(--primary);flex-shrink:0; }
        .drawer-divider { height:1px;background:#f0f0f0;margin:8px 16px; }
        .drawer-footer { padding:16px 22px;border-top:1px solid #f0f0f0;flex-shrink:0; }
        .drawer-footer .pln-mobile-btn {
            display:flex; align-items:center; gap:12px;
            background:linear-gradient(135deg,#005691,#00a2e9);
            color:#fff; text-decoration:none; border-radius:14px;
            padding:12px 16px; font-size:.85rem; font-weight:600;
            transition:opacity .2s; -webkit-tap-highlight-color:transparent;
        }
        .drawer-footer .pln-mobile-btn:hover { opacity:.9; }
        .drawer-footer .pln-mobile-btn img {
            width:36px;height:36px;border-radius:10px;
            object-fit:cover;flex-shrink:0;
        }

        /* ══════════════════════════════════════════
           SIDEBAR
        ══════════════════════════════════════════ */
        .sidebar {
            background:white; border-radius:20px; padding:25px;
            box-shadow:0 10px 30px rgba(0,0,0,0.05);
            position:-webkit-sticky; position:sticky; top:100px; z-index:10;
        }
        .sidebar-link {
            display:flex; align-items:center; padding:12px 15px; color:#555;
            text-decoration:none; border-radius:12px; margin-bottom:10px;
            transition:0.3s; font-weight:600;
        }
        .sidebar-link i { width:30px; color:var(--primary); }
        .sidebar-link:hover, .sidebar-link.active {
            background:#00a2e9 !important; color:white !important;
            box-shadow:0 4px 15px rgba(0,162,233,.4); transform:translateX(5px);
        }
        .sidebar-link:hover i, .sidebar-link.active i { color:white !important; }
        @media (max-width:991px) { .sidebar { position:relative;top:0;margin-bottom:30px; } }

        /* ══════════════════════════════════════════
           CONTENT CARDS
        ══════════════════════════════════════════ */
        .about-card {
            background:white; border-radius:25px; padding:40px;
            box-shadow:0 10px 40px rgba(0,0,0,0.04); margin-bottom:30px;
            /* GPU compositing — mencegah repaint saat gambar muncul */
            contain: layout;
        }
        @media (max-width:768px) { .about-card { padding:25px 20px;border-radius:20px; } }

        .section-badge {
            display:inline-block; padding:5px 15px;
            background:rgba(0,162,233,.1); color:var(--primary);
            border-radius:50px; font-weight:700; font-size:12px;
            margin-bottom:15px; text-transform:uppercase;
        }

        /* ══════════════════════════════════════════
           HEADER MINI
        ══════════════════════════════════════════ */
        .header-mini {
            background:linear-gradient(135deg,var(--dark-blue),var(--primary));
            padding:60px 0; color:white; margin-bottom:50px;
            border-radius:0 0 50px 50px;
        }
        @media (max-width:768px) {
            .header-mini { padding:40px 0;border-radius:0 0 30px 30px; }
            .header-mini h1 { font-size:2rem !important; }
        }

        /* ══════════════════════════════════════════
           MARQUEE
        ══════════════════════════════════════════ */
        marquee { background:var(--secondary);color:#000;padding:10px 0;font-weight:700;font-size:.85rem; }

        /* ══════════════════════════════════════════
           FOOTER
        ══════════════════════════════════════════ */
        .main-footer {
            background-color:#1a8a9d; color:white;
            padding:60px 0 0 0; font-size:0.85rem;
        }
        .footer-title { font-weight:700;margin-bottom:25px;text-transform:uppercase;font-size:0.95rem;letter-spacing:1px; }
        .text-description { line-height:1.6;color:rgba(255,255,255,.9);margin-bottom:20px; }
        .footer-link-list { list-style:none;padding:0; }
        .footer-link { color:rgba(255,255,255,.85);text-decoration:none;transition:all .3s;display:inline-block;margin-bottom:12px; }
        .footer-link:hover { color:#fff;transform:translateX(5px); }
        .contact-item { display:flex;align-items:center;margin-bottom:15px; }
        .contact-icon {
            width:30px;height:30px;border-radius:50%;display:flex;
            align-items:center;justify-content:center;margin-right:15px;
            font-size:.85rem;flex-shrink:0;color:white;transform:translateY(-2px);
        }
        .social-icon {
            width:38px;height:38px;color:white;border-radius:8px;
            display:flex;align-items:center;justify-content:center;
            text-decoration:none;transition:all .3s;font-size:1.1rem;
        }
        .social-icon:hover { transform:translateX(5px);filter:brightness(1.1);box-shadow:0 5px 15px rgba(0,0,0,.3); }
        .bg-telp { background-color:#4db34d; }
        .bg-phone { background-color:#e62e8a; }
        .bg-email { background-color:#f7941d; }
        .bg-facebook { background-color:#3b5998; }
        .bg-twitter { background-color:#55acee; }
        .bg-instagram { background:linear-gradient(45deg,#f09433,#e6683c,#dc2743,#bc1888); }
        .bg-tiktok { background-color:#000; }
        .bg-youtube { background-color:#fc2a2a; }
        .footer-bottom {
            background:rgba(0,0,0,.15); padding:25px 0; margin-top:50px;
            border-top:1px solid rgba(255,255,255,.1);
        }
        @media (max-width:768px) {
            .main-footer { padding:40px 0 0; }
            .footer-title { font-size:.9rem;margin-bottom:20px; }
            .text-description { font-size:.8rem; }
            .contact-item { font-size:.85rem; }
        }
    </style>
</head>

<body>
    <!-- ══ TOPBAR ══ -->
    <div class="container-fluid topbar py-2 d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt text-primary me-2"></i> 123 (Contact Center)</span>
                <span><i class="fas fa-envelope text-primary me-2"></i> info@plnjambi.id</span>
            </div>
            <div class="fw-bold text-secondary">
                <i class="far fa-clock me-1"></i>
                <?php date_default_timezone_set('Asia/Jakarta'); echo date('l, d F Y'); ?>
            </div>
        </div>
    </div>

    <!-- ══ NAVBAR ══ -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('assets/Logo_PLN.svg.png') }}" alt="Logo PLN">
                <div class="ms-3 lh-1">
                    <h1 class="h5 m-0 text-primary fw-800">PLN UP3 JAMBI</h1>
                    <small class="text-muted fw-bold" style="font-size:10px;letter-spacing:1px;">KELISTRIKAN
                        JAMBI</small>
                </div>
            </a>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Beranda</a></li>
                    <li class="nav-item"><a href="{{ route('tentang.kami') }}"
                            class="nav-link active{{ Request::is('tentang-kami') ? 'active' : '' }}">Tentang Kami</a></li>
                    <li class="nav-item ms-lg-3 d-flex align-items-center">
                        <a href="https://play.google.com/store/apps/details?id=com.icon.pln123&hl=id"
                            id="pln-mobile-link" title="PLN Mobile" target="_blank">
                            <img src="{{ asset('assets/pln_mobile.jpg') }}" alt="PLN Mobile"
                                style="width:35px;height:35px;border-radius:10px;object-fit:cover;box-shadow:0 4px 8px rgba(0,0,0,.15);transition:transform .2s;">
                        </a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('login') }}"
                            class="btn btn-outline-light border text-dark rounded-circle d-flex align-items-center justify-content-center"
                            style="width:42px;height:42px;">
                            <i class="fas fa-user-lock"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <button class="drawer-toggle" id="drawerToggle" aria-label="Menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    <!-- ══ MOBILE DRAWER ══ -->
    <div class="drawer-overlay" id="drawerOverlay"></div>
    <div class="drawer-panel" id="drawerPanel" role="dialog" aria-modal="true" aria-label="Menu Navigasi">
        <div class="drawer-header">
            <div class="drawer-logo">
                <div class="drawer-logo-text">
                    <h3>PLN UP3 JAMBI</h3>
                    <small>KELISTRIKAN JAMBI</small>
                </div>
            </div>
            <button class="drawer-close" id="drawerClose" aria-label="Tutup menu">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <nav class="drawer-body">
            <a href="{{ url('/') }}" class="drawer-nav-item"><i class="fas fa-home"></i><span>Beranda</span></a>
            <a href="{{ route('tentang.kami') }}" class="drawer-nav-item active"><i class="fas fa-building"></i><span>Tentang Kami</span></a>
            <div class="drawer-divider"></div>
            <a href="{{ route('profil.detail') }}" class="drawer-nav-item"><i class="fas fa-user"></i><span>Profil</span></a>
            <a href="{{ route('tentang.kami') }}" class="drawer-nav-item"><i class="fas fa-handshake"></i><span>Budaya PLN</span></a>
            <div class="drawer-divider"></div>
            <a href="{{ route('login') }}" class="drawer-nav-item"><i class="fas fa-user-lock"></i><span>Admin Login</span></a>
        </nav>
        <div class="drawer-footer">
            <a href="#" id="pln-mobile-link-drawer" class="pln-mobile-btn" target="_blank">
                <img src="{{ asset('assets/pln_mobile.jpg') }}" alt="PLN Mobile"
                     width="36" height="36" loading="lazy" decoding="async">
                <div>
                    <div style="font-size:.8rem;font-weight:700;">PLN Mobile</div>
                    <div style="font-size:.7rem;opacity:.8;">Download Sekarang</div>
                </div>
                <i class="fas fa-external-link-alt ms-auto" style="font-size:.8rem;opacity:.7;"></i>
            </a>
        </div>
    </div>

    <marquee scrollamount="6">⚡ LAYANAN LISTRIK JAMBI KINI LEBIH MUDAH DENGAN APLIKASI PLN MOBILE — DOWNLOAD DI PLAYSTORE & APPSTORE ⚡</marquee>

    <div class="header-mini text-center animate__animated animate__fadeIn">
        <div class="container">
            <h1 class="fw-800 display-5">Profil PLN UP3 JAMBI</h1>
            <p class="opacity-75">Struktur Organisasi & Sistem Kelistrikan</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row g-4">
            <!-- ══ SIDEBAR ══ -->
            <div class="col-lg-3">
                <div id="sidebar-nav" class="sidebar animate__animated animate__fadeInLeft">
                    <h6 class="fw-bold mb-4 text-uppercase small text-muted">Navigasi Profil</h6>
                    <nav class="nav flex-column p-0">
                        <a href="{{ route('tentang.kami') }}" class="sidebar-link">
                            <i class="fas fa-handshake"></i> BUDAYA PLN
                        </a>
                        <a href="{{ route('profil.detail') }}" class="sidebar-link active">
                            <i class="fas fa-user"></i> PROFIL
                        </a>
                    </nav>
                    <hr>
                    <div class="p-2 text-center">
                        <img src="{{ asset('assets/Logo_PLN.svg.png') }}" height="40"
                             class="mb-2 opacity-50" loading="lazy" decoding="async" alt="PLN">
                        <p class="small text-muted mb-0">Terus Terang Melayani Negeri</p>
                    </div>
                </div>
            </div>

            <!-- ══ MAIN CONTENT ══ -->
            <div class="col-lg-9">

                <!-- Struktur Organisasi -->
                <div id="Struktur-Organisasi" class="about-card animate__animated animate__fadeInUp">
                    <span class="section-badge">Organisasi</span>
                    <h3 class="fw-bold mb-4">Struktur Organisasi UP3</h3>
                    <div class="img-wrap p-3">
                        @if (isset($gambar_struktur) && $gambar_struktur)
                            <div class="img-skeleton-inner" aria-hidden="true">
                                <i class="fas fa-sitemap img-placeholder-icon"></i>
                            </div>
                            <img data-src="{{ asset($gambar_struktur) }}"
                                 src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'/%3E"
                                 class="lazy-img"
                                 alt="Struktur Organisasi"
                                 loading="lazy"
                                 decoding="async">
                        @else
                            <div class="py-5 text-center">
                                <i class="fas fa-image fa-3x mb-3 text-muted opacity-50"></i>
                                <p class="text-muted">Gambar tidak tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Struktur ULP -->
                <div id="Struktur-ULP" class="about-card animate__animated animate__fadeInUp">
                    <span class="section-badge">Unit Layanan</span>
                    <h3 class="fw-bold mb-4">Unit Layanan Pelanggan PLN Jambi</h3>
                    <div class="img-wrap p-3">
                        @if (isset($gambar_ulp) && $gambar_ulp)
                            <div class="img-skeleton-inner" aria-hidden="true">
                                <i class="fas fa-map-marked-alt img-placeholder-icon"></i>
                            </div>
                            <img data-src="{{ asset($gambar_ulp) }}"
                                 src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'/%3E"
                                 class="lazy-img"
                                 alt="Struktur ULP"
                                 loading="lazy"
                                 decoding="async">
                        @else
                            <div class="py-5 text-center">
                                <i class="fas fa-map-marked-alt fa-3x mb-3 text-muted opacity-50"></i>
                                <p class="text-muted">Gambar Struktur ULP tidak tersedia</p>
                            </div>
                        @endif
                    </div>
                    <div class="mt-3 p-3 bg-light rounded shadow-sm border-start border-warning border-3">
                        <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Menampilkan struktur manajemen Unit Layanan Pelanggan di bawah koordinasi UP3 Jambi.</small>
                    </div>
                </div>

                <!-- Data Pengusahaan -->
                <div id="Struktur-Pengusahaan" class="about-card animate__animated animate__fadeInUp">
                    <span class="section-badge">Bidang Pengusahaan</span>
                    <h3 class="fw-bold mb-4">Data Pengusahaan UP3 Jambi</h3>
                    <div class="img-wrap p-3">
                        @if (isset($gambar_pengusahaan) && $gambar_pengusahaan)
                            <div class="img-skeleton-inner" aria-hidden="true">
                                <i class="fas fa-chart-bar img-placeholder-icon"></i>
                            </div>
                            <img data-src="{{ asset($gambar_pengusahaan) }}"
                                 src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'/%3E"
                                 class="lazy-img"
                                 alt="Data Pengusahaan UP3 JAMBI"
                                 loading="lazy"
                                 decoding="async">
                        @else
                            <div class="py-5 text-center">
                                <i class="fas fa-chart-bar fa-3x mb-3 text-muted opacity-50"></i>
                                <p class="text-muted">Gambar Data Pengusahaan UP3 Jambi belum tersedia</p>
                            </div>
                        @endif
                    </div>
                    <div class="mt-3 p-3 bg-light rounded shadow-sm border-start border-info border-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle text-info me-2"></i>
                            <p class="mb-0 small text-muted">
                                Bagan ini menampilkan susunan manajemen untuk fungsi <strong>Niaga, Pemasaran, dan Pelayanan Pelanggan</strong> di lingkup PLN UP3 Jambi.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Sistem Kelistrikan -->
                <div id="Sistem-Kelistrikan" class="about-card animate__animated animate__fadeInUp">
                    <span class="section-badge">Infrastruktur</span>
                    <h3 class="fw-bold mb-4">Single Line Diagram & Sistem Kelistrikan</h3>
                    <div class="img-wrap p-3">
                        @if (isset($gambar_kelistrikan) && $gambar_kelistrikan)
                            <div class="img-skeleton-inner" aria-hidden="true">
                                <i class="fas fa-bolt img-placeholder-icon text-warning"></i>
                            </div>
                            <img data-src="{{ asset($gambar_kelistrikan) }}"
                                 src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'/%3E"
                                 class="lazy-img"
                                 alt="Sistem Kelistrikan UP3 Jambi"
                                 loading="lazy"
                                 decoding="async">
                        @else
                            <div class="py-5 text-center">
                                <i class="fas fa-bolt fa-3x mb-3 text-warning opacity-50"></i>
                                <p class="text-muted">Data Visual Sistem Kelistrikan Belum Tersedia</p>
                                <small class="text-muted">Peta jaringan atau diagram sistem belum diunggah.</small>
                            </div>
                        @endif
                    </div>
                    <div class="mt-3 p-3 bg-light rounded shadow-sm border-start border-danger border-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-charging-station fa-2x text-danger"></i>
                            </div>
                            <div class="col">
                                <p class="mb-0 small text-muted">
                                    Informasi ini mencakup <strong>Peta Jaringan Tegangan Menengah (JTM)</strong>, sebaran Gardu Induk, dan skema pasokan listrik di wilayah kerja PLN UP3 Jambi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Kinerja Tahunan -->
                <div id="Data-Pengusahaan" class="about-card animate__animated animate__fadeInUp">
                    <span class="section-badge">Statistik Tahunan</span>
                    <h3 class="fw-bold mb-4">Data Kinerja Pengusahaan PLN UP3 Jambi</h3>
                    <div class="img-wrap p-3 mb-4">
                        @if (isset($gambar_pengusahaan_tahunan) && $gambar_pengusahaan_tahunan)
                            <div class="img-skeleton-inner" aria-hidden="true">
                                <i class="fas fa-chart-line img-placeholder-icon text-primary"></i>
                            </div>
                            <img data-src="{{ asset($gambar_pengusahaan_tahunan) }}"
                                 src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'/%3E"
                                 class="lazy-img"
                                 alt="Data Pengusahaan Tahunan"
                                 loading="lazy"
                                 decoding="async">
                        @else
                            <div class="py-5 text-center bg-light rounded-3">
                                <i class="fas fa-chart-bar fa-3x mb-3 text-primary opacity-50"></i>
                                <p class="text-muted fw-bold">Grafik Tahunan Belum Tersedia</p>
                                <small class="text-muted">Silakan unggah data infografis pengusahaan terbaru di Admin Panel.</small>
                            </div>
                        @endif
                    </div>
                    <div class="mt-3 p-3 bg-light rounded shadow-sm border-start border-primary border-3">
                        <div class="d-flex align-items-top">
                            <i class="fas fa-history text-primary me-2 mt-1"></i>
                            <p class="mb-0 small text-muted">
                                Data di atas merupakan ringkasan eksekutif kinerja niaga dan pengusahaan yang diperbarui setiap periode tahunan untuk memantau tren perkembangan kelistrikan di Jambi.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Operating Distribution System -->
                <div id="Operating-System" class="about-card animate__animated animate__fadeInUp">
                    <span class="section-badge">Distribution Operations</span>
                    <h3 class="fw-bold mb-4">Operating Distribution System UP3 Jambi</h3>
                    <div class="img-wrap p-3">
                        @if (isset($gambar_operating_system) && $gambar_operating_system)
                            <div class="img-skeleton-inner" aria-hidden="true">
                                <i class="fas fa-network-wired img-placeholder-icon text-success"></i>
                            </div>
                            <img data-src="{{ asset($gambar_operating_system) }}"
                                 src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg'/%3E"
                                 class="lazy-img"
                                 alt="Operating Distribution System"
                                 loading="lazy"
                                 decoding="async">
                        @else
                            <div class="py-5 text-center">
                                <i class="fas fa-network-wired fa-3x mb-3 text-success opacity-50"></i>
                                <p class="mb-1 fw-bold text-muted">Skema Operasional Distribusi Belum Tersedia</p>
                                <small class="text-muted">Diagram kontrol atau alur operasi sistem belum diunggah.</small>
                            </div>
                        @endif
                    </div>
                    <div class="mt-3 p-3 bg-light rounded shadow-sm border-start border-success border-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-microchip text-success me-3 fa-lg"></i>
                            <p class="mb-0 small text-muted">
                                Sistem ini mengintegrasikan pengawasan <strong>Distribution Control Center (DCC)</strong> untuk memastikan kontinuitas pasokan listrik dan efisiensi manuver jaringan di wilayah UP3 Jambi.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ══ FOOTER ══ -->
    <footer class="main-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 pe-lg-5">
                    <img src="{{ asset('assets/Logo_PLN.svg.png') }}" height="60" class="mb-4"
                         alt="Logo PLN" loading="lazy" decoding="async">
                    <p class="text-description"><strong>PT PLN (Persero) UP3 Jambi</strong> berkomitmen memberikan pelayanan kelistrikan handal untuk Jambi yang lebih terang.</p>
                </div>
                <div class="col-lg-2 col-6">
                    <h5 class="footer-title">Navigasi</h5>
                    <ul class="footer-link-list">
                        <li><a href="{{ url('/') }}" class="footer-link">Beranda</a></li>
                        <li><a href="#berita" class="footer-link">Berita Terkini</a></li>
                        <li><a href="#" class="footer-link">Galeri Foto</a></li>
                        <li><a href="{{ route('tentang.kami') }}" class="footer-link">Tentang Kami</a></li>
                        <li><a href="{{ route('profil.detail') }}" class="footer-link">Profil</a></li>
                       <li><a href="{{ route('tentang.kami') }}" class="footer-link">Budaya PLN</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 pe-lg-5">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <div class="contact-item">
                        <div class="contact-icon bg-telp"><i class="fas fa-map-marker-alt"></i></div>
                        <span>Jl. Jenderal Urip Sumoharjo No.2, Jambi</span>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon bg-phone"><i class="fas fa-phone-alt"></i></div>
                        <span>Call Center: 123</span>
                    </div>
                </div>
                <div class="col-lg-3 pe-lg-1">
                    <h5 class="footer-title">Ikuti Kami</h5>
                    <div class="d-flex align-items-center mb-3"><a href="https://www.instagram.com/plnjambi/" target="_blank" class="social-icon bg-instagram me-3"><i class="fab fa-instagram"></i></a><span class="text-white">plnjambi</span></div>
                    <div class="d-flex align-items-center mb-3"><a href="https://www.facebook.com/mang.hemat" target="_blank" class="social-icon bg-facebook me-3"><i class="fab fa-facebook-f"></i></a><span class="text-white">plnjambii</span></div>
                   <div class="d-flex align-items-center mb-3">
                        <a href="https://x.com/JambiPln" target="_blank" 
                           class="social-icon me-3 d-flex align-items-center justify-content-center" 
                           style="background-color: #000; width: 38px; height: 38px; border-radius: 8px; text-decoration: none;">

                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512" fill="white">
                                <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                            </svg>

                        </a>
                        <span class="text-white">plnjambi</span>
                    </div>
                    <div class="d-flex align-items-center mb-3"><a href="https://www.tiktok.com/@pln.up3.jambi" target="_blank" class="social-icon bg-tiktok me-3"><i class="fab fa-tiktok"></i></a><span class="text-white">pln.up3.jambi</span></div>
                    <div class="d-flex align-items-center mb-3"><a href="https://www.youtube.com/@PLNUP3_JAMBI" class="social-icon bg-youtube me-3"><i class="fab fa-youtube"></i></a><span class="text-white">PLN UP3 Jambi Official</span></div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container text-center">
                <p class="mb-0 small opacity-75">© {{ date('Y') }} <strong>PT PLN (Persero) UP3 Jambi</strong>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS — defer otomatis karena di akhir body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>

    <script>
    // ══════════════════════════════════════════════════════════
    // 1. PLN Mobile URL Detection
    // ══════════════════════════════════════════════════════════
    (function () {
        var ua  = navigator.userAgent || navigator.vendor || window.opera;
        var url = /iPad|iPhone|iPod/.test(ua) && !window.MSStream
            ? 'https://apps.apple.com/nz/app/pln-mobile/id1299581030'
            : 'https://play.google.com/store/apps/details?id=com.icon.pln123&hl=id';
        var l  = document.getElementById('pln-mobile-link');
        var ld = document.getElementById('pln-mobile-link-drawer');
        if (l)  l.href  = url;
        if (ld) ld.href = url;
    })();

    // ══════════════════════════════════════════════════════════
    // 2. Lazy Image Loading via Intersection Observer
    //    → gambar hanya diunduh saat hampir masuk viewport
    //    → skeleton hilang + fade-in muncul setelah gambar siap
    // ══════════════════════════════════════════════════════════
    (function () {
        var imgs = document.querySelectorAll('img.lazy-img');
        if (!imgs.length) return;

        function loadImage(img) {
            var src = img.getAttribute('data-src');
            if (!src) return;

            img.src = src;

            img.addEventListener('load', function () {
                img.classList.add('loaded');
                // Sembunyikan skeleton di dalam wrapper yang sama
                var wrap = img.closest('.img-wrap');
                if (wrap) {
                    var sk = wrap.querySelector('.img-skeleton-inner');
                    if (sk) sk.classList.add('hidden');
                }
            }, { once: true });

            img.addEventListener('error', function () {
                // Gambar gagal dimuat — tampilkan pesan error di skeleton
                var wrap = img.closest('.img-wrap');
                if (wrap) {
                    var sk = wrap.querySelector('.img-skeleton-inner');
                    if (sk) {
                        sk.style.animation = 'none';
                        sk.style.background = '#f8f9fa';
                        sk.innerHTML = '<i class="fas fa-exclamation-triangle" style="font-size:2rem;color:#dc3545;opacity:.6;"></i><p style="color:#6c757d;font-size:.85rem;margin:.5rem 0 0;">Gambar tidak dapat dimuat</p>';
                    }
                }
                img.remove(); // hapus img rusak dari DOM
            }, { once: true });
        }

        // Gunakan IntersectionObserver jika tersedia (semua browser modern)
        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        loadImage(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                rootMargin: '200px 0px', // mulai load 200px sebelum masuk layar
                threshold: 0
            });

            imgs.forEach(function (img) { observer.observe(img); });
        } else {
            // Fallback: langsung load semua (browser lama)
            imgs.forEach(loadImage);
        }
    })();

    // ══════════════════════════════════════════════════════════
    // 3. Drawer Menu
    // ══════════════════════════════════════════════════════════
    (function () {
        var toggle  = document.getElementById('drawerToggle');
        var panel   = document.getElementById('drawerPanel');
        var overlay = document.getElementById('drawerOverlay');
        var closeBtn = document.getElementById('drawerClose');

        function openDrawer() {
            panel.classList.add('open');
            overlay.classList.add('show');
            toggle.classList.add('open');
            toggle.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }
        function closeDrawer() {
            panel.classList.remove('open');
            overlay.classList.remove('show');
            toggle.classList.remove('open');
            toggle.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }

        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
            panel.classList.contains('open') ? closeDrawer() : openDrawer();
        });
        overlay.addEventListener('click', closeDrawer);
        closeBtn.addEventListener('click', closeDrawer);
        panel.querySelectorAll('.drawer-nav-item').forEach(function (a) {
            a.addEventListener('click', function () { setTimeout(closeDrawer, 100); });
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && panel.classList.contains('open')) closeDrawer();
        });
    })();

    // ══════════════════════════════════════════════════════════
    // 4. Sidebar Active Link
    // ══════════════════════════════════════════════════════════
    document.querySelectorAll('.sidebar-link').forEach(function (link) {
        link.addEventListener('click', function () {
            document.querySelectorAll('.sidebar-link').forEach(function (l) {
                l.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
    </script>
</body>
</html>