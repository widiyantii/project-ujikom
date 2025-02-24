<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskList;

class Task extends Model
{
    // Kolom yang dapat diisi secara massal melalui metode seperti create()
    protected $fillable = [
        'name',
        'description',
        'is_completed',
        'priority',
        'list_id'
    ];

    // Kolom yang dilindungi dari mass assignment
    // Jika $fillable sudah ada, sebaiknya tidak menggunakan $guarded
    // protected $guarded = ['id', 'created_at', 'updated_at'];

    // Konstanta untuk nilai prioritas yang dapat digunakan dalam aplikasi
    const PRIORITIES = [
        'low',
        'medium',
        'high'
    ];

    // Accessor untuk mendapatkan kelas prioritas berdasarkan nilai priority
    public function getPriorityClassAttribute()
    {
        return match ($this->priority) {
            'low' => 'success',   // Hijau untuk prioritas rendah
            'medium' => 'dark', // hitam untuk prioritas menengah
            'high' => 'danger',   // Merah untuk prioritas tinggi
            default => 'secondary', // Warna default (abu-abu)
        };
    }


    // Relasi Many-to-One: Task milik TaskList
    public function list()
    {
        return $this->belongsTo(TaskList::class, 'list_id');
    }
}
