<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Models\Psychologist;

Route::get( '/', function () {
	return redirect( 'auth/login' );
} );

Route::group( [ 'middleware' => 'auth', 'permissions' => 'manager' ], function () {
	Route::resource( 'visit', 'VisitController', [ 'except' => [ 'patch' ] ] );
	Route::resource( 'match', 'MatchController', [ 'except' => [ 'show', 'patch' ] ] );
	Route::resource( 'institute', 'InstituteController', [ 'except' => [ 'patch' ] ] );
    Route::resource( 'psychologist', 'PsychologistController', [ 'except' => [ 'patch' ] ] );


} );

Route::group( [ 'middleware' => 'auth', 'permissions' => 'user' ], function () {
	Route::resource( 'visit', 'VisitController', [ 'except' => [ 'patch' ] ] );
	Route::resource('match', 'MatchController', ['only' => ['index']]);
    Route::resource( 'institute', 'InstituteController', [ 'only' => [ 'show', 'index' ] ] );
	Route::resource( 'psychologist', 'PsychologistController', [ 'only' => [ 'index' ] ] );
	Route::resource( 'shapah', 'ShapahController', [ 'only' => [ 'show'] ] );
} );


Route::get( 'auth/login', function () {
	return view( 'forms.login' );
} );


Route::get( 'home', function () {
	return view( 'general.map' );
} );


Route::post( 'auth/login', [ 'as' => 'login', 'uses' => 'Auth\AuthController@postLogin' ] );
Route::post( 'auth/register', [ 'as' => 'register', 'uses' => 'Auth\AuthController@postRegister' ] );
Route::get( 'auth/logout', [ 'as' => 'logout', 'uses' => 'Auth\AuthController@getLogout' ] );

Route::get( 'map', function () {
	return view( 'general.map' );
} );


Route::get( 'institute_page', function () {
	return view( 'forms.institute_page' );
} );


Route::get( 'psyc-report', function () {
	return view( 'forms.psyc-report' );
} );


Route::get( 'calc', function () {
	return view( 'other.calc' );
} );

Route::get( 'delete-match', function () {
	return view( 'forms.delete_match' );
} );

Route::get( 'institute_page', function () {
	return view( 'forms.institute_page' );
} );


Route::get( 'institute_new', function () {
	return view( 'forms.institute_new' );
} );


Route::get( 'new_match', function () {
	return view( 'forms.new_match' );
} );



