<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use App\Models\Game;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Game $game)
    {
      //  dd($game);
        $request->validate([
            'rating'=>'required|integer|min:1|max:5',
            'comment'=>'nullable|string|max:100',
        ]);

        $game->scores()->create([
            'user_id'=>auth()->id(),
            'rating'=>$request->input('rating'),
            'comment'=>$request->input('comment'),
            'game_id'=>$game->id
        ]);

        return redirect()->route('games.show', $game)->with('success', 'Score added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Score $score)
    {
        if (auth()->user()->id !== $score->user_id && auth()->user()->role !== 'admin') {
            return redirect()->route('games.index')->with('error', 'Access denied.');
        }
        return view('scores.edit', compact('score'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Score $score)
    {
        $score->update($request->only(['rating', 'comment']));
        return redirect()->route('games.show', $score->game_id)->with('success', 'Score updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score)
    {
        $score->delete();
        return to_route('games.index')->with('success','Score deleted successfully!');
    }
}
