<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['title', 'subtitle', 'image', 'order', 'is_active'];

    protected $appends = ['image_url'];

    /**
     * URL gambar slider siap pakai (mendukung public/uploads/sliders maupun legacy storage)
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('images/no-image.png');
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        // Jika tersimpan sebagai uploads/...
        if (str_starts_with($this->image, 'uploads/')) {
            return asset($this->image);
        }

        // Cek fisik di public/uploads/sliders/
        if (file_exists(public_path('uploads/sliders/' . basename($this->image)))) {
            return asset('uploads/sliders/' . basename($this->image));
        }

        // Cek fisik di public/uploads/
        if (file_exists(public_path('uploads/' . $this->image))) {
            return asset('uploads/' . $this->image);
        }

        // Cek fisik di public/storage/
        if (file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }

        return asset('uploads/sliders/' . basename($this->image));
    }
}
