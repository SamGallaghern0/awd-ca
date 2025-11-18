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
        return view('publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('publishers.index')->with('error', 'Access denied.');
        }
        $games = Game::all();
        return view('publishers.create', compact('games'));
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
            'games' => 'array',
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
        $publisher->load('games');
        return (view('publishers.show', compact('publisher')));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        $games = Game::all();
        $publisherGames = $publisher->games->pluck('id')->toArray();
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
            $publisher->games()->sync($request->games);
        }
        return redirect()->route('publishers.index')->with('success','Publisher updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->games()->detach();
        $publisher->delete();
        return redirect()->route('publishers.index')->with('success','Publisher deleted successfully!');
    }
}
