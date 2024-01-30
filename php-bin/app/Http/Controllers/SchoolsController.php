<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\ReportsController;

// https://stackoverflow.com/a/32772686/1171790
use Helper;

use App\School;
use App\SchoolDistrict;
use App\Metadata;
use DB;

class SchoolsController extends Controller {

  public function index() {

    return view('pages.index');

  }

  public function getAllSchoolCities() {

    $cities = School::select('phy_city', DB::raw('count(*) as totalschools'))
      ->groupBy('phy_city')
      ->orderBy('phy_city')
      ->remember(60) // https://www.neontsunami.com/posts/bringing-the-remember-method-back-to-laravel-5
      ->get();

    return view('pages.directory', compact('cities'));

  }

  public function getAllSchoolCitiesApi() {

    $cities = School::select('phy_city', DB::raw('count(*) as totalschools'))
      ->groupBy('phy_city')
      ->orderBy('phy_city')
      ->remember(60) // https://www.neontsunami.com/posts/bringing-the-remember-method-back-to-laravel-5
      ->get();

      return response()->json($cities, 200);

  }

  public function getAllSchoolsByCity($city) {

    $city = Helper::unSlugifyCity($city);

    $schools = School::select('school_name', 'independent', 'mincode', 'sd', 'phy_address_line_1', 'phy_city')
      ->where('phy_city', $city)
      ->orderBy('school_name')
      ->remember(180)
      ->get();


    // Handle no records found.
    if (count($schools) < 1) {
      \App::abort(404);
    }

    $selected_city = $city;
    $first_public_school_sd = null;
    $w_indi = null;
    $w_public = null;

    foreach ($schools as $school) {
      if ($school->independent) {
        $w_indi = 1;
        break;
      }
    }

    foreach ($schools as $school) {
      if (!$school->independent) {
        $w_public = 1;
        $first_public_school_sd = $school->sd;
        break;
      }
    }

    if ($first_public_school_sd) {
      $district_name = app('App\Http\Controllers\SchoolDistrictsController')->getSchoolDistrictName($first_public_school_sd);
    } else {
      $district_name = null;
    }

    $sdID = "099";
    if ($first_public_school_sd) {
      $sdID = $first_public_school_sd;
    }


    return view('pages.school-directory-results', compact('schools', 'selected_city', 'district_name', 'sdID', 'w_indi', 'w_public'));

  }
  public function getAllSchoolsByCityApi($city) {

    $city = Helper::unSlugifyCity($city);

    $schools = School::select('school_name', 'independent', 'mincode', 'sd', 'phy_address_line_1', 'phy_city')
      ->where('phy_city', $city)
      ->orderBy('school_name')
      ->remember(60)
      ->get();


    // Handle no records found.
    if (count($schools) < 1) {
      \App::abort(404);
    }

    $selected_city = $city;
    $first_public_school_sd = null;
    $w_indi = null;
    $w_public = null;

    foreach ($schools as $school) {
      if ($school->independent) {
        $w_indi = 1;
        break;
      }
    }

    foreach ($schools as $school) {
      if (!$school->independent) {
        $w_public = 1;
        $first_public_school_sd = $school->sd;
        break;
      }
    }

    if ($first_public_school_sd) {
      $district_name = app('App\Http\Controllers\SchoolDistrictsController')->getSchoolDistrictName($first_public_school_sd);
    } else {
      $district_name = null;
    }

    $sdID = "099";
    if ($first_public_school_sd) {
      $sdID = $first_public_school_sd;
    }

    return response()->json($schools, 200);
    //return view('pages.school-directory-results', compact('schools', 'selected_city', 'district_name', 'sdID', 'w_indi', 'w_public'));

  }
  public function getAllSchoolsBySD($sdID) {

    $schools = School::select('school_name', 'independent', 'mincode', 'phy_address_line_1', 'phy_city')
      ->where('sd', $sdID)
      ->orderBy('school_name')
      ->remember(60)
      ->get();

    if (count($schools) < 1) {
      \App::abort(404);
    }

    $w_indi = null;
    $w_public = null;

    foreach ($schools as $school) {
      if ($school->independent) {
        $w_indi = 1;
        break;
      }
    }

    foreach ($schools as $school) {
      if (!$school->independent) {
        $w_public = 1;
        $first_public_school_sd = $school->sd;
        break;
      }
    }

    $district_name = app('App\Http\Controllers\SchoolDistrictsController')->getSchoolDistrictName($sdID);

    return view('pages.sd-directory-results', compact('schools', 'district_name', 'sdID', 'w_indi', 'w_public'));

  }
  public function getAllSchoolsBySDApi($sdID) {

    $schools = School::select('school_name', 'independent', 'mincode', 'phy_address_line_1', 'phy_city')
      ->where('sd', $sdID)
      ->orderBy('school_name')
      ->remember(60)
      ->get();

    if (count($schools) < 1) {
      \App::abort(404);
    }

    $w_indi = null;
    $w_public = null;

    foreach ($schools as $school) {
      if ($school->independent) {
        $w_indi = 1;
        break;
      }
    }

    foreach ($schools as $school) {
      if (!$school->independent) {
        $w_public = 1;
        $first_public_school_sd = $school->sd;
        break;
      }
    }

    $district_name = app('App\Http\Controllers\SchoolDistrictsController')->getSchoolDistrictName($sdID);
    return response()->json(compact('schools', 'district_name', 'sdID', 'w_indi', 'w_public'), 200);

  }

  public function getSchool($mincode) {

    $school = School::where('mincode', $mincode)
      ->remember(60)
      ->firstOrFail();

    $district_name = null;
    if (!$school->independent) {
      $district_name = app('App\Http\Controllers\SchoolDistrictsController')->getSchoolDistrictName($school->sd);
    }

    return view('pages.school', compact('school', 'mincode', 'district_name'));

  }
	public function getSchoolApi($mincode) {

		$school = School::where('mincode', $mincode)
		  ->remember(60)
		  ->firstOrFail();

		$district_name = null;
		if (!$school->independent) {
		  $district_name = app('App\Http\Controllers\SchoolDistrictsController')->getSchoolDistrictName($school->sd);
		}

		//return view('pages.school', compact('school', 'mincode', 'district_name'));
		return response()->json(compact('school', 'mincode', 'district_name'), 200);
	}


  public function getSchoolReport($mincode, $report_slug) {

    $m = Metadata::select('location', 'school_year')
      ->get();

    $metadata = [];
    foreach ($m as $md) {
      $metadata[$md->location] = $md->school_year;
    }

    $school = School::where('mincode', $mincode)
      ->remember(60)
      ->firstOrFail();

    $school_report_slugs = $this->getSchoolReports($mincode);

    // Bail out if we didn't get a valid report type.
    if (!in_array($report_slug, $school_report_slugs)) {
      \App::abort(404);
    }

    return view('pages.school-report', compact('school', 'report_slug', 'school_report_slugs', 'metadata'));

  }

	public function getSchoolReportApi($mincode, $report_slug) {

		$m = Metadata::select('location', 'school_year')
		  ->get();

		$metadata = [];
		foreach ($m as $md) {
		  $metadata[$md->location] = $md->school_year;
		}

		$school = School::where('mincode', $mincode)
		  ->remember(60)
		  ->firstOrFail();

		$school_report_slugs = $this->getSchoolReports($mincode);

		// Bail out if we didn't get a valid report type.
		if (!in_array($report_slug, $school_report_slugs)) {
		  \App::abort(404);
		}

		//return view('pages.school-report', compact('school', 'report_slug', 'school_report_slugs', 'metadata'));
		return response()->json(compact('school', 'report_slug', 'school_report_slugs', 'metadata'), 200);
  	}
  public function getSchoolReports($mincode) {

    $school = School::where('mincode', $mincode)
      ->remember(60)
      ->firstOrFail();

    $report_slugs = array();

    if ($school->w_enrol1 || $school->w_enrol2) {
      $report_slugs[] = 'contextual-information';
    }

    if ($school->w_fsa1 || $school->w_fsa2) {
      $report_slugs[] = 'fsa';
    }

    if ($school->w_g2g) {
      $report_slugs[] = 'grade-to-grade-transitions';
    }

    if ($school->w_sat1) {
      $report_slugs[] = 'student-satisfaction';
    }

    if ($school->w_sat2) {
      $report_slugs[] = 'post-secondary-career-prep';
    }

    if ($school->w_exam) {
      $report_slugs[] = 'prov-exams';
    }

    if ($school->w_psi) {
      $report_slugs[] = 'transition-to-post-secondary';
    }

    // Could potentially return an empty array if a school has no reports.
    return $report_slugs;

  }

  public function getAllSchoolsAndSchoolDistrictsJSON() {

    $json = array();

    $schools = School::select('school_name', 'mincode')
      ->orderBy('school_name')
      ->remember(60)
      ->get();

    $school_districts = SchoolDistrict::select('sd', 'district_name')
      ->orderBy('sd')
      ->remember(60)
      ->get();

    // Exception: Add provincial level report (first).
    $json[] = array(
      's' => trans('esdr2.prov_school_district_label'),
      'sd' => '099'
    );

    foreach ($school_districts as $school_district) {
      // Exception: No need to add the province twice because it is added manually above.
      if ($school_district->sd != '099') {
        $json[] = array(
          's' => $school_district->district_name.' '.trans('esdr2.sd_heading').' ('.Helper::removeLeadingZeros($school_district->sd).')',
          'sd' => $school_district->sd,
          'type'=>'school district',
          'primary_key'=> $school_district->sd
        );
      }
    }

    foreach ($schools as $school) {
      $json[] = array(
        's' => Helper::fixEcole($school->school_name),
        'mincode' => $school->mincode,
        'type' => 'school',
        'primary_key'=> $school->mincode
      );
    }

    return $json;

  }

}
