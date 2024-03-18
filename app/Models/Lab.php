<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    public function module ()
    {
        return $this->belongsTo(Module::class);
    }

    public function room ()
    {
        return $this->belongsTo(Room::class);
    }

    public function signoffs ()
    {
        return $this->hasMany(Signoff::class);
    }

    public function users ()
    {
        return $this->hasMany(User::class);
    }

    public function inquiries ()
    {
        return $this->hasMany(Inquiry::class);
    }
}
