<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\PublisherController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/games', [GameController::class, 'index'])->name('games.index');   /*To display or list all the games.*/
Route::get('/games/create', [GameController::class, 'create'])->name('games.create');   /*To show the from to create new games.*/
Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');   /*To show one specific game.*/
Route::post('/games', [GameController::class, 'store'])->name('games.store');   /*To store a new game on the database.*/

Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('games.edit');   /*To show the edit form so that data may be edited or cahnged on the database.*/
Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');   /*To update a game on the databse once done editing.*/
Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');   /*To delete a game.*/


Route::resource('scores', ScoreController::class)->except(['store']);

Route::post('/games/{game}/scores', [ScoreController::class, 'store'])->name('scores.store');

Route::resource('publishers', PublisherController::class)->middleware('auth');

Route::get('/publishers', [PublisherController::class, 'index'])->name('publishers.index');
Route::get('/publishers/create', [PublisherController::class, 'create'])->name('publishers.create');
Route::get('/publishers/{publisher}', [PublisherController::class, 'show'])->name('publishers.show');
Route::post('/publishers', [PublisherController::class, 'store'])->name('publishers.store');

Route::get('/publishers/{publisher}/edit', [PublisherController::class, 'edit'])->name('publishers.edit');
Route::put('/publishers/{publisher}', [PublisherController::class, 'update'])->name('publishers.update');
Route::delete('/publishers/{publisher}', [PublisherController::class, 'destroy'])->name('publishers.destroy');

require __DIR__.'/auth.php';