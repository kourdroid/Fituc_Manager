<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'file_type',
        'file_path',
        'original_filename',
        'uploaded_at'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
