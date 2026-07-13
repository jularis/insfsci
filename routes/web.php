<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/l-institut', [PageController::class, 'institut'])->name('institut');
Route::get('/l-institut/{slug}', [PageController::class, 'institutDetail'])->name('institut.show');
Route::get('/etablissements', [PageController::class, 'etablissements'])->name('etablissements');
Route::get('/etablissements/{slug}', [PageController::class, 'etablissementDetail'])->name('etablissements.show');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/services/{slug}', [PageController::class, 'serviceDetail'])->name('services.show');
Route::get('/galerie', [PageController::class, 'galerie'])->name('galerie');
Route::get('/galerie/{slug}', [PageController::class, 'galerieDetail'])->name('galerie.show');
Route::get('/communiques', [PageController::class, 'communiques'])->name('communiques');
Route::get('/communiques/{slug}', [PageController::class, 'communiqueDetail'])->name('communiques.show');
Route::get('/actualites', [PageController::class, 'actualites'])->name('actualites');
Route::get('/actualites/{slug}', [PageController::class, 'actualiteDetail'])->name('actualites.show');
Route::get('/inscription', [PageController::class, 'inscription'])->name('inscription');
Route::get('/recrutement', [PageController::class, 'recrutement'])->name('recrutement');
Route::get('/recherche', [PageController::class, 'recherche'])->name('recherche');
Route::get('/contactez-nous', [PageController::class, 'contact'])->name('contact');
Route::post('/contactez-nous', [PageController::class, 'submitContact'])->name('contact.submit');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Sert les fichiers du disque public si le lien symbolique est absent sur le serveur
Route::get('/storage/{path}', function (string $path) {
    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }
    $fullPath = Storage::disk('public')->path($path);
    $mime = mime_content_type($fullPath) ?: 'application/octet-stream';
    return response()->file($fullPath, ['Content-Type' => $mime]);
})->where('path', '.*')->name('storage.serve');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
