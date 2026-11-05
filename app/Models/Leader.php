<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    use HasFactory;

    protected $table = 'leaders';

    protected $fillable = [
        'nama',
        'jabatan',
        'foto',
        'visi',
        'misi',
    ];

    protected $appends = ['photo_url'];

    /**
     * Get safe public photo URL with fallback to public/uploads/leaders
     */
    public function getPhotoUrlAttribute(): string
    {
        if (empty($this->foto)) {
            return asset('images/no-image.png');
        }

        if (str_starts_with($this->foto, 'http://') || str_starts_with($this->foto, 'https://')) {
            return $this->foto;
        }

        // Jika tersimpan sebagai uploads/...
        if (str_starts_with($this->foto, 'uploads/')) {
            return asset($this->foto);
        }

        // Cek fisik di public/uploads/leaders/
        if (file_exists(public_path('uploads/leaders/' . basename($this->foto)))) {
            return asset('uploads/leaders/' . basename($this->foto));
        }

        // Cek fisik di public/uploads/
        if (file_exists(public_path('uploads/' . $this->foto))) {
            return asset('uploads/' . $this->foto);
        }

        // Cek fisik di public/storage/
        if (file_exists(public_path('storage/' . $this->foto))) {
            return asset('storage/' . $this->foto);
        }

        return asset('uploads/leaders/' . basename($this->foto));
    }
}
