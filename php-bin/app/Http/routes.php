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
//Route::get('/provincial-results-api', 'SchoolDistrictsController@getProvinicialDataApi');

// Directory page /all/[cities | school-districts]
Route::get('/all/cities', 'SchoolsController@getAllSchoolCities'); 
//Route::get('/all/cities-api', 'SchoolsController@getAllSchoolCitiesApi'); 
// Test
Route::get('/district-test', 'SchoolDistrictsController@index');
Route::get('/all/school-districts', 'SchoolDistrictsController@getAllSchoolDistricts'); 
//Route::get('/all/school-districts-api', 'SchoolDistrictsController@getAllSchoolDistrictsApi'); 

// Directory results page /schools/in/[city | school-district]  
Route::get('/schools/in/{city}', 'SchoolsController@getAllSchoolsByCity'); 
//Route::get('/schools-api/in/{city}', 'SchoolsController@getAllSchoolsByCityApi'); 
Route::get('/schools/in-school-district/{sd}', 'SchoolsController@getAllSchoolsBySD'); 
//Route::get('/schools-api/in-school-district/{sd}', 'SchoolsController@getAllSchoolsBySDApi'); 

// School page /school/[mincode]
Route::get('/school/{mincode}', 'SchoolsController@getSchool'); 
//Route::get('/school-api/{mincode}', 'SchoolsController@getSchoolApi'); 
// School report page /school/[mincode]/report/[report_type]
Route::get('/school/{mincode}/report/{report_type}', 'SchoolsController@getSchoolReport');
//Route::get('/school-api/{mincode}/report/{report_type}', 'SchoolsController@getSchoolReportApi');

// School District page /school-district/[school_district_ID]
Route::get('/school-district/{sdID}', 'SchoolDistrictsController@getSchoolDistrict'); 
//Route::get('/school-district-api/{sdID}', 'SchoolDistrictsController@getSchoolDistrictApi');
// School District report page /school-district/[school_district_ID]/report/[report_type]
Route::get('/school-district/{sdID}/report/{report_type}', 'SchoolDistrictsController@getSdReport');
//Route::get('/school-district-api/{sdID}/report/{report_type}', 'SchoolDistrictsController@getSdReportApi');
// Glossary /glossary
Route::get('/glossary', 'GlossaryController@getAllTerms');
//Route::get('/glossary-api', 'GlossaryController@getAllTermsApi');

// Childcare /childcare
Route::get('/childcare', 'ChildcareController@getChildcareData');

// Enrolment app 
Route::get('/enrolment-app', 'EnrolmentController@showEnrolment');

// Reporting Page 
Route::get('/reporting', 'ReportingPageController@showReportingPage');

// Financial Reports Page 
Route::get('/finance/{sdID}', 'FinancialReportsController@showFinancialReports');
Route::get('/capital-projects-api/{sdID}', 'FinancialReportsController@showCapitalProjectsApi');
Route::get('/minor-capital-programs-api/{sdID}', 'FinancialReportsController@showMinorCapitalProgramsApi');
// Governance Reports Page 
Route::get('/governance/{sdID}', 'GovernanceController@getGovernanceInfoBySD');
Route::get('/governance-api/{sdID}', 'GovernanceController@showGovernanceInfoApi');
/**
 * API
 */

//Returns all schools and school districts with mincode (or sd) and name via JSON
Route::get('/api/v1/allSchoolsWithSchoolDistricts.json', 'SchoolsController@getAllSchoolsAndSchoolDistrictsJSON');

// Province /provincial-report
Route::get('/provincial-results-api', 'SchoolDistrictsController@getProvinicialDataApi');

// Directory page /all/[cities | school-districts]
Route::get('/all/cities-api', 'SchoolsController@getAllSchoolCitiesApi'); 

Route::get('/all/school-districts-api', 'SchoolDistrictsController@getAllSchoolDistrictsApi'); 

Route::get('/school-district-api/{sdID}', 'SchoolDistrictsController@getSchoolDistrictApi');

Route::get('/glossary-api', 'GlossaryController@getAllTermsApi');

Route::get('/school-district-api/{sdID}/report/{report_type}', 'SchoolDistrictsController@getSdReportApi');
Route::get('/test-school-district-api/{sdID}/report/{report_type}', 'SchoolDistrictsController@testGetSdReportApi');

Route::get('/school-district-api/{sdID}/report', 'SchoolDistrictsController@getAllReportApi');

Route::get('/schools-api/in/{city}', 'SchoolsController@getAllSchoolsByCityApi'); 

Route::get('/schools-api/in-school-district/{sd}', 'SchoolsController@getAllSchoolsBySDApi'); 

Route::get('/school-api/{mincode}', 'SchoolsController@getSchoolApi'); 

Route::get('/school-api/{mincode}/report/{report_type}', 'SchoolsController@getSchoolReportApi');

// API for FSA
// Selected Response
Route::get('/fsa-school-districts-agg', 'FsaController@getSchoolDistrictsAgg');
Route::get('/fsa-all-school-districts-agg', 'FsaController@getAllSchoolDistrictsAgg');
Route::get('/fsa-school-districtsID/{district}', 'FsaController@getSchoolDistrictsID');
Route::get('/selected-response/{district}/{year}/{grade}/{subject}/{exam_language}/{gender}/{francophone}/{french_immersion}/{ell}/{indigenous}', 'FsaController@getSelectedResponse');
Route::get('/fsa-districts', 'FsaController@getSchoolDistricts');
Route::get('/constructed-response/{district}/{year}/{grade}/{subject}/{exam_language}/{gender}/{francophone}/{french_immersion}/{ell}/{indigenous}', 'FsaController@getConstructedResponse');
Route::get('/cognitive-levels/{district}/{year}/{grade}/{subject}/{exam_language}/{gender}/{francophone}/{french_immersion}/{ell}/{indigenous}','FsaController@getCognitiveLevels');
//Route::get('/cognitive-levels/{gender}','FsaController@getCognitiveLevels');