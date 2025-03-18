<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpcomingPerformance extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'performance_date',
        'performance_place'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
