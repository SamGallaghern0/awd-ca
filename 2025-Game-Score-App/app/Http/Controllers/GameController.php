<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));   /*Brings user to the index page.*/
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('games.create');   /*Brings user to the create a game page.*/
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)   /*Requests to or from the database.*/
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required|max:100',
            'description' => 'required|max:500',
            'year' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/games'), $imageName);   /*Allows the user to select a file on their computer, or device, and put it in the images file so that it can be shown on the website.*/
        }
        Game::create([   /*Create*/
            'title' => $request->title,
            'genre' => $request->genre,
            'description' => $request->description,
            'year' => $request->year,
            'image' => $imageName,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return to_route('games.index')->with('success','Game created successfully!');   /*Returns the user to the incex page once a game is created.*/
    }

    public function show(Game $game)
    {
        return view('games.show')->with('game', $game);   /*Allows the contents of a game on the database to be shown on the website.*/
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        return view('games.edit')->with('game', $game);   /*Brings the user to the edit page.*/
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required|max:100',
            'description' => 'required|max:500',
            'year' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/games'), $imageName);   /*Roughly the same as when creating but instead it updates a game instead of creating one.*/
        }
        $game->update([   /*Updates instead of create*/
            'title' => $request->title,
            'genre' => $request->genre,
            'description' => $request->description,
            'year' => $request->year,
            'image' => $imageName,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return to_route('games.index', $game)->with('success','Game created updated!');   /*Also returns the user to the incex page once a game is updated.*/
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return to_route('games.index')->with('success','Game deleted successfully!');   /*Deletes a game from the database.*/
    }
}
