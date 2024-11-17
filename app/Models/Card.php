<?php

namespace App\Models;

use App\Enums\CardDifficulty;
use App\Enums\CardPlace;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function nextPlace(): CardPlace{
        return match($this->place){
            CardPlace::BOX1 => CardPlace::BOX2,
            CardPlace::BOX2 => CardPlace::BOX4,
            CardPlace::BOX4 => CardPlace::BOX8,
            CardPlace::BOX8 => CardPlace::BOX16,
            CardPlace::BOX16 => CardPlace::BOX_PASS
        };
    }

    public function difficultyText(): Attribute{
        return Attribute::make(
            get: function(mixed $value, array $attributes){return match((int)($attributes['difficulty'])){
                CardDifficulty::EASY => 'easy',
                CardDifficulty::MEDIUM => 'medium',
                CardDifficulty::HARD => 'hard',
            };}
        );
    }
}
