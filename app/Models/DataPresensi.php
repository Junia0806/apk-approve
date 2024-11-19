<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DataDosen;


class DataPresensi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'data_presensis';

    // Primary key untuk tabel ini
    protected $primaryKey = 'id_presensi';

    // Menentukan apakah primary key auto-increment atau tidak
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Field yang dapat diisi secara mass-assignment
    protected $fillable = [
        'id_dosen',
        'tgl_presensi',
        'hari',
        'status',
    ];
    public function dosen()
    {
        return $this->belongsTo(DataDosen::class, 'id_dosen', 'id_dosen');
    }
    
    // Mengatur timestamps, jika true maka otomatis mengisi created_at dan updated_at
    public $timestamps = true;
}
