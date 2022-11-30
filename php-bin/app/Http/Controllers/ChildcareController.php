<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


// Include all of `App` class because we want to check if we are on production or not with `App::enviroment`. 
// This is probably a performance hit, but it is only for the glossary.
use App;

class ChildcareController extends Controller {

  public function getChildcareData() {

    $locale = \App::getLocale();
    $title = 'title_'.$locale;
    $definition = 'definition_'.$locale;
	  
    return view('pages.childcare');

  }  
}
