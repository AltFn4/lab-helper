<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'desc',
        'code',
        'link',
        'lab_id',
        'student_id',
        'assistant_id',
    ];

    public function student ()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function assistant ()
    {
        return $this->belongsTo(User::class, 'assistant_id');
    }

    public function lab ()
    {
        return $this->belongsTo(Lab::class);
    }
}
