<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSesi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'data_sesis';

    // Primary key untuk tabel ini
    protected $primaryKey = 'id_sesi';

    // Menentukan apakah primary key auto-increment atau tidak
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Field yang dapat diisi secara mass-assignment
    protected $fillable = [
        'jam_awal',
        'jam_akhir',
    ];

    // Mengatur timestamps, jika true maka otomatis mengisi created_at dan updated_at
    public $timestamps = true;
}
