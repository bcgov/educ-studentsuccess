<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

// In order to get $_GET params.
use Illuminate\Support\Facades\Input;

use App\SchoolDistrict;
use App\School;
use App\Metadata;
use DB;


class DistrictTestController extends Controller {

  public function showDistrictTest($sdID) {
 // https://laravel.com/docs/5.2/eloquent
    $school_district = SchoolDistrict::where('sd', $sdID)
    ->remember(30)
    ->firstOrFail();

    if ($sdID == '099') {
    // Redirect in the case of SD 99 (Provincial Results)
    return redirect('/provincial-results');  
    } else {
    return view('pages.districtTest', compact('school_district'));
    }
    return view('pages.districtTest');

  }

  public function getSdReport($sdID, $report_slug) {

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

    return view('pages.sd-report', compact('school_district', 'report_slug', 'sd_report_slugs', 'metadata'));

  }
    
}
