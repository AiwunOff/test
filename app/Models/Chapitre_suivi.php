<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Chapitre_suivi extends Model
{
    use HasFactory;

    protected $fillable = [
        'chapitre_id',
        'user_id',
    ];
}
