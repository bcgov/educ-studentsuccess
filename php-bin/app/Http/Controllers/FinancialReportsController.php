<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\MinorCapital;
use App\Finance;
use App\IndigenousEdFin;
use App\SchoolDistrict;
use App\Reports;
use App\School;
use App\Metadata;
use DB;

class FinancialReportsController extends Controller {

  public function showFinancialReports($sdID) {
	  
	  $m = Metadata::select('location', 'school_year')
      ->get(); 
	  $metadata = [];
	  foreach ($m as $md) {
		  $metadata[$md->location] = $md->school_year;
	  }

    $minor_capital = MinorCapital::select('program', 'funding')
    ->where('sd', $sdID)
    ->orderBy('program', 'asc')
    ->remember(60)
    ->get();

    $capital = Finance::select('status', 'completion_year', 'facility_name', 'project_details', 'budget')
    ->where('sd', $sdID)
    ->orderBy('status', 'DESC')
    ->orderBy('completion_year', 'DESC')
    ->remember(60)
    ->get();

    $indiEducFinance = IndigenousEdFin::select('LOCAL_ENHANCEMENT_AGREEMENTS_SIGNED', 'INDIGENOUS_EDUCATION_COUNCIL')
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
	  return view('pages.financial', compact('school_district', 'capital', 'minor_capital','indiEducFinance','metadata'));
	  //return view('pages.financial-report');
  }
  public function showMinorCapitalProgramsApi($sdID) {
    $minor_capital = MinorCapital::select('program', 'funding')
    ->where('sd', $sdID)
    ->remember(60)
    ->get();
    //$minor_capital = MinorCapital::all();
    return response()->json($minor_capital, 200);
  }  
  public function showCapitalProjectsApi($sdID) {
    $capital = Finance::select('status', 'completion_year', 'facility_name', 'project_details', 'budget')
    ->where('sd', $sdID)
    ->orderBy('status', 'desc')
    ->remember(60)
    ->get();
    // $sorted = $collection->sortBy([
    //   ['name', 'asc'],
    //   ['age', 'desc'],
    // ]);
    //$sorted_capital = $capital->sortBy('status');
    //$capital = Finance::all();
    return response()->json($capital, 200);
  }  
}