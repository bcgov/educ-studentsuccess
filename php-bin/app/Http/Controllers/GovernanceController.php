<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Helper;
use App\SchoolDistrict;
use App\Reports;
use App\School;
use App\Governance;
use App\Metadata;
use DB;

class GovernanceController extends Controller {

  public function showGovernanceInfoApi($sdID) {
    
    $govInfos = Governance::select('sd', 'position', 'name', 'phone', 'mobile','email')
    ->where('sd', $sdID)
    ->remember(60)
    ->get();

    return response()->json($govInfos, 200);
  }

  public function getGovernanceInfoBySD($sdID) {
    $sd = $sdID;
    $m = Metadata::select('location', 'school_year')
    ->get(); 
    $metadata = [];
    foreach ($m as $md) {
      $metadata[$md->location] = $md->school_year;
    }

    $govInfos = Governance::select('sd', 'position', 'name', 'phone', 'mobile','email')
    ->where('sd', $sdID)
    ->remember(60)
    ->get();
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
    return view('pages.gov', compact('govInfos', 'metadata', 'sd', 'school_district'));

  }
    
}