<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EsdmReportAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'esdm_report_id',
        'file_path',
        'file_type',
        'original_name',
    ];

    protected $appends = [
        'file_url',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(EsdmReport::class, 'esdm_report_id');
    }

    /**
     * URL publik file lampiran (mendukung public/uploads maupun legacy storage)
     */
    public function getFileUrlAttribute(): string
    {
        if (empty($this->file_path)) {
            return asset('images/no-image.png');
        }

        if (str_starts_with($this->file_path, 'http://') || str_starts_with($this->file_path, 'https://')) {
            return $this->file_path;
        }

        // Jika tersimpan sebagai uploads/...
        if (str_starts_with($this->file_path, 'uploads/')) {
            return asset($this->file_path);
        }

        // Cek fisik di public/uploads/esdm-attachments/
        if (file_exists(public_path('uploads/esdm-attachments/' . basename($this->file_path)))) {
            return asset('uploads/esdm-attachments/' . basename($this->file_path));
        }

        // Cek fisik di public/uploads/
        if (file_exists(public_path('uploads/' . $this->file_path))) {
            return asset('uploads/' . $this->file_path);
        }

        // Cek fisik di public/storage/
        if (file_exists(public_path('storage/' . $this->file_path))) {
            return asset('storage/' . $this->file_path);
        }

        // Fallback langsung ke uploads/
        return asset('uploads/' . $this->file_path);
    }
}
