<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    public function labs ()
    {
        return $this->hasMany(Lab::class);
    }

    public function users ()
    {
        return $this->hasMany(User::class);
    }
}
