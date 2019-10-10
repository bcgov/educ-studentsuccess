@extends('layout')
@section('content')

  @include('components.sd-meta')

  <section class="slide aqua-bg options-row">
    <div class="slide-content restrain">
      
      <div class="sd-sub-nav">

        {{-- <a class="big button information" href="/schools/in-school-district/{{ $school_district->sd }}">{{ trans('esdr2.see_all_schools_lable') }} {{ Helper::removeLeadingZeros($school_district->sd) }} {{ trans('esdr2.see_all_schools_lable2') }}</a> --}}

        @php

          $current_report_index = array_search($report_slug, $sd_report_slugs);

          // Map translated headings to report type.
          $report_headings = array(
            'contextual-information' => trans('esdr2.context_information_heading'), 
            'students-entering-school' => trans('esdr2.characteristics_of_students_sm'),
            'completion-rates' => trans('esdr2.completion_rate_heading'),
            'fsa' => trans('esdr2.fsa_heading'),
            'grade-to-grade-transitions' => trans('esdr2.g2g_heading'),
            'student-satisfaction' => trans('esdr2.student_sat_heading'),
            'post-secondary-career-prep' => trans('esdr2.post_sec_heading'),
            'prov-exams' => trans('esdr2.prov_exam_heading'),
            'transition-to-post-secondary' => trans('esdr2.transition_to_post_sec_heading')
          );

          $report_headings_keys = array_keys($report_headings);

          // print ($current_report_index);

          if ($current_report_index !== 0) {
          print '<a class="big button previous" href="/school-district/'.$school_district->sd.'/report/'.$sd_report_slugs[$current_report_index - 1].'"><i class="fa fa-angle-left" aria-hidden="true"></i> '.$report_headings[$sd_report_slugs[$current_report_index - 1]].'</a>';
          }

        @endphp

        <a class="big button information" title="{{ $school_district->district_name }} ({{ $school_district->sd }})" href="/school-district/{{ $school_district->sd }}">{{ trans('esdr2.reports_heading1') }}</a>

        @php

          if ($current_report_index + 1 < count($sd_report_slugs)) {
            print '<a class="big button next" href="/school-district/'.$school_district->sd.'/report/'.$sd_report_slugs[$current_report_index + 1].'">'.$report_headings[$sd_report_slugs[$current_report_index + 1]].' <i class="fa fa-angle-right" aria-hidden="true"></i></a>';
          }

        @endphp

      </div>

    </div>
  </section>

  <section style="padding-top: 3rem;" class="slide fill-viewport">
    <div class="slide-content restrain">

      @if ($report_slug == 'contextual-information')
       
        <h3 class="slide-title light-blue">{{ trans('esdr2.1_ComDemo') }}</h3>
        <iframe scrolling="no" id="frameId-5" class="tableau-embed" src="//public.tableau.com/views/ESDR1/1_ComDemo?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }},099"></iframe>

        <h3 class="slide-title light-blue">{{ trans('esdr2.2_Enrolment') }}</h3>
        <iframe scrolling="no" id="frameId-6" class="tableau-embed" src="//public.tableau.com/views/ESDR1/2_Enrolment?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>

        <hr class="chart-hr" style="margin-top: 10px; margin-bottom: 50px;">

        <h3 class="slide-title light-blue">{{ trans('esdr2.3_StudByGrade') }} {{ $metadata['district_contextual_allgrades_yr'] }}</h3>
        <iframe scrolling="no" id="frameId-7" class="tableau-embed" src="//public.tableau.com/views/ESDR1/3_StudByGrade?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>

      @endif

      @if ($report_slug == 'students-entering-school')
        
        <h3 class="slide-title light-blue">{{ trans('esdr2.students_entering_school_heading') }}</h3>
        <iframe scrolling="no" id="frameId-8" class="tableau-embed" src="//public.tableau.com/views/ESDR1/4_EDI?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>

      @endif

      @if ($report_slug == 'completion-rates')
        
        <h3 class="slide-title light-blue">{{ trans('esdr2.completion_rate_heading') }}</h3>
        @include('components.chart-legend')
        <iframe scrolling="no" id="frameId-91" class="tableau-embed" src="//public.tableau.com/views/ESDR2/5_CompRate?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>

        <hr class="chart-hr" style="margin-top: 30px; margin-bottom: 50px;">

        <h3 class="slide-title light-blue">{{ trans('esdr2.completion_rate_abbo1') }}</h3>
        <iframe scrolling="no" id="frameId-92" class="tableau-embed" src="//public.tableau.com/views/ESDR1/6_CompRate3?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}&Student%20Group=ABORIGINAL,ALL%20STUDENTS"></iframe>

        <hr class="chart-hr" style="margin-top: 30px; margin-bottom: 50px;">

        <h3 class="slide-title light-blue">{{ trans('esdr2.completion_rate_abbo2') }}</h3>
        <iframe scrolling="no" id="frameId-93" class="tableau-embed restrain" src="//public.tableau.com/views/ESDR1/6_CompRate3?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}&Student%20Group=SPECIAL%20NEEDS,ALL%20STUDENTS"></iframe>

      @endif

      @if ($report_slug == 'fsa')
        
        <h3 class="slide-title light-blue">{{ trans('esdr2.fsa_heading') }}</h3>
        @include('components.chart-legend')
        <iframe scrolling="no" id="frameId-101" class="tableau-embed" src="//public.tableau.com/views/ESDR1/7_FSA?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>

        <hr class="chart-hr" style="margin-top: 30px; margin-bottom: 50px;">

        <h3 class="slide-title light-blue">{{ trans('esdr2.fsa_heading2') }} - {{ trans('esdr2.fsa_heading_reading') }}</h3>
        <iframe scrolling="no" id="frameId-102" class="tableau-embed" src="//public.tableau.com/views/ESDR1/8_FSA2?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}&SKILL=Reading"></iframe>
        @include('components.chart-legend_fsa')

        <hr class="chart-hr" style="margin-top: 30px; margin-bottom: 50px;">

        <h3 class="slide-title light-blue">{{ trans('esdr2.fsa_heading3') }} - {{ trans('esdr2.fsa_heading_writing') }}</h3>
        <iframe scrolling="no" id="frameId-103" class="tableau-embed" src="//public.tableau.com/views/ESDR1/8_FSA2?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}&SKILL=Writing"></iframe>
        @include('components.chart-legend_fsa')

        <hr class="chart-hr" style="margin-top: 50px; margin-bottom: 50px;">

        <h3 class="slide-title light-blue" style="margin-bottom: 0;">{{ trans('esdr2.fsa_heading4') }} - {{ trans('esdr2.fsa_heading_numeracy') }}</h3>
        <iframe scrolling="no" id="frameId-104" class="tableau-embed" src="//public.tableau.com/views/ESDR1/8_FSA2?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}&SKILL=Numeracy"></iframe>
        @include('components.chart-legend_fsa')

      @endif

      @if ($report_slug == 'grade-to-grade-transitions')
        <h3 class="slide-title light-blue">{{ trans('esdr2.g2g_heading') }}</h3>
        <iframe scrolling="no" id="frameId-11" class="tableau-embed" src="//public.tableau.com/views/ESDR1/9_G2G?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
      @endif

      @if ($report_slug == 'student-satisfaction')
        <h3 class="slide-title light-blue">{{ trans('esdr2.student_sat_heading') }}</h3>
        @include('components.chart-legend')
        <iframe scrolling="no" id="frameId-13" class="tableau-embed restrain" src="//public.tableau.com/views/ESDR1/11_SatSurv?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
      @endif

      @if ($report_slug == 'post-secondary-career-prep')
        <h3 class="slide-title light-blue">{{ trans('esdr2.post_sec_heading') }}</h3>
        @include('components.chart-legend')
        <iframe scrolling="no" id="frameId-14" class="tableau-embed" src="//public.tableau.com/views/ESDR1/11_SatSurv2?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
      @endif

      @if ($report_slug == 'prov-exams')
        <h3 class="slide-title light-blue">{{ trans('esdr2.prov_exam_heading') }}</h3>
        @include('components.chart-legend')
        <iframe scrolling="no" id="frameId-12" class="tableau-embed" src="//public.tableau.com/views/ESDR1/10_Exams?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
      @endif

      @if ($report_slug == 'transition-to-post-secondary')
        <h3 class="slide-title light-blue">{{ trans('esdr2.transition_to_post_sec_heading') }}</h3>
        <iframe scrolling="no" id="frameId-15" class="tableau-embed" src="//public.tableau.com/views/ESDR1/12_STP?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
      @endif

    </div>
  </section>

@endsection

@section('subtitle'){{ $school_district->district_name }} {{ trans('esdr2.sd_heading') }}: {{ $report_headings[$sd_report_slugs[$current_report_index - 0]] }}@endsection
