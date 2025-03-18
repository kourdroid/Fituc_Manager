<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'responsible_name',
        'address',
        'personal_phone',
        'work_phone',
        'fax',
        'email'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
