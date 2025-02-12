<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model untuk TaskList, menghubungkan tabel task_lists dengan Laravel Eloquent ORM
class TaskList extends Model
{
    // Kolom yang dapat diisi secara massal melalui metode seperti create()
    protected $fillable = ['name'];

    // Kolom yang dilindungi dari mass assignment
    // Jika menggunakan $fillable, $guarded sebaiknya tidak digunakan
    // protected $guarded = ['id', 'created_at', 'updated_at'];

    // Relasi One-to-Many: TaskList memiliki banyak Task
    public function tasks()
    {
        // Mendefinisikan relasi dengan model Task berdasarkan foreign key 'list_id'
        return $this->hasMany(Task::class, 'list_id');
    }
}
