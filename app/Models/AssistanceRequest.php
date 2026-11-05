<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssistanceRequest extends Model
{
    protected $fillable = [
        'kode','nama','hp','email','kecamatan','desa','alamat',
        'jenis','urgency','lat','lng','uraian','lampiran','status',
    ];

    protected $casts = [
        'lampiran' => 'array',
        'lat'      => 'decimal:6',
        'lng'      => 'decimal:6',
    ];
}
