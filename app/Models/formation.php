<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'ordre',
        'image_formation',
    ];

    public function faq()
    {
        return $this->hasOne(Faq::class);
    }

    public function modules()
    {
        return $this->hasMany(module::class);
    }

    public function ressource()
    {
        return $this->hasOne(Ressource::class);
    }

    public function certificat()
    {
        return $this->hasOne(Certificat::class);
    }

}
