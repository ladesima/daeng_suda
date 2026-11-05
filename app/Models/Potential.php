<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Potential extends Model
{
    protected $fillable = [
        // relasi lama tetap (mis. 'sector_id','title', dsb—tambahkan sesuai punyamu)
        'sector_id','title','slug','excerpt','content',

        // A. Identitas
        'desa','kecamatan','kepala_desa','kontak_person','luas_wilayah_ha','jumlah_penduduk','kelompok_umkm',

        // B. Bidang (JSON)
        'pertanian','perkebunan','perikanan','peternakan','energi','pertambangan','lingkungan_hidup',

        // C. Pendukung
        'data_pendukung',
    ];

    protected $casts = [
        'luas_wilayah_ha'  => 'decimal:2',
        'jumlah_penduduk'  => 'integer',

        'pertanian'        => 'array',
        'perkebunan'       => 'array',
        'perikanan'        => 'array',
        'peternakan'       => 'array',
        'energi'           => 'array',
        'pertambangan'     => 'array',
        'lingkungan_hidup' => 'array',

        'data_pendukung'   => 'array',
    ];

    // contoh relasi lama
    public function sector() { return $this->belongsTo(Sector::class); }
}
