<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = ['nama','jabatan','nip','foto','atasan_id'];

    protected $appends = ['photo_url'];

    // Relasi self-referential
    public function atasan()
    {
        return $this->belongsTo(Employee::class, 'atasan_id');
    }

    public function bawahan()
    {
        return $this->hasMany(Employee::class, 'atasan_id');
    }

    // URL foto siap pakai dengan fallback ke public/uploads/employees
    public function getPhotoUrlAttribute(): string
    {
        if (empty($this->foto)) {
            return asset('images/default-avatar.svg');
        }

        if (str_starts_with($this->foto, 'http://') || str_starts_with($this->foto, 'https://')) {
            return $this->foto;
        }

        // Jika tersimpan sebagai uploads/...
        if (str_starts_with($this->foto, 'uploads/')) {
            return asset($this->foto);
        }

        // Cek fisik di public/uploads/employees/
        if (file_exists(public_path('uploads/employees/' . basename($this->foto)))) {
            return asset('uploads/employees/' . basename($this->foto));
        }

        // Cek fisik di public/uploads/
        if (file_exists(public_path('uploads/' . $this->foto))) {
            return asset('uploads/' . $this->foto);
        }

        // Cek fisik di public/storage/
        if (file_exists(public_path('storage/' . $this->foto))) {
            return asset('storage/' . $this->foto);
        }

        return asset('uploads/employees/' . basename($this->foto));
    }
}
