<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipModel extends Model
{
    use HasFactory;
    protected $table = 'membership';
    protected $guarded = [];

    protected $dates = ['mulai_membership', 'akhir_membership'];

    public function getStartMembershipDateAttribute()
    {
        return Carbon::parse($this->attributes['mulai_membership']);
    }

    public function getEndMembershipDateAttribute()
    {
        return Carbon::parse($this->attributes['akhir_membership']);
    }

    public function getPercentageDaysRemainingAttribute()
    {
        $currentDate = Carbon::now();
        $formatted_dt1=Carbon::parse($currentDate);
        $formatted_dt2=Carbon::parse($this->akhir_membership);
        $formatted_dt3=Carbon::parse($this->mulai_membership);
        $totalDays = $formatted_dt2->diffInDays($formatted_dt3); 
        $remainingDays = $formatted_dt2->diffInDays($formatted_dt1); 
        $percentage = ($remainingDays / $totalDays) * 100;
        $roundedPercentage = round($percentage);
        $percentageCrossedDays = 100 - $roundedPercentage;
        return $percentageCrossedDays;
    }
    
    public function getDaysRemainingFormattedAttribute()
    {
        $currentDate = Carbon::now();
        $formatted_dt1=Carbon::parse($currentDate);
        $formatted_dt2=Carbon::parse($this->akhir_membership);
        $remainingDays = $formatted_dt2->diffInDays($formatted_dt1); 
        return $remainingDays;
    }
    public function transaksi(){
        return $this->belongsTo(TransaksiModel::class);
    }
}
