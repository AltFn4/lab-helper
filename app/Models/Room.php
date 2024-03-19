<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function seats ()
    {
        return $this->hasMany(Seat::class);
    }

    public function lab ()
    {
        return $this->hasOne(Lab::class);
    }
}
