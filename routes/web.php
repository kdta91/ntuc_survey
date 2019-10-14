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
    return view('home');
});

Route::get('/respondent/create', 'RespondentController@create')->name('respondent.create');
Route::post('/respondent', 'RespondentController@store');

Route::post('/survey/{page}', 'SurveyController@store')->middleware('checkrespondentdata');
Route::get('/survey/{page}', 'SurveyController@show')->middleware('checkrespondentdata');

Route::get('/free-gift', 'WinnerController@index')->middleware('checkrespondentdata');
Route::get('/get-lucky-number', 'WinnerController@drawPrize')->middleware('checkrespondentdata')->name('drawPrize');
Route::get('/thank-you', 'WinnerController@thankYou')->middleware('checkrespondentdata')->name('thankYou');
Route::get('/redeem-gift', 'WinnerController@clearSurveySession')->middleware('checkrespondentdata')->name('clearSurveySession');

// route to get the survey results
Route::get('/report', 'ReportController@index');
Route::get('/export-report', 'ReportController@exportReport')->name('exportReport');

// Verb	        URI	                        Action          Route Name
// ----------------------------------------------------------------------
// GET	        /photos	                    index	        photos.index
// GET	        /photos/create	            create	        photos.create
// POST	        /photos	                    store	        photos.store
// GET	        /photos/{photo}	            show	        photos.show
// GET	        /photos/{photo}/edit	    edit	        photos.edit
// PUT/PATCH	/photos/{photo}	            update	        photos.update
// DELETE	    /photos/{photo}	            destroy	        photos.destroy