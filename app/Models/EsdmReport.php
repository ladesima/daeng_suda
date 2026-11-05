<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EsdmReport extends Model
{
    use HasFactory;

    public const TYPE_PJU = 'pju';
    public const TYPE_BPBL = 'bpbl';
    public const TYPE_JARINGAN_LISTRIK = 'jaringan_listrik';
    public const TYPE_KEBUTUHAN_ENERGI = 'kebutuhan_energi';
    public const TYPE_PERMASALAHAN = 'permasalahan_lainnya';

    public const STATUS_BARU = 'baru';
    public const STATUS_VERIFIKASI = 'verifikasi';
    public const STATUS_PERBAIKAN = 'perbaikan';
    public const STATUS_TINDAK_LANJUT = 'tindak_lanjut';
    public const STATUS_DALAM_PROSES = 'dalam_proses';
    public const STATUS_SELESAI = 'selesai';

    protected $fillable = [
        'village_id',
        'user_id',
        'type',
        'status',
        'lokasi',
        'data',
        'keterangan',
        'tingkat_urgensi',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'data' => 'array',
        'verified_at' => 'datetime',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'verified_at' => 'datetime',
        ];
    }

    public static function typeLabels(): array
    {
        return [
            self::TYPE_PJU => 'Penerangan Jalan Umum (PJU)',
            self::TYPE_BPBL => 'Bantuan Pasang Baru Listrik (BPBL)',
            self::TYPE_JARINGAN_LISTRIK => 'Jaringan Listrik',
            self::TYPE_KEBUTUHAN_ENERGI => 'Kebutuhan Energi Masyarakat',
            self::TYPE_PERMASALAHAN => 'Permasalahan ESDM Lainnya',
        ];
    }

    public static function statusLabels(): array
    {
        return [
            self::STATUS_BARU => 'Baru',
            self::STATUS_VERIFIKASI => 'Verifikasi',
            self::STATUS_PERBAIKAN => 'Perbaikan',
            self::STATUS_TINDAK_LANJUT => 'Tindak Lanjut',
            self::STATUS_DALAM_PROSES => 'Dalam Proses',
            self::STATUS_SELESAI => 'Selesai',
        ];
    }

    public static function urgensiLabels(): array
    {
        return [
            'rendah' => 'Rendah',
            'sedang' => 'Sedang',
            'tinggi' => 'Tinggi / Mendesak',
        ];
    }

    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(EsdmReportAttachment::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(EsdmReportHistory::class)->orderByDesc('created_at');
    }

    public function getTypeLabelAttribute(): string
    {
        return self::typeLabels()[$this->type] ?? (string) $this->type;
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statusLabels()[$this->status] ?? (string) $this->status;
    }

    public function getUrgensiLabelAttribute(): string
    {
        return self::urgensiLabels()[$this->tingkat_urgensi] ?? (string) $this->tingkat_urgensi;
    }
}
