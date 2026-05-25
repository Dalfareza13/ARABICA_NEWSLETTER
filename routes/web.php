<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BeritaController;

/*
|--------------------------------------------------------------------------
| Web Routes - ARABICA NEWSLETTER (PLN UP3 JAMBI)
|--------------------------------------------------------------------------
*/

// --- HALAMAN PUBLIK ---
Route::get('/', [BeritaController::class, 'index'])->name('beranda');

Route::get('/tentang-kami', function () {
    $profil = DB::table('profil_perusahaan')->pluck('value_text', 'key_name');
    return view('page.Tentang_kami', compact('profil'));
})->name('tentang.kami');

Route::get('/profil-perusahaan', function () {
    $profil = DB::table('profil_perusahaan')->pluck('value_text', 'key_name');
    return view('page.Tentang_kami_Profil', [
        'profil'                     => $profil,
        'gambar_struktur'            => $profil['gambar_struktur'] ?? null,
        'gambar_ulp'                 => $profil['gambar_ulp'] ?? null,
        'gambar_pengusahaan'         => $profil['gambar_pengusahaan'] ?? null,
        'gambar_kelistrikan'         => $profil['gambar_kelistrikan'] ?? null,
        'gambar_pengusahaan_tahunan' => $profil['gambar_pengusahaan_tahunan'] ?? null,
        'gambar_operating_system'    => $profil['gambar_operating_system'] ?? null,
    ]);
})->name('profil.detail');


// --- SISTEM AUTENTIKASI ---
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    }
    return view('Auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin');
    }

    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ])->withInput($request->only('username'));
})->name('login.post');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');


// --- HALAMAN ADMIN (PROTECTED BY AUTH) ---
Route::middleware(['auth'])->group(function () {

    Route::get('/admin', function () {
        return view('page.admin');
    })->name('admin.dashboard');

    Route::get('/profil', function () {
        $profil = DB::table('profil_perusahaan')->pluck('value_text', 'key_name');
        return view('page.admin_profil', [
            'profil'                     => $profil,
            'gambar_struktur'            => $profil['gambar_struktur'] ?? null,
            'gambar_ulp'                 => $profil['gambar_ulp'] ?? null,
            'gambar_pengusahaan'         => $profil['gambar_pengusahaan'] ?? null,
            'gambar_kelistrikan'         => $profil['gambar_kelistrikan'] ?? null,
            'gambar_pengusahaan_tahunan' => $profil['gambar_pengusahaan_tahunan'] ?? null,
            'gambar_operating_system'    => $profil['gambar_operating_system'] ?? null,
        ]);
    })->name('admin.profil');

    // --- FUNGSI UPLOAD & HAPUS FILE LAMA ---
    function uploadGambarProfil(Request $request, $key, $prefix, $message) {
        $request->validate([
            $key => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($request->hasFile($key)) {
            // Ambil path file lama dari database
            $existing = DB::table('profil_perusahaan')
                ->where('key_name', $key)
                ->value('value_text');

            // Hapus file lama jika ada di server
            if ($existing && file_exists(public_path($existing))) {
                unlink(public_path($existing));
            }

            // Simpan file baru
            $file = $request->file($key);
            $nama_file = $prefix . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/uploads'), $nama_file);
            $path = 'assets/uploads/' . $nama_file;

            // Update atau insert record di database
            DB::table('profil_perusahaan')->updateOrInsert(
                ['key_name' => $key],
                ['value_text' => $path, 'updated_at' => now()]
            );

            return redirect()->back()->with('success', $message);
        }

        return redirect()->back()->with('error', 'Gagal mengunggah gambar.');
    }

    // --- ROUTE UPDATE GAMBAR ---
    Route::post('/profil/update-struktur', function (Request $request) {
        return uploadGambarProfil($request, 'gambar_struktur', 'up3', 'Struktur Organisasi UP3 berhasil diperbarui!');
    })->name('admin.profil.update_struktur');

    Route::post('/profil/update-ulp', function (Request $request) {
        return uploadGambarProfil($request, 'gambar_ulp', 'ulp', 'Struktur Organisasi ULP berhasil diperbarui!');
    })->name('admin.profil.update_ulp');

    Route::post('/profil/update-pengusahaan', function (Request $request) {
        return uploadGambarProfil($request, 'gambar_pengusahaan', 'pengusahaan', 'Data Pengusahaan UP3 Jambi diperbarui!');
    })->name('admin.profil.update_pengusahaan');

    Route::post('/profil/update-kelistrikan', function (Request $request) {
        return uploadGambarProfil($request, 'gambar_kelistrikan', 'sistem', 'Skema Sistem Kelistrikan diperbarui!');
    })->name('admin.profil.update_kelistrikan');

    Route::post('/profil/update-pengusahaan_tahunan', function (Request $request) {
        return uploadGambarProfil($request, 'gambar_pengusahaan_tahunan', 'tahunan', 'Data Pengusahaan Tahunan diperbarui!');
    })->name('admin.profil.update_pengusahaan_tahunan');

    Route::post('/profil/update-operating-system', function (Request $request) {
        return uploadGambarProfil($request, 'gambar_operating_system', 'os', 'Data Operating System diperbarui!');
    })->name('admin.profil.update_operating_system');


    // --- KELOLA BERITA ---
    Route::get('/admin/kelola-berita', function () {
        $berita = DB::table('berita')->orderBy('id', 'desc')->get();
        return view('page.admin_kelola_berita', compact('berita'));
    })->name('admin.kelola_berita');

    Route::post('/admin/berita/simpan', [BeritaController::class, 'store'])->name('berita.store');
    Route::delete('/admin/berita/hapus/{id}', [BeritaController::class, 'destroy'])->name('berita.delete');
    Route::put('/admin/berita/update/{id}', [BeritaController::class, 'update'])->name('berita.update');
});