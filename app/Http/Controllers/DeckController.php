<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use App\Http\Requests\StoreDeckRequest;
use App\Http\Requests\UpdateDeckRequest;

class DeckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('deck.index', [
            'decks' => auth()->user()->decks()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('deck.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeckRequest $request)
    {
        auth()->user()->decks()->create($request->validated());

        return redirect()->route('deck.index')->with('success', 'Deck created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deck $deck)
    {
        return view('deck.show', [
            'deck' => $deck,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deck $deck)
    {
        return view('deck.edit', [
            'deck' => $deck,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeckRequest $request, Deck $deck)
    {
        $deck->update($request->validated());

        return redirect()->route('deck.index')->with('success', 'Deck updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deck $deck)
    {
        $deck->delete();

        return redirect()->route('deck.index')->with('success', 'Deck deleted successfully.');
    }

    public function review(Deck $deck){
        return view('deck.review', [
            'card' => $deck->firstRandomReviewableCard()
        ]);
    }
}
