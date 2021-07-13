<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VotesController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('questions', QuestionController::class)->except('show');
Route::get('/questions/{slug}',[QuestionController::class, 'show'])->name('questions.show');
Route::resource('questions.answers', AnswerController::class)->except(['index','show','create']);
Route::put('answers/{answer}/best-answer',[AnswerController::class, 'bestAnswer'])->name('answers.bestAnswer');
Route::post('questions/{question}/favorite',[FavouriteController::class, 'store'])->name('questions.favorite');
Route::delete('questions/{question}/unfavorite',[FavouriteController::class, 'destroy'])->name('questions.unfavorite');
Route::post('questions/{question}/vote/{vote}', [VotesController::class,'voteQuestion'])->name('questions.vote');
Route::post('answers/{answer}/vote/{vote}', [VotesController::class,'voteAnswer'])->name('answers.vote');
Route::get('users/notifications', [\App\Http\Controllers\UsersController::class, 'notifications'])->name('users.notifications');
