<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousPerformance extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'performance_number',
        'place',
        'performance_date',
    ];

    protected $casts = [
        'performance_date' => 'date',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
