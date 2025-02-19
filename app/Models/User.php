<?php

namespace App\Models;
// ✔ Menentukan bahwa model ini berada di dalam namespace App\Models, yang digunakan untuk mengorganisir kode dalam aplikasi Laravel.


// use Illuminate\Contracts\Auth\MustVerifyEmail;(mustiverifle email adalah  jika Butuh Verifikasi Email)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// ✔ HasFactory → Memungkinkan pembuatan data dummy (seeding) saat testing.
// ✔ Authenticatable → Model ini adalah turunan dari Authenticatable, yang digunakan dalam sistem autentikasi Laravel.
// ✔ Notifiable → Memungkinkan pengguna menerima notifikasi, misalnya email reset password.
class User extends Authenticatable
// ✔ Menandakan bahwa model User mewarisi Authenticatable, yang memungkinkan fitur autentikasi seperti login/logout.
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    // ✔ Menggunakan HasFactory untuk mendukung Factory (seeding).
    // ✔ Menggunakan Notifiable untuk mengaktifkan fitur notifikasi (email, database, dll.).
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    // ✔ Menentukan kolom mana yang boleh diisi secara massal (User::create([...])).
    // ✔ Melindungi dari Mass Assignment Vulnerability (keamanan data).
    // ✔ Jika kolom tidak termasuk di $fillable, Laravel akan menolak inputnya.
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    // ✔ Menyembunyikan kolom saat model dikonversi ke JSON atau array.
    // ✔ password → Agar tidak bocor dalam API response atau tampilan.
    // ✔ remember_token → Token yang digunakan untuk "remember me" login, agar tidak bisa diakses sembarangan.
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
// ✔ email_verified_at → Otomatis dikonversi menjadi objek DateTime untuk manipulasi tanggal.
// ✔ password → Laravel otomatis mengenkripsi password sebelum disimpan ke database.
