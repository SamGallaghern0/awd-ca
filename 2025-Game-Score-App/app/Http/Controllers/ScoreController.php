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
        ///*Scores doesn't get an index page as it only exsists to be added onto games which already has an index page.*/
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        ///*Surprisingly scores doesn't have a create page but instead gets a little form under show games.*/
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
            'game_id'=>$game->id    /*Game id is just the id of games under a new name as scores already has an id.*/
        ]);

        return redirect()->route('games.show', $game)->with('success', 'Score added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Score $score)
    {
        ///*Scores are already shown under shown games and there is no way to preview them all at the same time, i'm not sure you'd want to anyways.*/
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Score $score)
    {
        if (auth()->user()->id !== $score->user_id && auth()->user()->role !== 'admin') {
            return redirect()->route('games.index')->with('error', 'Access denied.');   /*Only allows the user who made the comment or admins to edit comments*/
        }
        return view('scores.edit', compact('score'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Score $score)
    {
        $score->update($request->only(['rating', 'comment']));
        return redirect()->route('games.show', $score->game_id)->with('success', 'Score updated successfully!');    /*Doesn't return the user to the index page but returns them to games.show on a selected game.*/
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
