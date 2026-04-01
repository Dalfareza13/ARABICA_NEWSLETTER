<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes - ARABICA NEWSLETTER (PLN UP3 JAMBI)
|--------------------------------------------------------------------------
*/

// --- HALAMAN PUBLIK ---
Route::get('/', function () {
    return view('index');
})->name('beranda');

Route::get('/tentang-kami', function () {
    return view('page.Tentang_kami');
})->name('tentang.kami');


// --- SISTEM AUTENTIKASI ---
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    }
    return view('Auth.login');
})->name('login');

// Route POST login untuk menangani error 'login.post not defined'
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
    ])->onlyInput('username');
})->name('login.post');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');


// --- HALAMAN ADMIN (DIPROTEKSI) ---
Route::middleware(['auth'])->group(function () {

    // 1. Dashboard Admin
    Route::get('/admin', function () {
        return view('page.admin');
    })->name('admin.dashboard');

    // 2. Kelola Berita (Mengambil data agar tidak error 'Undefined variable $berita')
    Route::get('/admin/kelola-berita', function () {
        $berita = DB::table('berita')->orderBy('id', 'desc')->get(); 
        return view('page.admin_kelola_berita', compact('berita'));
    })->name('admin.kelola_berita');

    // 3. Simpan Berita Baru
    Route::post('/admin/berita/simpan', function (Request $request) {
        DB::table('berita')->insert([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $request->gambar ?? 'default.png',
            'tanggal' => now(),
            'created_at' => now(),
        ]);
        return back()->with('success', 'Berita berhasil diterbitkan!');
    })->name('berita.store');

    // 4. Update Berita (MEMPERBAIKI ERROR 'berita.update not defined')
    Route::put('/admin/berita/update/{id}', function (Request $request, $id) {
        DB::table('berita')->where('id', $id)->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Berita berhasil diperbarui!');
    })->name('berita.update');

    // 5. Hapus Berita
    Route::delete('/admin/berita/hapus/{id}', function ($id) {
        DB::table('berita')->where('id', $id)->delete();
        return back()->with('success', 'Berita berhasil dihapus!');
    })->name('berita.delete');

});