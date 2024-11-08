<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function cards(){
        return $this->hasMany(Card::class);
    }
}
