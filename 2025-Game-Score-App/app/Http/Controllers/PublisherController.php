<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::with('games')->get();
        return view('publishers.index', compact('publishers')); /*Brings the user to an index page with all the publishers displayed on it.*/
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('publishers.index')->with('error', 'Access denied.');  /*Only allows users with the admin role access the create publisher page.*/
        }
        $games = Game::all();
        return view('publishers.create', compact('games'));  /*Brings the user to a page with a form which allows users to add a publisher, only works if the user has the admin role.*/
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'bio' => 'required|max:500',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'games' => 'array', /*Stores all the games accosiated with the publishers in an array, also grabs it from the id's or name's from the games table.*/
        ]);
        if ($request->hasFile('logo')) {
            $logoName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('logos/publishers'), $logoName);   /*Allows the user to select a file on their computer, or device, and put it in the images file so that it can be shown on the website.*/
            $validated['logo'] = $logoName;
        }
        $publisher = Publisher::create($validated);
        if ($request->has('games')) {
            $publisher->games()->attach($request->games);
        }
        return redirect()->route('publishers.index')->with('success','Publisher added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        $publisher->load('games');  /*Loads games related to the publisher, uses the table game_publisher from the database.*/
        return (view('publishers.show', compact('publisher')));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        $games = Game::all();
        $publisherGames = $publisher->games->pluck('id')->toArray();    /*This code grabs all the games from the games table and displays them in an array so that they can be selected as associated games when editing the publisher table.*/
        return view('publishers.edit', compact('publisher', 'games', 'publisherGames'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $validated = $request->validate([
            'name' => 'required',
            'bio' => 'required|max:500',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'games' => 'array',
        ]);
        if ($request->hasFile('logo')) {
            $logoName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('logos/publishers'), $logoName);   /*Allows the user to select a file on their computer, or device, and put it in the images file so that it can be shown on the website.*/
            $validated['logo'] = $logoName;
        }
        $publisher->update($validated);
        if ($request->has('games')) {
            $publisher->games()->sync($request->games); /*This code sends the updated data back to the database which both updates the publisher table and the games_publisher table.*/
        }
        return redirect()->route('publishers.index')->with('success','Publisher updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->games()->detach();  /*When a publisher is deleted it is detatched from the games it is associated with along with its connection to the games_publisher table.*/
        $publisher->delete();
        return redirect()->route('publishers.index')->with('success','Publisher deleted successfully!');
    }
}
