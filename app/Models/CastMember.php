<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CastMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'actor_number',
        'full_name',
        'passport_or_cin',
        'age',
        'role_in_play'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
