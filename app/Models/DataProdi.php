<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProdi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'data_prodis';

    // Primary key untuk tabel ini
    protected $primaryKey = 'id_prodi';

    // Menentukan apakah primary key auto-increment atau tidak
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Field yang dapat diisi secara mass-assignment
    protected $fillable = [
        'id_kampus',
        'kd_prodi',
        'prodi',
        'jurusan',
        'kampus',
    ];

    // Mengatur timestamps, jika true maka otomatis mengisi created_at dan updated_at
    public $timestamps = true;

    // Relasi dengan model DataKampus
    public function kampus()
    {
        return $this->belongsTo(DataKampus::class, 'id_kampus', 'id_kampus');
    }
}
