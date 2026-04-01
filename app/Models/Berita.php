<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita'; // Nama tabel di database
    protected $fillable = ['judul', 'gambar', 'tanggal', 'isi'];
    public $timestamps = false; // Karena di kode awal tidak ada created_at/updated_at
}