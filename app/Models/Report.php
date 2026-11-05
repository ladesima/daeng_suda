<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'type',
        'reporter_name','reporter_phone','reporter_email',
        'village','district','address','lat','lng',
        'category','assistance_type','description','severity','urgency','occurred_at',
        'photos','attachments',
        'tracking_code','status','follow_up_note',
    ];

    protected $casts = [
        'photos'      => 'array',
        'attachments' => 'array',
        'occurred_at' => 'datetime',
    ];
}
