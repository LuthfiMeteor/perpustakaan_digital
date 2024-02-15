<?php

namespace App\Models;
use App\Models\kategori;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    protected $table = "buku";

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori');
    }

}
