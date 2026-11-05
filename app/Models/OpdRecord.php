<?php

// app/Models/OpdRecord.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OpdRecord extends Model {
    protected $fillable = ['dinas_sector_id','village_id','periode_tahun','tanggal','payload','lampiran','status'];
    protected $casts = ['payload'=>'array','lampiran'=>'array'];

    public function sectorOpd()  { return $this->belongsTo(DinasSector::class, 'dinas_sector_id'); }
    public function village()    { return $this->belongsTo(Village::class); }
}
