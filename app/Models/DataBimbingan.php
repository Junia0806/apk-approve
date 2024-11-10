<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBimbingan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'data_bimbingans';

    // Primary key untuk tabel ini
    protected $primaryKey = 'id_bimbingan';

    // Menentukan apakah primary key auto-increment atau tidak
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Field yang dapat diisi secara mass-assignment
    protected $fillable = [
        'id_prodi',
        'id_dosen',
        'nim',
        'nama',
        'dosen',
        'tgl_bimbigan',
        'hari',
        'keperluan',
    ];

    // Mengatur timestamps, jika true maka otomatis mengisi created_at dan updated_at
    public $timestamps = true;

    // Relasi dengan model DataProdi
    public function prodi()
    {
        return $this->belongsTo(DataProdi::class, 'id_prodi');
    }

    // Relasi dengan model DataDosen
    public function dosen()
    {
        return $this->belongsTo(DataDosen::class, 'id_dosen');
    }
}
