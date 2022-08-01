<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre',
        'description',
        'ordre',
        'formation_id',
    ];

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    public function formation()
    {
        return $this->belongsTo(formation::class);
    }

    public function chapitres()
    {
        return $this->hasMany(chapitre::class);
    }

}
