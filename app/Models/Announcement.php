<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','body','published_at','is_active'];
    protected $casts = [
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Opsional kalau pakai slug di URL:
    // public function getRouteKeyName(){ return 'slug'; }
}
