<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['country', 'university', 'submission_date', 'troupe_name'];

    public function companyInfo()
    {
        return $this->hasOne(CompanyInfo::class);
    }

    public function technicalDetail()
    {
        return $this->hasOne(TechnicalDetail::class);
    }

    public function playDetail()
    {
        return $this->hasOne(PlayDetail::class);
    }

    public function participationHistories()
    {
        return $this->hasMany(ParticipationHistory::class);
    }

    public function upcomingPerformances()
    {
        return $this->hasMany(UpcomingPerformance::class);
    }

    public function contact()
    {
        return $this->hasOne(Contact::class);
    }

    public function castMembers()
    {
        return $this->hasMany(CastMember::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
