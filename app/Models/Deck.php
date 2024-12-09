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

    public function firstReviewableCard(){
        return $this->reviewableCards()->first();
    }

    public function reviewableCards(){
        $now = Carbon::now();

        return $this->cards()
            ->where(function($query) use ($now){
                $query->whereNull('reviewed_at')
                ->where('created_at', '<=', $now->copy()->today()->startOfDay());

                $query->orWhere(function ($subQuery) use ($now){
                    $subQuery->whereNotNull('reviewed_at')
                    ->where('reviewed_at', '<=', DB::raw("DATE_SUB(CURDATE(), INTERVAL place DAY)"));
                });})
            ->where('place', '!=', CardPlace::BOX_PASS)
            ->inRandomOrder();
    }
}
