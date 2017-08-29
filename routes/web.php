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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/teams', 'TeamController@index')->name('teams');
Route::post('/teams/create', 'TeamController@create')->name('addTeam');
Route::get('/teams/{team}/edit', 'TeamController@edit')->name('editTeam');
Route::post('/teams/{team}/update', 'TeamController@update')->name('editTeam');
Route::get('/teams/{team}/delete', 'TeamController@destroy')->name('deleteTeam');

Route::get('/judges', 'JudgeController@index')->name('judges');
Route::post('/judges/create', 'JudgeController@create')->name('addJudge');
Route::get('/judges/{judge}/edit', 'JudgeController@edit')->name('editJudge');
Route::post('/judges/{judge}/update', 'JudgeController@update')->name('editJudge');
Route::get('/judges/{judge}/delete', 'JudgeController@destroy')->name('deleteJudge');

Route::get('/events', 'EventController@index')->name('events');
Route::post('/events/create', 'EventController@create')->name('addevent');
Route::get('/events/{event}/edit', 'EventController@edit')->name('editevent');
Route::post('/events/{event}/update', 'EventController@update')->name('editevent');
Route::get('/events/{event}/delete', 'EventController@destroy')->name('deleteJudge');
Route::get('/events/{event}/teams', 'EventController@teams')->name('eventTeams');
Route::get('/events/{event}/teams/{team}/add', 'EventController@addTeam')->name('eventAddTeam');
Route::get('/events/{event}/teams/{team}/remove', 'EventController@removeTeam')->name('eventRemoveTeam');
Route::get('/events/{event}/judges', 'EventController@judges')->name('eventTeams');
Route::get('/events/{event}/judges/{judge}/add', 'EventController@addJudge')->name('eventAddJudge');
Route::get('/events/{event}/judges/{judge}/remove', 'EventController@removeJudge')->name('eventRemoveJudge');
Route::get('/events/{event}/scores', 'EventController@scores')->name('eventScores');
Route::get('/events/{event}/judges', 'EventController@judges')->name('eventJudges');
Route::get('/events/{event}/rounds', 'EventController@rounds')->name('eventRounds');
Route::get('/events/{event}/rounds/{round}/add', 'EventController@addRound')->name('eventAddRound');
Route::get('/events/{event}/rounds/{round}/remove', 'EventController@removeRound')->name('eventRemoveRound');
Route::get('/events/{event}/addScorecard', 'EventController@addScorecard')->name('eventAddScorecard');
Route::post('/events/{event}/addScore', 'EventController@addScore')->name('eventAddScore');
Route::get('/events/{event}/resultsSheets', 'EventController@resultsSheets')->name('resultsSheets');
Route::get('/events/{event}/emailResultsSheets', 'EventController@emailResultsSheets')->name('emailResultsSheets');
Route::get('/events/{event}/judgeNotes', 'EventController@judgeNotes')->name('eventJudgeNotes');
Route::post('/events/{event}/addJudgeNote', 'EventController@addJudgeNote')->name('eventAddJudgeNote');
Route::get('/events/{event}/deleteComment/{note}', 'EventController@deleteJudgeNote')->name('eventDeleteJ	udgeNote');


Route::get('/rounds', 'RoundController@index')->name('rounds');
Route::post('/rounds/create', 'RoundController@create')->name('addRound');
Route::get('/rounds/{round}/edit', 'RoundController@edit')->name('editRound');
Route::post('/rounds/{round}/update', 'RoundController@update')->name('editRound');
Route::get('/rounds/{round}/delete', 'RoundController@destroy')->name('deleteRound');
Route::get('/rounds/{round}/orderUp', 'RoundController@orderUp')->name('roundOrderUp');
Route::get('/rounds/{round}/orderDown', 'RoundController@orderDown')->name('roundOrderDown');


