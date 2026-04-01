<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Tentang Kami - PLN UP3 JAMBI</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root {
            --primary: #00a2e9;
            --secondary: #ffc107;
            --dark-blue: #005691;
            --orange-pln: #ff6600;
            --light-bg: #f4f7f9;
        }
        
        body { font-family: 'Inter', sans-serif; background-color: var(--light-bg); color: #333; }
        h1, h2, h3, h5, .navbar-brand { font-family: 'Plus Jakarta Sans', sans-serif; }

        .navbar-brand img { height: 40px; }
        .sidebar { background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); position: sticky; top: 100px; }
        .sidebar-link { display: flex; align-items: center; padding: 12px 15px; color: #555; text-decoration: none; border-radius: 12px; margin-bottom: 10px; transition: 0.3s; font-weight: 600; }
        .sidebar-link i { width: 30px; color: var(--primary); }
        .sidebar-link:hover, .sidebar-link.active { background: var(--primary); color: white; }
        .sidebar-link:hover i, .sidebar-link.active i { color: white; }

        .about-card { background: white; border-radius: 25px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.04); margin-bottom: 30px; }
        .section-badge { display: inline-block; padding: 5px 15px; background: rgba(0, 162, 233, 0.1); color: var(--primary); border-radius: 50px; font-weight: 700; font-size: 12px; margin-bottom: 15px; text-transform: uppercase; }

        .main-footer { background: #1a1a1a; color: #ccc; padding-top: 60px; }
        .footer-bottom { background: #111; padding: 20px 0; border-top: 1px solid #222; }

        .header-mini { background: linear-gradient(135deg, var(--dark-blue), var(--primary)); padding: 60px 0; color: white; margin-bottom: 50px; border-radius: 0 0 50px 50px; }
        
        marquee { background: var(--secondary); color: #000; padding: 10px 0; font-weight: 700; }
    </style>
</head>

<body>
    <div class="container-fluid topbar py-2 d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt text-primary me-2"></i> 123 (Contact Center)</span>
                <span><i class="fas fa-envelope text-primary me-2"></i> info@plnjambi.id</span>
            </div>
            <div class="fw-bold text-secondary">
                <i class="far fa-clock me-1"></i> <?php date_default_timezone_set('Asia/Jakarta'); echo date('l, d F Y'); ?>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('assets/Logo_PLN.svg.png') }}" alt="Logo PLN">
                <div class="ms-3 lh-1">
                    <h1 class="h5 m-0 text-primary fw-800">PLN UP3 JAMBI</h1>
                    <small class="text-muted fw-bold" style="font-size: 10px; letter-spacing: 1px;">KELISTRIKAN JAMBI</small>
                </div>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Beranda</a></li>
                    <li class="nav-item"><a href="{{ route('tentang.kami') }}" class="nav-link {{ Request::is('tentang-kami') ? 'active' : '' }}"> Tentang Kami</a></li>
                    <li class="nav-item ms-lg-3"><a href="#" class="btn btn-primary px-4 rounded-pill text-white fw-bold shadow-sm w-100">PLN Mobile</a></li>
                    <li class="nav-item ms-lg-2">
                        <a href="{{ route('login') }}" class="btn btn-outline-light border text-dark rounded-circle d-none d-lg-flex align-items-center justify-content-center" style="width:42px; height:42px;">
                            <i class="fas fa-user-lock"></i> 
                        </a>
                        <a href="{{ route('login') }}" class="nav-link d-lg-none">
                            <i class="fas fa-lock me-2"></i> Admin Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <marquee scrollamount="6">⚡ LAYANAN LISTRIK JAMBI KINI LEBIH MUDAH DENGAN APLIKASI PLN MOBILE — DOWNLOAD DI PLAYSTORE & APPSTORE ⚡</marquee>

    <div class="header-mini text-center animate__animated animate__fadeIn">
        <div class="container">
            <h1 class="fw-800 display-5">Profil Perusahaan</h1>
            <p class="opacity-75">Mengenal lebih dekat PLN Unit Pelaksana Pelayanan Pelanggan Jambi</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row g-4">
            <div class="col-lg-3">
                <div class="sidebar animate__animated animate__fadeInLeft">
                    <h6 class="fw-bold mb-4 text-uppercase small text-muted">Navigasi Profil</h6>
                    <a href="#visi" class="sidebar-link active"><i class="fas fa-bullseye"></i> Visi & Misi</a>
                    <a href="#wilayah" class="sidebar-link"><i class="fas fa-map-marked-alt"></i> Wilayah Kerja</a>
                    <a href="#kontak" class="sidebar-link"><i class="fas fa-id-card"></i> Hubungi Kami</a>
                    <hr>
                    <div class="p-2 text-center">
                        <img src="{{ asset('assets/Logo_PLN.svg.png') }}" height="40" class="mb-2 opacity-50">
                        <p class="small text-muted mb-0">Terus Terang Melayani Negeri</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="about-card animate__animated animate__fadeInUp">
                    <span class="section-badge">Siapa Kami</span>
                    <h2 class="fw-800 mb-4">Menerangi Jambi, Menggerakkan Ekonomi</h2>
                    <p class="lead text-muted">PLN UP3 Jambi berkomitmen untuk menyediakan energi handal bagi seluruh pelosok Jambi.</p>
                </div>

                <div id="visi" class="about-card animate__animated animate__fadeInUp">
                    <span class="section-badge">Visi & Misi</span>
                    <h4 class="fw-bold"><i class="fas fa-eye text-warning me-2"></i> Visi Kami</h4>
                    <p class="text-muted">Menjadi Perusahaan Listrik Terkemuka se-Asia Tenggara dan #1 Pilihan Pelanggan untuk Solusi Energi.</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <div class="container text-center pb-5">
            <img src="{{ asset('assets/Logo_PLN.svg.png') }}" height="50" class="mb-4">
            <p class="small">© 2026 PT PLN (Persero) UP3 Jambi. All Rights Reserved.</p>
        </div>
        <div class="footer-bottom text-center">
            <p class="mb-0 small opacity-50">Daffa Alfareza - Arabica Newsletter Project</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>