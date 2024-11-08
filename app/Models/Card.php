<?php

namespace App\Models;

use App\Enums\CardDifficulty;
use App\Enums\CardPlace;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'query',
        'answer',
        'reviewed_at',
        'place',
        'difficulty',
        'failed_reviews',
        'success_reviews',
        'note',
    ];

    protected $casts = [
        'difficulty' => CardDifficulty::class,
        'place' => CardPlace::class,
    ];

    public function deck(){
        return $this->belongsTo(Deck::class);
    }
}
