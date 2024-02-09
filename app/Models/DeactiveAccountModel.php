<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeactiveAccountModel extends Model
{
    use HasFactory;
    protected $table = 'log_users_non_aktif';
    protected $guarded = [];
}
