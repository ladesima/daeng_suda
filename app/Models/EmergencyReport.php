<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyReport extends Model
{
    protected $table = 'emergency_reports';

    protected $fillable = [
        'tracking_code','nama','hp','email','kecamatan','desa','alamat',
        'kategori','severity','waktu','lat','lng','uraian','lampiran','status',
    ];

    protected $casts = [
        'waktu' => 'datetime',
        'lampiran' => 'array',
        'lat' => 'decimal:6',
        'lng' => 'decimal:6',
    ];
}
