<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function lab ()
    {
        return $this->belongsTo(Lab::class);
    }

    public function seat ()
    {
        return $this->hasOne(Seat::class);
    }

    public function inquiry ()
    {
        return $this->hasOne(Inquiry::class, $this->hasRole('student') ? 'student_id' : 'assistant_id');
    }

    public function signoffs ()
    {
        return $this->hasMany(Signoff::class);
    }

    public function modules ()
    {
        return $this->hasMany(Module::class);
    }
}
