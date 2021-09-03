<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ReportsController extends Controller {

  public function getSchoolReportSlugs() {

    return array(

      'contextual-information', 
      'fsa',
      'grade-to-grade-transitions',
      'student-satisfaction',
      'post-secondary-career-prep',
      'prov-exams',
	    'grad-assess',		
      'transition-to-post-secondary'

    );

  }

  public function getSdReportSlugs() {

    return array(

      'contextual-information', 
      'students-entering-school',
      'completion-rates',
      'fsa',
      'grade-to-grade-transitions',
      'student-satisfaction',
      'post-secondary-career-prep',
      'prov-exams',
      'grad-assess',
      'transition-to-post-secondary'

    );

  }

  public function getSchoolDbFlagNames() {

    return array(
    
      // Contextual Information
      'w_enrol1',
      'w_enrol2',

      // Foundation Skills Assessment
      'w_fsa1',
      'w_fsa2',

      // Grade-to-Grade Transitions
      'w_g2g',

      // Student Satisfaction
      'w_sat1',

      // Post-Secondary and Career Preparation
      'w_sat2',

      // Provincial Examinations
      'w_exam',

      // Transition to BC Post-Secondary Education
      'w_psi'

    );

  }

}
