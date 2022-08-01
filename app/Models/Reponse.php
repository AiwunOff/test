<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reponse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reponse',
        'is_correct',
        'question_id',
    ];

    public function users()
    {

        return $this->belongsToMany(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
