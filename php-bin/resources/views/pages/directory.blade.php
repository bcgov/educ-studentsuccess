@extends('layout')

{{-- Set page title. --}}
@if (isset($cities))
@section('subtitle'){{ trans('esdr2.city_directory_heading') }}@endsection
@endif

@if (isset($school_districts))
@section('subtitle'){{ trans('esdr2.district_directory_heading') }}@endsection
@endif


@section('content')

<div class="aqua-bg directory-masthead" @if(isset($school_districts)) style="margin-bottom: 1rem;" @endif>
    <div class="restrain">

        @if (isset($cities))
        <h2 id="directory-main-heading" class="ministry-blue slide-title">{{ trans('esdr2.city_directory_heading') }}
        </h2>
        @endif

        @if (isset($school_districts))
        <h2 id="directory-main-heading" class="ministry-blue slide-title" style="display: inline-block;">
            {{ trans('esdr2.district_directory_heading') }}</h2>
        <span id="directory-sort-wrapper" class="ministry-blue">
            {{ trans('esdr2.sort_by_lable') }}:
            <a class="button" href="?sortBy=name">{{ trans('esdr2.name_lable') }}</a>
            <a class="button" href="?sortBy=number">{{ trans('esdr2.number_lable') }}</a>
        </span>
        @endif

    </div>
</div>

<section class="slide">
    <div class="slide-content restrain">

        <?php

          /**
           * This is not exactly the Lavavel way.
           * Presenter methods exist for these $cities objects in `app/Presenters` but
           * they are not in use here because I couldn't figure out how to use them
           * in a complex way.
           */

          // Check if this is a "cities" directory page.
          if (isset($cities)) {

            print '<div class="alpha_listing">';

            // Determine which letters we have, and which letters we don't have.
            $letters = array();
            foreach ($cities as $city) {
              if (!in_array($city->phy_city[0], $letters)) {
                array_push($letters, $city->phy_city[0]);
              }
            }

            // Push each city and its $totalschools to a keyed array of letters.
            $alpha_schools = array();
            print '<ul class="directory_alpha_menu">';
            foreach ($letters as $letter) {

              // And print our anchor links.
              if ($letter == '1') {
                print '<li class="letter-selection center"><a href="#1">&#35;</a></li>';
              } else {
                print '<li class="letter-selection center"><a href="#'.$letter.'">'.$letter.'</a></li>';
              }

              foreach ($cities as $city) {
                if ($city->phy_city[0] == $letter) {

                  $alpha_schools[$letter][] = array(
                    'city' => $city->phy_city,
                    'totalschools' => $city->totalschools
                  );

                }
              }

            }
            print '</ul>';

            // Print out each letter and its respective cities.
            $sd_html = '';
            foreach ($alpha_schools as $letter => $value) {

              $sd_html .= '<li id="'.$letter.'" class="directory-letter-section"><span class="directory letter">';
              if ($letter == '1') {
                $sd_html .= '&#35;';
              } else {
                $sd_html .= $letter;
              }
              $sd_html .= '</span><ul>';

              foreach ($value as $key => $values) {
                $sd_html .= '<li><a href="/schools/in/'.str_slug($values['city'], '-').'">'.Helper::formatCityForHuman($values['city']).'</a> <span class="school-count">('.$values['totalschools'].' ';

                if ($values['totalschools'] > 1) {
                  $sd_html .= trans('esdr2.school_plural_label');
                } else {
                  $sd_html .= trans('esdr2.school_singular_label');
                }

                $sd_html .= ')</span></li>';
              }

              $sd_html .= '</ul></li>';

            }

            print '</div><!-- /.alpha_listing -->';

          } ////////////////////////////////////// END if cities directory page.

        ?>

        <ul class="directory-wrapper">

            <?php

          if (isset($cities)) {
            print $sd_html;
          }

          // Check if this is a "school districts" directory page.
          if (isset($school_districts)) {

            // Check if we are sorting by School District number.
            if (request('sortBy') == 'number') {

              foreach($school_districts as $school_district) {
                print '<li class="directory-numeric-section"><a href="/school-district/'.$school_district->sd.'">'.trans('esdr2.sd_heading').' '.$school_district->sd.'</a> - '.$school_district->district_name.' <a class="view-report" href="/school-district/'.$school_district->sd.'">'.trans('esdr2.view_report_lable').' '.Helper::formatCityForHuman($school_district->district_name).' <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>';
              }

            } else {

              // Determine which letters we have, and which letters we don't have.
              $letters = array();
              foreach ($school_districts as $school_district) {
                if (!in_array($school_district->district_name[0], $letters)) {
                  array_push($letters, $school_district->district_name[0]);
                }
              }

              // Push each city and its $totalschools to a keyed array of letters.
              $alpha_school_districts = array();
              print '<li><ul class="directory_alpha_menu">';
              foreach ($letters as $letter) {

                // And print our anchor links.
                print '<li class="letter-selection center"><a href="#'.$letter.'">'.$letter.'</a></li>';

                foreach ($school_districts as $school_district) {
                  if ($school_district->district_name[0] == $letter) {

                    $alpha_school_districts[$letter][] = array(
                      'district_name' => $school_district->district_name,
                      'sd' => $school_district->sd
                    );

                  }
                }

              }
              print '</ul></li>';

              print '<li class="directory-letter-section"><span class="directory letter">'.trans('esdr2.prov_results_label').'</span><ul><li><a href="/school-district/099">'.trans('esdr2.prov_school_district_label').'</a> <a class="view-report" href="/school-district/099">'.trans('esdr2.view_report_lable').' '.trans('esdr2.entire_province_label').' <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li></ul></li>';

              // Print out each letter and its respective school districts.
              $sd_html = '';
              foreach ($alpha_school_districts as $letter => $value) {

                $sd_html .= '<li id="'.$letter.'" class="directory-letter-section"><span class="directory letter">';
                if ($letter == '1') {
                  $sd_html .= '#';
                } else {
                  $sd_html .= $letter;
                }
                $sd_html .= '</span><ul>';

                foreach ($value as $key => $values) {
                  $sd_html .= '<li><a href="/school-district/'.$values['sd'].'">'.Helper::formatCityForHuman($values['district_name']).'</a> ('.Helper::removeLeadingZeros($values['sd']).') <a class="view-report" href="/school-district/'.$values['sd'].'">'.trans('esdr2.view_report_lable').' '.Helper::formatCityForHuman($values['district_name']).' <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>';
                }

                $sd_html .= '</ul></li>';

              }

              print $sd_html;

            } // If request is not sorted by School District number.

          } //////////////////////////// END if school districts directory page.

        ?>

        </ul><!-- /END ".directory-wrapper" -->

    </div>
</section>

@endsection