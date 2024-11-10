<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKampus extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'data_kampuses';

    // Primary key untuk tabel ini
    protected $primaryKey = 'id_kampus';

    // Menentukan apakah primary key auto-increment atau tidak (jika menggunakan `id_kampus` sebagai integer auto-increment)
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Field yang dapat diisi secara mass-assignment
    protected $fillable = [
        'kd_kampus',
        'nama_kampus',
        'alamat',
    ];

    // Mengatur timestamps, jika true maka otomatis mengisi created_at dan updated_at
    public $timestamps = true;
}
