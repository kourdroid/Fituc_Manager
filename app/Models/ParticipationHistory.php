<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'event_name',
        'event_country',
        'play_title',
        'prizes',
        'num_representations',
        'locations',
        'dates'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
