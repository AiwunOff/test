<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'email',
        'password',
        'admin',
        'rgpd'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reponses()
    {
        return $this->belongsToMany(Reponse::class)->withTimestamps();
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class)->withTimestamps();;
    }

    public function isAdministrator()
    {
        return $this->where('admin', 1)->exists();
    }

    public function reponse_users()
    {
        return $this->hasMany(Reponse_user::class);
    }
}
