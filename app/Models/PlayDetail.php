<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'play_title',
        'director',
        'author',
        'duration',
        'summary',
        'play_link'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
