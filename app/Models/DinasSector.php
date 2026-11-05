<?php

// app/Models/DinasSector.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DinasSector extends Model {
    protected $fillable = ['nama','slug','group_key','icon','summary','form_schema','display_order','is_active'];
    protected $casts = ['form_schema'=>'array','is_active'=>'boolean','display_order'=>'integer'];
    public function getRouteKeyName(){ return 'slug'; }

    public function records() {
        return $this->hasMany(OpdRecord::class, 'dinas_sector_id');
    }
}