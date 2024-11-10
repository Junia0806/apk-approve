<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataJadwal extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'data_jadwals';

    // Primary key untuk tabel ini
    protected $primaryKey = 'id_jadwal';

    // Menentukan apakah primary key auto-increment atau tidak
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Field yang dapat diisi secara mass-assignment
    protected $fillable = [
        'id_matkul',
        'id_sesi',
        'id_dosen',
        'hari',
    ];

    // Mengatur timestamps, jika true maka otomatis mengisi created_at dan updated_at
    public $timestamps = true;

    // Relasi ke model DataMatkul
    public function matkul()
    {
        return $this->belongsTo(DataMatkul::class, 'id_matkul');
    }

    // Relasi ke model DataSesi
    public function sesi()
    {
        return $this->belongsTo(DataSesi::class, 'id_sesi');
    }

    // Relasi ke model DataDosen
    public function dosen()
    {
        return $this->belongsTo(DataDosen::class, 'id_dosen');
    }
}
