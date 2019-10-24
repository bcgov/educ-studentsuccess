<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;



use App;

class DistrictTestController extends Controller {

  public function showDistrictTest() {

    return view('pages.districtTest');

  }
    
}
