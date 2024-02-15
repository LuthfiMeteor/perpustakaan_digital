<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpEmailDeactiveModel extends Model
{
    use HasFactory;
    protected $table = 'non_aktif_otp';
    protected $guarded = [];
}
