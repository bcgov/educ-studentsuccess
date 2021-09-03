<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

// In order to get $_GET params.
use Illuminate\Support\Facades\Input;

use App\SchoolDistrict;
use App\Reports;
use App\School;
use App\Metadata;
use DB;

class SchoolDistrictsController extends Controller {
  
  public function getAllSchoolDistricts() {

    // Gets things like POST and GET data from request.
    $input = Input::all();

    if (isset($input['sortBy']) && $input['sortBy'] == 'number') {

      $school_districts = SchoolDistrict::select('sd', 'district_name')
      ->orderBy('sd')
      ->remember(30)
      ->get();

    } else {

      $school_districts = SchoolDistrict::select('sd', 'district_name')
      ->orderBy('district_name')
      ->remember(30)
      ->get();

    }

    return view('pages.directory', compact('school_districts'));

  }
  public function getAllSchoolDistrictsApi() {

    // Gets things like POST and GET data from request.
    $input = Input::all();

    if (isset($input['sortBy']) && $input['sortBy'] == 'number') {

      $school_districts = SchoolDistrict::select('sd', 'district_name')
      ->orderBy('sd')
      ->remember(30)
      ->get();

    } else {

      $school_districts = SchoolDistrict::select('sd', 'district_name')
      ->orderBy('district_name')
      ->remember(30)
      ->get();

    }
    return response()->json($school_districts, 200);
  }

  public function getSchoolDistrict($sdID) {

    // https://laravel.com/docs/5.2/eloquent
    $school_district = SchoolDistrict::where('sd', $sdID)
      ->remember(30)
      ->firstOrFail();

    if ($sdID == '099') {
      // Redirect in the case of SD 99 (Provincial Results)
      return redirect('/provincial-results');  
    } else {
      return view('pages.schooldistrict', compact('school_district'));
    }

  }
  public function getSchoolDistrictApi($sdID) {

    // https://laravel.com/docs/5.2/eloquent
    $school_district = SchoolDistrict::where('sd', $sdID)
      ->remember(30)
      ->firstOrFail();

    if ($sdID == '099') {
      // Redirect in the case of SD 99 (Provincial Results)
      return redirect('/provincial-results-api');  
    } else {
      return response()->json($school_district, 200);
    }

  }

  public function getProvinicialData() {

    $school_district = SchoolDistrict::where('sd', '099')
      ->remember(60)
      ->firstOrFail();

    return view('pages.province', compact('school_district'));

  }

  public function getProvinicialDataApi() {

    $school_district = SchoolDistrict::where('sd', '099')
      ->remember(60)
      ->firstOrFail();

    return response()->json($school_district, 200);

  }

  public function getSchoolDistrictName($sdID) {

    $school_district = SchoolDistrict::where('sd', $sdID)
      ->remember(60)
      ->firstOrFail();

    return $school_district->district_name;

  }

  public function getSdReport($sdID, $report_slug) {
    //Report Data for Vega Spec
    $r = Reports::where('school_district', $sdID)
      ->get();
      //print_r($r);
    $reportdata = [];
    $completionRateData = [];

    foreach ($r as $rd) {
      $reportdata[$rd->school_district] = $rd->json_data;
      //Shows the data from the database
      //print('<strong>school_district:' . $rd->school_district . "</strong><br>");
      //print('DATA:' . $reportdata[$rd->school_district] . "<br>");
      //print("\n\n\n");
      array_push($completionRateData,$reportdata[$rd->school_district] );
    }
    //print($completionRateData[0]);

    $m = Metadata::select('location', 'school_year')
      ->get();

    $metadata = [];
    foreach ($m as $md) {
      $metadata[$md->location] = $md->school_year;
    }

    $sd_report_slugs = (new ReportsController)->getSdReportSlugs();

    // Exception for Mission SD
    if ($sdID == '075') {
      $mission_report_slugs = array_diff($sd_report_slugs, array('post-secondary-career-prep'));
      $sd_report_slugs = array_values($mission_report_slugs);
    }

    // Bail out if we didn't get a valid report type.
    if (!in_array($report_slug, $sd_report_slugs)) {
      \App::abort(404);
    }

    // Exception for Provincial Report
    if ($sdID == '099') {
      
      $school_district = (object)[];

      $school_district->district_name = trans('esdr2.prov_results_label');
      $school_district->sd = '099';

    } else {

      $school_district = SchoolDistrict::where('sd', $sdID)
        ->remember(30)
        ->firstOrFail();

    }
    $data = (object)[];

    $data->completion_rate = '{
      "name": "provlvl",
      "values": '.$completionRateData[0];
      
    return view('pages.sd-report', compact('school_district', 'report_slug', 'sd_report_slugs', 'metadata', 'data'));

  }

  public function getSdReportApi($sdID, $report_slug) {
     //Report Data for Vega Spec
    $r = Reports::where('school_district', $sdID)
      ->get();
      //print_r($r);
    $reportdata = [];
    $completionRateData = [];

    foreach ($r as $rd) {
      $reportdata[$rd->school_district] = $rd->json_data;
      //Shows the data from the database
      //print('<strong>school_district:' . $rd->school_district . "</strong><br>");
      //print('DATA:' . $reportdata[$rd->school_district] . "<br>");
      //print("\n\n\n");
      array_push($completionRateData,$reportdata[$rd->school_district] );
    }
    //print($completionRateData[0]);

    $m = Metadata::select('location', 'school_year')
      ->get();

    $metadata = [];
    foreach ($m as $md) {
      $metadata[$md->location] = $md->school_year;
    }

    $sd_report_slugs = (new ReportsController)->getSdReportSlugs();

    // Exception for Mission SD
    if ($sdID == '075') {
      $mission_report_slugs = array_diff($sd_report_slugs, array('post-secondary-career-prep'));
      $sd_report_slugs = array_values($mission_report_slugs);
    }

    // Bail out if we didn't get a valid report type.
    if (!in_array($report_slug, $sd_report_slugs)) {
      \App::abort(404);
    }

    // Exception for Provincial Report
    if ($sdID == '099') {
      
      $school_district = (object)[];

      $school_district->district_name = trans('esdr2.prov_results_label');
      $school_district->sd = '099';

    } else {

      $school_district = SchoolDistrict::where('sd', $sdID)
        ->remember(30)
        ->firstOrFail();

    }
    $data = (object)[];
    
    $data->completion_rate = json_decode($completionRateData[0]);
    //return view('pages.sd-report', compact('school_district', 'report_slug', 'sd_report_slugs', 'metadata', 'data'));
    return response()->json(compact('school_district', 'report_slug', 'sd_report_slugs', 'metadata', 'data'), 200);

  }

}
