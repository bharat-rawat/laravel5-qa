<?php

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

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('question', 'QuestionController');
//Route::show('question/{slug}','QuestionController@show')->name('question.show');
Route::resource('question.answer','AnswerController');
Route::put('answer/{id}', function ($id) {
    $answer = App\Answer::find($id);
    $question = $answer->question;
    if(Auth::user()->id==$question->user_id){
    
        $question->best_answer_id = $id;
        $question->save();
        return back()->with('success','Best answer selected');
    }
    return back()->with('danger','You are not the originator of this question');
})->name('answer.accepted');

Route::post('/question/{question}/favourite', 'FavouriteController@store')->name('question.favourite');
Route::delete('/question/{question}/favourite', 'FavouriteController@destroy')->name('question.unfavourite');
Route::post('/question/{question}/vote','VoteController');
Route::post('/answer/{answer}/vote','VoteAnswerController');