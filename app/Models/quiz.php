<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre',
        'module_id',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function module()
    {
        return $this->belongsTo(module::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function remembers()
    {
        return $this->hasMany(Remembers::class);
    }

    public function reponse_users()
    {
        return $this->hasMany(Reponse_user::class);
    }
}
