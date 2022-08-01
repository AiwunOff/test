<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question',
        'type',
        'ordre',
        'quiz_id',
    ];

    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }

    public function quiz()
    {
        return $this->belongsTo(quiz::class);
    }

}
