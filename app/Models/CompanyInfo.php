<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;

    protected $fillable = ['application_id', 'presentation_text', 'repertoire', 'additional_info'];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
