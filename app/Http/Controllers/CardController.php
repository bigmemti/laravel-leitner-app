<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Models\Deck;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Deck $deck)
    {
        return view('card.index', [
            'deck' => $deck,
            'cards' => $deck->cards,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Deck $deck)
    {
        return view('card.create', [
            'deck' => $deck,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCardRequest $request, Deck $deck)
    {
        $deck->cards()->create($request->validated());

        return redirect()->route('deck.card.index', ['deck' => $deck])->with('success', __('Card created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        return view('card.show', [
            'card' => $card->load('deck'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        return view('card.edit', [
            'card' => $card,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        $card->update($request->validated());

        return redirect()->route('deck.card.index', ['deck' => $card->deck])->with('success', __('Card updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        $deck = $card->deck;
        $card->delete();

        return redirect()->route('deck.card.index', ['deck' => $deck])->with('success', __('Card deleted successfully.'));
    }
}
