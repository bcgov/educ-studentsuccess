<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;



use App;

class EnrolmentController extends Controller {

  public function showEnrolment() {

    return view('pages.enrolment');

  }
    
}
