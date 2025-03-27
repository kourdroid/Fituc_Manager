<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id', 
        'founded_year',
        'background',
        'repertoire_style',
        'already_played',
        'actors_count'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
