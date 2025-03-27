<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'language',
        'premiere_date',
        'english_summary',
        'french_summary',
        'arabic_summary',
        'play_link'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
