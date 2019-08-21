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

/**
 * 
 * Other than a controller, you can also return a view, a string, or even an
 * array that Laravel will convert to JSON for you :)
 *
 * Examples (commented out):
 * 
 */

// Route::get('/', function () {
//   return view('pages/index');
// });

// Route::get('/test', function() {
//   $test = App\School::all();
//   return $test; // return JSON to the browser.
// });

/**
 * More Notes:
 *
 * Route caching: https://laravel.com/docs/5.0/controllers#route-caching 
 * 
 */

// Homepage /
Route::get('/', 'SchoolsController@index'); 

// Province /provincial-report
Route::get('/provincial-results', 'SchoolDistrictsController@getProvinicialData');

// Directory page /all/[cities | school-districts]
Route::get('/all/cities', 'SchoolsController@getAllSchoolCities'); 
Route::get('/all/school-districts', 'SchoolDistrictsController@getAllSchoolDistricts'); 

// Directory results page /schools/in/[city | school-district]  
Route::get('/schools/in/{city}', 'SchoolsController@getAllSchoolsByCity'); 
Route::get('/schools/in-school-district/{sd}', 'SchoolsController@getAllSchoolsBySD'); 

// School page /school/[mincode]
Route::get('/school/{mincode}', 'SchoolsController@getSchool'); 
// School report page /school/[mincode]/report/[report_type]
Route::get('/school/{mincode}/report/{report_type}', 'SchoolsController@getSchoolReport');

// School District page /school-district/[school_district_ID]
Route::get('/school-district/{sdID}', 'SchoolDistrictsController@getSchoolDistrict'); 
// School District report page /school-district/[school_district_ID]/report/[report_type]
Route::get('/school-district/{sdID}/report/{report_type}', 'SchoolDistrictsController@getSdReport');

// Glossary /glossary
Route::get('/glossary', 'GlossaryController@getAllTerms');

// Glossary /glossary
Route::get('/enrolment-app', 'EnrolmentController@showEnrolment');
/**
 * API
 */

// Returns all schools and school districts with mincode (or sd) and name via JSON
Route::get('/api/v1/allSchoolsWithSchoolDistricts.json', 'SchoolsController@getAllSchoolsAndSchoolDistrictsJSON');

