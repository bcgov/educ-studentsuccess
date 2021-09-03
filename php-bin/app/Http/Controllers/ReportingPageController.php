<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;



use App;

class ReportingPageController extends Controller {

  public function showReportingPage() {

    return view('pages.reporting');

  }
    
}
