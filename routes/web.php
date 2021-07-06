<?php

use App\Http\Controllers\QuestionnaireController;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/questionnaire/submit', [QuestionnaireController::class, 'submit'])->middleware('can:user');
    Route::get('/questionnaire/{id}/show', [QuestionnaireController::class, 'show'])->middleware('can:user');
    Route::get('/questionnaire/create', [QuestionnaireController::class, 'create'])->middleware('can:admin');
    Route::post('/questionnaire/store', [QuestionnaireController::class, 'store'])->middleware('can:admin');
});

