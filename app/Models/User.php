<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    // Nonaktifkan timestamps otomatis (tabel hanya punya created_at)
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Gunakan 'username' sebagai identifier login (bukan 'email')
    public function getAuthIdentifierName(): string
    {
        return 'username';
    }

    // Nonaktifkan remember token karena kolom tidak ada di tabel
    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
        // Sengaja dikosongkan
    }

    public function getRememberTokenName()
    {
        return '';
    }
}