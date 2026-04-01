<?php
function loadEnv($path) {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0 || !strpos($line, '=')) continue;
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}

// Memuat file .env
loadEnv(__DIR__ . '/.env');

// Variabel koneksi dari .env
$host = $_ENV['DB_HOST'] ?? 'localhost';
$user = $_ENV['DB_USERNAME'] ?? 'root';
$pass = $_ENV['DB_PASSWORD'] ?? '';
$db   = $_ENV['DB_DATABASE'] ?? 'arabica_news';

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 1. PENGATURAN PAGINATION
$batas = 9;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

// 2. PENGATURAN PENCARIAN & FILTER
$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : '';
$bulan  = isset($_GET['bulan']) ? mysqli_real_escape_string($koneksi, $_GET['bulan']) : '';
$tahun  = isset($_GET['tahun']) ? mysqli_real_escape_string($koneksi, $_GET['tahun']) : '';

$conditions = [];
if(!empty($search)){
    $conditions[] = "judul LIKE '%$search%'";
}
if(!empty($bulan)){
    $conditions[] = "MONTH(tanggal) = '$bulan'";
}
if(!empty($tahun)){
    $conditions[] = "YEAR(tanggal) = '$tahun'";
}

$where_clause = "";
if(count($conditions) > 0){
    $where_clause = "WHERE " . implode(' AND ', $conditions);
}

// 3. HITUNG TOTAL DATA
$query_total = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM berita $where_clause");
$row_total = mysqli_fetch_assoc($query_total);
$jumlah_data = $row_total['total'];
$total_halaman = ceil($jumlah_data / $batas);

// 4. AMBIL DATA BERITA
$query_berita = mysqli_query($koneksi, "SELECT * FROM berita $where_clause ORDER BY id DESC LIMIT $halaman_awal, $batas");

$data_berita = [];
while($row = mysqli_fetch_assoc($query_berita)) {
    $data_berita[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>PLN UP3 JAMBI - Berita PLN Edition</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
            --light-bg: #f8f9fa;
        }
        
        body { font-family: 'Inter', sans-serif; background-color: #ffffff; color: #333; overflow-x: hidden; }
        h1, h2, h5, .navbar-brand { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .topbar { background: #f8f9fa; font-size: 13px; border-bottom: 1px solid #eee; }
        .navbar { padding: 15px 0; transition: all 0.3s; }
        .navbar-brand img { height: 40px; }
        .nav-link { font-weight: 600; color: #444 !important; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }
        
        /* --- CAROUSEL --- */
        .carousel-item img { width: 100%; height: 80vh; object-fit: fill; filter: brightness(0.65); }
        .carousel-caption { bottom: 25%; text-align: center; width: 100%; left: 0; padding: 0 15px; }
        .carousel-caption h1 { font-size: calc(1.8rem + 2vw); font-weight: 800; letter-spacing: 15px; text-transform: uppercase; }

        @media (max-width: 768px) {
            .carousel-item img { height: 40vh; object-fit: cover; }
            .carousel-caption { top: 50% !important; left: 50% !important; transform: translate(-50%, -50%) !important; }
            .carousel-caption h1 { letter-spacing: 2px; font-size: 1.8rem; }
        }
        
        marquee { background: var(--secondary); padding: 10px 0; font-weight: 700; color: #000; font-size: 0.85rem; }

        .section-title { color: var(--dark-blue); font-weight: 800; margin-bottom: 40px; position: relative; font-size: 2rem; }
        .section-title::after { content: ''; width: 60px; height: 5px; background: var(--orange-pln); position: absolute; bottom: -12px; left: 50%; transform: translateX(-50%); border-radius: 10px; }

        /* --- SEARCH & FILTER BAR --- */
        .filter-wrapper {
            background: #fff;
            border-radius: 50px;
            padding: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
        }
        .filter-wrapper input, .filter-wrapper select {
            border: none;
            background: transparent;
            padding: 10px 15px;
            outline: none;
        }
        .filter-wrapper input { flex-grow: 1; border-right: 1px solid #eee; }
        .filter-wrapper select { width: 150px; border-right: 1px solid #eee; color: #666; cursor: pointer; }
        .filter-wrapper .btn-search {
            background: var(--primary);
            color: white;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            margin-left: 10px;
            transition: 0.3s;
        }
        .filter-wrapper .btn-search:hover { transform: scale(1.1); background: var(--dark-blue); }
        .btn-refresh {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #888;
            text-decoration: none;
            margin-left: 10px;
            transition: 0.3s;
        }
        .btn-refresh:hover { background: #f8f9fa; color: var(--primary); }

        @media (max-width: 992px) {
            .filter-wrapper { border-radius: 20px; flex-direction: column; padding: 15px; }
            .filter-wrapper input, .filter-wrapper select { width: 100%; border-right: none; border-bottom: 1px solid #eee; }
            .filter-wrapper .btn-search { width: 100%; border-radius: 10px; margin-top: 10px; margin-left: 0; }
            .btn-refresh { width: 100%; margin-left: 0; margin-top: 10px; border-radius: 10px; }
        }

        /* --- MASONRY LAYOUT PERBAIKAN MOBILE --- */
        .masonry-columns { 
            column-count: 3; 
            column-gap: 20px; 
        }

        /* Responsive Columns */
        @media (max-width: 992px) {
            .masonry-columns { column-count: 2; }
        }
        @media (max-width: 768px) {
            .masonry-columns { column-count: 1; } /* Menjadi 1 kolom untuk scroll ke bawah di HP */
            .section-title { font-size: 1.5rem; }
        }

        .masonry-item { break-inside: avoid; margin-bottom: 20px; position: relative; border-radius: 16px; overflow: hidden; transition: 0.4s; box-shadow: 0 4px 15px rgba(0,0,0,0.08); cursor: pointer; }
        .masonry-item:hover { transform: translateY(-8px); }
        .masonry-item img { width: 100%; display: block; transition: 0.5s; }
        .masonry-content { position: absolute; bottom: 0; left: 0; right: 0; padding: 20px; background: linear-gradient(to top, rgba(0,0,0,0.95), transparent); color: white; }

        .main-footer { background: #1a1a1a; color: #ccc; padding-top: 80px; }
        .footer-bottom { background: #111; padding: 25px 0; border-top: 1px solid #222; margin-top: 60px; }
        .map-container { border-radius: 24px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: 8px solid #fff; }
        .nav-btn { position: absolute; top: 50%; transform: translateY(-50%); background: white; border: none; width: 45px; height: 45px; border-radius: 50%; z-index: 100; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
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

    <div id="plnSlider" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/Arabica.jpeg" onerror="this.src='https://via.placeholder.com/1200x600?text=PLN+UP3+JAMBI'">
                <div class="carousel-caption">
                    <h1 class="animate__animated animate__fadeInDown">ARABICA NEWS</h1>
                    <p class="animate__animated animate__fadeInUp d-none d-md-block lead">Mengawal Kelistrikan untuk Jambi yang Lebih Terang</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5" id="berita">
        <div class="text-center mb-5">
            <h2 class="section-title">Galeri Berita Terkini</h2>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-lg-9">
                <form action="#berita" method="GET" class="d-flex flex-column flex-md-row align-items-center">
                    <div class="filter-wrapper flex-grow-1 w-100">
                        <input type="text" name="search" placeholder="Cari berita..." value="<?php echo htmlspecialchars($search); ?>" class="w-100">
                        <select name="bulan">
                            <option value="">Semua Bulan</option>
                            <?php 
                            $m_list = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
                            foreach($m_list as $key => $m_name) {
                                $m_val = $key + 1;
                                $sel = ($bulan == $m_val) ? 'selected' : '';
                                echo "<option value='$m_val' $sel>$m_name</option>";
                            }
                            ?>
                        </select>
                        <select name="tahun">
                            <option value="">Tahun</option>
                            <?php 
                            $curr_year = date('Y');
                            for($y = $curr_year; $y >= 2020; $y--) {
                                $sel_y = ($tahun == $y) ? 'selected' : '';
                                echo "<option value='$y' $sel_y>$y</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn-search d-none d-md-flex">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <div class="d-flex w-100 d-md-none mt-2">
                        <button type="submit" class="btn btn-primary flex-grow-1 rounded-3 py-2 me-2">Cari</button>
                        <a href="index.php#berita" class="btn btn-outline-secondary rounded-3 py-2"><i class="fas fa-sync-alt"></i></a>
                    </div>
                    <a href="index.php#berita" class="btn-refresh d-none d-md-flex" title="Reset">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                </form>
            </div>
        </div>

        <div class="masonry-columns animate__animated animate__fadeIn">
            <?php if(count($data_berita) > 0): ?>
                <?php foreach($data_berita as $index => $d): ?>
                <div class="masonry-item" onclick="openGallery(<?php echo $index; ?>)">
                    <img src="assets/<?php echo $d['gambar']; ?>" alt="Berita">
                    <div class="masonry-content">
                        <small class="text-warning fw-bold d-block mb-1">
                            <i class="far fa-calendar-alt me-1"></i> <?php echo date('d M Y', strtotime($d['tanggal'])); ?>
                        </small>
                        <h5 class="m-0"><?php echo $d['judul']; ?></h5>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center w-100 py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3 opacity-25">
                    <p class="text-muted">Tidak ada berita yang ditemukan.</p>
                </div>
            <?php endif; ?>
        </div>

        <?php if($total_halaman > 1): ?>
        <nav class="mt-5">
            <ul class="pagination justify-content-center">
                <?php for($x=1; $x<=$total_halaman; $x++): ?>
                    <li class="page-item <?php echo ($halaman == $x) ? 'active' : ''; ?>">
                        <a class="page-link border-0 shadow-sm mx-1 rounded-3 px-3" href="?halaman=<?php echo $x; ?>&search=<?php echo urlencode($search); ?>&bulan=<?php echo $bulan; ?>&tahun=<?php echo $tahun; ?>#berita"><?php echo $x; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
        <?php endif; ?>
    </div>

       <div class="container py-5">
    <div class="row g-4 align-items-center">
        <div class="col-lg-4">
            <h2 class="fw-800 mb-4">Lokasi Kantor</h2>
            <div class="mb-4">
                <div class="d-flex mb-3">
                    <i class="fas fa-map-marker-alt text-danger me-3 mt-1"></i>
                    <p class="text-muted mb-0">
                        Jl. Jenderal Urip Sumoharjo No.2, Sungai Putri, Kec. Danau Tlk., Kota Jambi, Jambi 36122
                    </p>
                </div>
                <div class="d-flex mb-3">
                    <i class="fas fa-clock text-primary me-3 mt-1"></i>
                    <p class="text-muted mb-0">
                        <strong>Jam Layanan:</strong><br>
                        Senin - Jumat: 08.00 - 16.00 WIB
                    </p>
                </div>
                <div class="d-flex mb-3">
                    <i class="fas fa-headset text-warning me-3 mt-1"></i>
                    <p class="text-muted mb-0">
                        <strong>Contact Center:</strong><br>
                        123 (Kode Area + 123)
                    </p>
                </div>
            </div>
            <hr class="mb-4">
            <a href="https://maps.google.com/?q=Kantor+PLN+UP3+Jambi" target="_blank" class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                <i class="fas fa-directions me-2"></i>Petunjuk Arah
            </a>
        </div>

        <div class="col-lg-8">
            <div class="map-wrapper" style="position: relative; padding: 12px; background: white; border-radius: 25px; box-shadow: 0 15px 40px rgba(0,0,0,0.08);">  
                <div class="rounded-4 overflow-hidden shadow-sm">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.243542283921!2d103.587217374033!3d-1.6101132362624472!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2586f5a6626deb%3A0x38b891b00cae7790!2sKantor%20PLN%20UP3%20Jambi!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid" 
                        width="100%" 
                        height="450" 
                        style="border:0; display: block;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="modalPexels" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered px-3">
            <div class="modal-content shadow-lg border-0">
                <div class="modal-header border-0 pb-0">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary rounded-circle text-white d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;"><i class="fas fa-bolt"></i></div>
                        <div><h6 class="mb-0 fw-bold">Admin PLN Jambi</h6><small class="text-muted" id="p-date"></small></div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body position-relative py-4 text-center">
                    <button class="nav-btn" style="left: 10px;" onclick="changeImage(-1)"><i class="fas fa-chevron-left"></i></button>
                    <button class="nav-btn" style="right: 10px;" onclick="changeImage(1)"><i class="fas fa-chevron-right"></i></button>
                    <img src="" id="p-img" class="w-100 rounded-3 mb-4 shadow-sm" style="max-height: 60vh; object-fit: contain;">
                    <h4 class="fw-bold text-dark px-2" id="p-title"></h4>
                </div>
                <div class="modal-footer border-0 p-4">
                    <a id="p-download" href="" download class="btn btn-dark w-100 py-3 rounded-pill fw-bold"><i class="fas fa-download me-2"></i> Download Gambar</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 text-center text-lg-start">
                    <img src="assets/Logo_PLN.svg.png" height="55" class="mb-4">
                    <p><strong>PT PLN (Persero) UP3 Jambi</strong> berkomitmen memberikan pelayanan kelistrikan handal untuk Jambi yang lebih terang.</p>
                </div>
                <div class="col-lg-2 text-center text-lg-start">
                    <h5 class="text-white mb-3">Navigasi</h5>
                    <a href="#" class="d-block text-decoration-none text-white mb-2">Beranda</a>
                    <a href="#berita" class="d-block text-decoration-none text-white mb-2">Berita</a>
                </div>
                <div class="col-lg-4 ms-auto text-center text-lg-start">
                    <h5 class="text-white mb-3">Kontak</h5>
                    <p class="small"><i class="fas fa-phone me-2"></i> 123<br><i class="fas fa-map-marker-alt me-2"></i> Jl. Urip Sumoharjo, Jambi</p>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center">
            <p class="mb-0 small opacity-75">© 2026 PT PLN (Persero) UP3 Jambi. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const items = <?php echo json_encode($data_berita); ?>;
        let currentIndex = 0;
        const myModal = new bootstrap.Modal(document.getElementById('modalPexels'));

        function openGallery(index) {
            currentIndex = index;
            updateModalContent();
            myModal.show();
        }

        function changeImage(step) {
            currentIndex += step;
            if (currentIndex >= items.length) currentIndex = 0;
            if (currentIndex < 0) currentIndex = items.length - 1;
            updateModalContent();
        }

        function updateModalContent() {
            if(items.length === 0) return;
            const data = items[currentIndex];
            document.getElementById('p-img').src = 'assets/' + data.gambar;
            document.getElementById('p-download').href = 'assets/' + data.gambar;
            document.getElementById('p-title').innerText = data.judul;
            document.getElementById('p-date').innerText = "Rilis: " + data.tanggal;
        }
    </script> 
</body>
</html>