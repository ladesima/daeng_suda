<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EsdmReportHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'esdm_report_id',
        'user_id',
        'from_status',
        'to_status',
        'catatan',
        'instansi_koordinasi',
        'hasil_koordinasi',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(EsdmReport::class, 'esdm_report_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
