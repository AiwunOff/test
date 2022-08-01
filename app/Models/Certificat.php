<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'formation_id',
    ];

    public function formation()
    {
        return $this->belongsTo(formation::class);
    }
}
