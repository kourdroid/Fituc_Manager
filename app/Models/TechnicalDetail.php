<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicalDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'description',
        'scene_dimensions',
        'assembling_time',
        'disassembling_time',
        'lighting_plan',
        'sound_setup'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
