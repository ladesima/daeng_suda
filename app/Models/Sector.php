<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = [
        'name', 'slug', 'icon', 'summary', 'display_order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    // Optional: gunakan slug di route model binding
    public function getRouteKeyName()
    {
        return 'slug'; // hapus method ini jika tetap ingin pakai {sector} by id
    }

    public function potentials()
    {
        return $this->hasMany(Potential::class);
    }
    public function villages()
{
    return $this->hasMany(Village::class);
}

}
