<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends Model
{
    use HasFactory;

    protected $fillable = [
        'sector_id','nama','kecamatan','kepala_desa','kontak_person',
        'luas_wilayah_ha','jumlah_penduduk','kelompok_umkm',
        'pertanian','perkebunan','perikanan','peternakan','energi','pertambangan','lingkungan_hidup',
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
        'kehutanan'        => 'array',
        'lingkungan_hidup' => 'array',
        'data_pendukung'   => 'array',
    ];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
    public function opdRecords() {
        return $this->hasMany(\App\Models\OpdRecord::class);
    }

    public function esdmReports()
    {
        return $this->hasMany(\App\Models\EsdmReport::class);
    }
}
