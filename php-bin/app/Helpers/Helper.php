<?php

namespace App\Helpers;

use App\School;

/**
 * Custom Helper class.
 */
class Helper
{

  public static function formatCityForHuman($str)
  {

    // Replace '-' with ' '.
    $str = str_replace('-', ' ', $str);
    // Convert capital letters to lower case.
    $str = strtolower($str);
    // Now capitalize each word in an attempt to make the city nice and readable.
    $str = ucwords($str);
    // lower case qathet for new district name
    if (strpos($str, 'Qathet') !== false) {
      $str = strtolower($str);
    }
    if (strpos($str, 'Conseil Scolaire Francophone') !== false) {
      $str = str_replace("Scolaire Francophone", "scolaire francophone", $str);
    }
    if (strpos($str, 'Province Of B.c.') !== false) {
      $str = str_replace("B.c.", "B.C.", $str);
    }
    return $str;
  }

  public static function unSlugifyCity($str)
  {

    // Replace '-' with ' '.
    $str = str_replace('-', ' ', $str);
    // Convert to capital letters.
    $str = strtoupper($str);

    return $str;
  }

  public static function formatSchoolGradeRangeStr($mincode)
  {

    $school = School::where('mincode', $mincode)->firstOrFail();

    $flags = array();
    $grade_str = '';
    $head = '';
    $tail = '';

    if ($school->kh_enrol_flag == 'Y' || $school->kf_enrol_flag == 'Y') {
      $flags[0] = 'Y';
    } else {
      $flags[0] = 'N';
    }

    $flags[1] = $school->g01_enrol_flag;
    $flags[2] = $school->g02_enrol_flag;
    $flags[3] = $school->g03_enrol_flag;
    $flags[4] = $school->g04_enrol_flag;
    $flags[5] = $school->g05_enrol_flag;
    $flags[6] = $school->g06_enrol_flag;
    $flags[7] = $school->g07_enrol_flag;

    // $flags['eu_enrol_flag'] = $school->eu_enrol_flag;

    $flags[8] = $school->g08_enrol_flag;
    $flags[9] = $school->g09_enrol_flag;
    $flags[10] = $school->g10_enrol_flag;
    $flags[11] = $school->g11_enrol_flag;
    $flags[12] = $school->g12_enrol_flag;

    // $flags['su_enrol_flag'] = $school->su_enrol_flag;

    for ($i = 0; $i < count($flags); $i++) {

      if ($i == 0) {
        if ($flags[$i] == "Y") {
          $head = "K";
          $tail = "K";
        }
      } else if ($flags[$i] == "Y") {
        //frst instance of grade set head and tail
        if ($head == "" && $tail == "") {
          $head = $i;
          $tail = $i;
          if (!isset($flags[$i + 1])) {
            //end of array
            $grade_str .= $head;
          }
        } else {
          if ($flags[$i - 1] == "Y" && $flags[$i] == "Y") {
            //progress tail
            $tail = $i;
            if (!isset($flags[$i + 1])) {
              //end of array
              $grade_str .= $head . "-" . $tail;
            }
          }
        }
      } else {
        if ($flags[$i - 1] == "Y" && $flags[$i] == "N") {
          //contruct and append String and clear our head and tail
          if ($head == $tail) {
            //print "head eq tail";
            $grade_str .= $head . ", ";
            $head = "";
            $tail = "";
          } else {
            //print "head neq tail";
            $grade_str .= $head . "-" . $tail . ", ";
            $head = "";
            $tail = "";
          }
        }
      }
    }

    // Now check if $grade_str ends with a comma or a space.
    if (substr($grade_str, -1) == ' ') {
      // Remove space.
      $grade_str = substr($grade_str, 0, -1);
    }
    if (substr($grade_str, -1) == ',') {
      // Remove comma.
      $grade_str = substr($grade_str, 0, -1);
    }

    // dd($school);
    return $grade_str;
  }

  public static function formatStreetAddressForHuman($str)
  {

    return ucwords(strtolower($str));
  }

  public static function removeLeadingZeros($sdID)
  {

    return ltrim($sdID, '0');
  }

  public static function fixEcole($str)
  {

    $str = str_replace("Ecole", "École", $str);
    $str = str_replace("L'École", "L'école", $str);
    $str = str_replace("L'ecole", "L'école", $str);
    $str = str_replace("l'ecole", "L'école", $str);

    return $str;
  }
}
