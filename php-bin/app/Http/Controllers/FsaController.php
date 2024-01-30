<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\ReportsController;

// https://stackoverflow.com/a/32772686/1171790
use Helper;

use App\Fsa;
use App\FSASchoolOrDistrictID;
use App\FSASchoolOrDistrictIDAGG;
use App\FSASchoolYear;
use DB;

class FsaController extends Controller {


//public function getSelectedResponse($school_type,$district,$year,$grade,$subject,$exam_language,$gender,$francophone,$french_immersion,$ell,$indigenous) {
public function getSchoolDistricts(){
	$selectedResponse = DB::table('EDW_RESEARCH.FSA_ILR_SCHOOL_OR_DISTRICT_ID')->get();
    return response()->json($selectedResponse, 200);
}
public function getSchoolYears(){
	$selectedResponse = DB::table('EDW_RESEARCH.fsa_ilr_school_year')->get();
    return response()->json($selectedResponse, 200);
}

public function getSelectedResponse( $district, $year, $grade, $subject, $exam_language,$gender,$francophone,$french_immersion,$ell,$indigenous) {  
    
	$fixedYear = str_replace('-', '/', $year);
    
	if($gender == 'all'){
		$gender = null;
	}
	
	if($francophone == 'all'){
		$francophone = null;
	}
	
	if($french_immersion == 'all'){
		$french_immersion = null;
	}
	
	if($ell == 'all'){
		$ell = null;
	}
	
	if($indigenous == 'all'){
		$indigenous = null;
	}
	
    $selectedResponse = DB::table('EDW_RESEARCH.A_SELECTED_RESPONSE')

		->where('SCHOOL_OR_DISTRICT_ID', '=', $district)
		->where('YEAR', '=', $fixedYear)
		->where('GRADE', '=', $grade)
		->where('SUBJECT', '=', $subject)
		->where('EXAM_LANGUAGE', '=', $exam_language)
		->where('GENDER', '=', $gender)
		->where('FRANCOPHONE', '=', $francophone)
		->where('FRENCH_IMMERSION', '=', $french_immersion)
		->where('ELL', '=', $ell)
		->where('INDIGENOUS', '=', $indigenous)
		->get();

    return response()->json($selectedResponse, 200);
}
  public function getConstructedResponse($district, $year, $grade, $subject, $exam_language,$gender,$francophone,$french_immersion,$ell,$indigenous){
	$fixedYear = str_replace('-', '/', $year);
	
	if($gender == 'all'){
		$gender = null;
	}
	
	if($francophone == 'all'){
		$francophone = null;
	}
	
	if($french_immersion == 'all'){
		$french_immersion = null;
	}
	
	if($ell == 'all'){
		$ell = null;
	}
	
	if($indigenous == 'all'){
		$indigenous = null;
	}
	
    $constructedResponse = DB::table('EDW_RESEARCH.B_CONSTRUCTED_RESPONSE')
	->where('SCHOOL_OR_DISTRICT_ID', '=', $district)
	->where('YEAR', '=', $fixedYear)
	->where('GRADE', '=', $grade)
	->where('SUBJECT', '=', $subject)
	->where('EXAM_LANGUAGE', '=', $exam_language)
	->where('GENDER', '=', $gender)
	->where('FRANCOPHONE', '=', $francophone)
	->where('FRENCH_IMMERSION', '=', $french_immersion)
	->where('ELL', '=', $ell)
	->where('INDIGENOUS', '=', $indigenous)
	->get();

    return response()->json($constructedResponse, 200);
  }

  public function getCognitiveLevels ($district, $year, $grade, $subject, $exam_language,$gender,$francophone,$french_immersion,$ell,$indigenous){
	$fixedYear = str_replace('-', '/', $year);
	
	if($gender == 'all'){
		$gender = null;
	}
	
	if($francophone == 'all'){
		$francophone = null;
	}
	
	if($french_immersion == 'all'){
		$french_immersion = null;
	}
	
	if($ell == 'all'){
		$ell = null;
	}
	
	if($indigenous == 'all'){
		$indigenous = null;
	}
	
    $constructedResponse = DB::table('EDW_RESEARCH.C_COGNITIVE_LEVELS')
	->where('SCHOOL_OR_DISTRICT_ID', '=', $district)
	->where('YEAR', '=', $fixedYear)
	->where('GRADE', '=', $grade)
	->where('SUBJECT', '=', $subject)
	->where('EXAM_LANGUAGE', '=', $exam_language)
	->where('GENDER', '=', $gender)
	->where('FRANCOPHONE', '=', $francophone)
	->where('FRENCH_IMMERSION', '=', $french_immersion)
	->where('ELL', '=', $ell)
	->where('INDIGENOUS', '=', $indigenous)
	->get();

    return response()->json($constructedResponse, 200);
  }
  public function getSchoolDistrictsAgg(){
	$schoolDistrictsAgg = FSASchoolOrDistrictIDAGG::select('school_or_district_id','school_or_district_name','district')
		->orderBy('school_or_district_id','asc')
		->remember(30) // Cache the result as we are on production server. 
		->get()
		->sortBy('school_or_district_id', SORT_NATURAL|SORT_FLAG_CASE);

	return response()->json($schoolDistrictsAgg, 200);
  }
  public function getAllSchoolDistrictsAgg(){
	$allSchoolDistrictsAgg = FSASchoolOrDistrictIDAGG::select('school_or_district_id','school_or_district_name','district')
		->where('district', '=', null)
		->orderBy('school_or_district_id','desc')
		->remember(30) // Cache the result as we are on production server. 
		->get()
		->sortBy('school_or_district_id', SORT_NATURAL|SORT_FLAG_CASE);

	return response()->json($allSchoolDistrictsAgg, 200);
  }
  public function getSchoolDistrictsID($district){
	$schoolDistrictsID = DB::table('EDW_RESEARCH.FSA_ILR_SCHOOL_OR_DISTRICT_ID')
	->where('district', '=', $district)
	->orderBy('school_or_district_name','asc')
	->get();
    return response()->json($schoolDistrictsID, 200);
  }
}


