<?php

namespace App\Models;

use App\Enums\CardPlace;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Deck extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function cards(){
        return $this->hasMany(Card::class);
    }

    public function firstRandomReviewableCard(){
        return $this->randomReviewableCards()->first();
    }

    public function randomReviewableCards() {
        return $this->reviewableCards()
                    ->inRandomOrder();
    }

    public function countReviewableCards() {
        return $this->reviewableCards()->count();
    }

    public function reviewableCards(){
        $now = Carbon::now();

        return $this->cards()
                    ->where(function($query) use ($now){
                        $query->whereNull('reviewed_at')
                        ->where('created_at', '<=', $now->copy()->today()->startOfDay());

                        $query->orWhere(function ($subQuery) use ($now){
                            $subQuery->whereNotNull('reviewed_at')
                            ->where('reviewed_at', '<=', DB::raw("DATE_SUB(CURDATE(), INTERVAL (place - 1) DAY)"));
                        });})
                    ->where('place', '!=', CardPlace::BOX_PASS);
    }

    public function status() {
        $places = array_column(CardPlace::cases(), 'value');
        $cardCounts = $this->cards()
        ->select('place')
        ->get()
        ->groupBy('place')
        ->map->count();
        return collect($places)->mapWithKeys(fn ($place) => [$place => $cardCounts->get($place, 0)]);
    }
}
