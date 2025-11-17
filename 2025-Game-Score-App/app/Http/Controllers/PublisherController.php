<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::all();
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
        return view('publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'bio' => 'required|max:500',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('logo')) {
            $logoName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('logos/publishers'), $logoName);   /*Allows the user to select a file on their computer, or device, and put it in the images file so that it can be shown on the website.*/
        }
        Publisher::create([
            'name' => $request->name,
            'bio' => $request->bio,
            'logo' => $logoName,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return to_route('publishers.index')->with('success','Publisher added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        return view('publishers.show', compact('publisher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        return view('publishers.edit')->with('publisher', $publisher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $request->validate([
            'name' => 'required',
            'bio' => 'required|max:500',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('logo')) {
            $logoName = time().'.'.$request->logo->extension();
            $request->logo->move(public_path('logos/publishers'), $logoName);
        }
        $publisher->update([
            'name' => $request->name,
            'bio' => $request->bio,
            'logo' => $logoName,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return to_route('publishers.index', $publisher)->with('success','Publisher updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return to_route('publishers.index')->with('success','Publisher deleted successfully!');
    }
}
