<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Glossary;
use DB;

// Include all of `App` class because we want to check if we are on production or not with `App::enviroment`. 
// This is probably a performance hit, but it is only for the glossary.
use App;

class GlossaryController extends Controller {

  public function getAllTerms() {

    $locale = \App::getLocale();
    $title = 'title_'.$locale;
    $definition = 'definition_'.$locale;

    // Only cache the results if we are on the production or staging server.
    // https://gww.jira.educ.gov.bc.ca/browse/EDR-282
    if (!App::environment('production', 'staging')) {

      $glossary_items = Glossary::select('gid', $title, $definition)
      ->orderBy($title) // https://laracasts.com/discuss/channels/eloquent/case-insensitive-sorting-of-a-collection?page=1
      // ->remember(30) // No caching!
      ->get()
      ->sortBy($title, SORT_NATURAL|SORT_FLAG_CASE);   

    } else {

      $glossary_items = Glossary::select('gid', $title, $definition)
      ->orderBy($title)
      ->remember(30) // Cache the result as we are on production server. 
      ->get()
      ->sortBy($title, SORT_NATURAL|SORT_FLAG_CASE);   

    }
 

    $glossary_entries = array();

    foreach($glossary_items as $glossary_item) {

      $first_letter = mb_substr($glossary_item->$title, 0, 1);
      $first_letter = mb_strtoupper($first_letter);

      if (is_numeric($first_letter)) {
        $first_letter = '#';
      }

      // exceptions for French
      if ($locale == 'fr') {
        if ($first_letter == 'É') {
          $first_letter = 'E';
        }
      }

      $glossary_entries[$first_letter][] = array(
        'gid' => $glossary_item->gid,
        'title' => $glossary_item->$title,
        'definition' => $glossary_item->$definition // `definition_en` and `definition_fr` can (and probably will) contain markup
      );

    }

    if ($locale != 'en') {
      ksort($glossary_entries, SORT_LOCALE_STRING);
    }
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);  
	  
    return view('pages.glossary', compact('glossary_entries'));

  }
  public function getAllTermsApi() {

    $locale = \App::getLocale();
    $title = 'title_'.$locale;
    $definition = 'definition_'.$locale;

    // Only cache the results if we are on the production or staging server.
    // https://gww.jira.educ.gov.bc.ca/browse/EDR-282
    if (!App::environment('production', 'staging')) {

      $glossary_items = Glossary::select('gid', $title, $definition)
      ->orderBy($title) // https://laracasts.com/discuss/channels/eloquent/case-insensitive-sorting-of-a-collection?page=1
      // ->remember(30) // No caching!
      ->get()
      ->sortBy($title, SORT_NATURAL|SORT_FLAG_CASE);   

    } else {

      $glossary_items = Glossary::select('gid', $title, $definition)
      ->orderBy($title)
      ->remember(30) // Cache the result as we are on production server. 
      ->get()
      ->sortBy($title, SORT_NATURAL|SORT_FLAG_CASE);   

    }
 

    $glossary_entries = array();

    foreach($glossary_items as $glossary_item) {

      $first_letter = mb_substr($glossary_item->$title, 0, 1);
      $first_letter = mb_strtoupper($first_letter);

      if (is_numeric($first_letter)) {
        $first_letter = 'hash';
      }

      // exceptions for French
      if ($locale == 'fr') {
        if ($first_letter == 'É') {
          $first_letter = 'E';
        }
      }

      $glossary_entries[$first_letter][] = array(
        'gid' => $glossary_item->gid,
        'title' => $glossary_item->$title,
        'definition' => $glossary_item->$definition // `definition_en` and `definition_fr` can (and probably will) contain markup
      );

    }

    if ($locale != 'en') {
      ksort($glossary_entries, SORT_LOCALE_STRING);
    }

    return response()->json(compact('glossary_entries'), 200);

  }
    
}
