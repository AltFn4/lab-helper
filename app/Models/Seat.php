<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    public function lab ()
    {
        return $this->belongsTo(Lab::class);
    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
