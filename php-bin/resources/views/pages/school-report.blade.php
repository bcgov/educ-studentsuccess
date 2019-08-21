@extends('layout')

@section('content')

  @include('components.school-meta')

  <section class="slide aqua-bg options-row">
    <div class="slide-content restrain">

      <div class="sd-sub-nav">

        @php

          if (count($school_report_slugs) > 0) {

            $current_report_index = array_search($report_slug, $school_report_slugs);

            // Map translated headings to report type.
            $report_headings = array(
              'contextual-information' => trans('esdr2.context_information_heading'), 
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
            print '<a class="big button previous" href="/school/'.$school->mincode.'/report/'.$school_report_slugs[$current_report_index - 1].'"><i class="fa fa-angle-left" aria-hidden="true"></i> '.$report_headings[$school_report_slugs[$current_report_index - 1]].'</a>';
            }

          @endphp

          <a class="big button information" href="/school/{{ $school->mincode }}">{{ trans('esdr2.reports_heading1') }}</a>

          @php

            if ($current_report_index + 1 < count($school_report_slugs)) {
              print '<a class="big button next" href="/school/'.$school->mincode.'/report/'.$school_report_slugs[$current_report_index + 1].'">'.$report_headings[$school_report_slugs[$current_report_index + 1]].' <i class="fa fa-angle-right" aria-hidden="true"></i></a>';
            }

          }

        @endphp

      </div>

    </div>
  </section>

  <section style="padding-top: 3rem;" class="slide fill-viewport">
    <div class="slide-content restrain">

      {{-- See `workfiles/School Level Chart Matrix.xlsx for more info. --}}

      @if ($report_slug == 'contextual-information')
        @if ($school->w_enrol1)
          <h3 class="slide-title light-blue">{{ trans('esdr2.2_Enrolment') }}</h3>
          <iframe scrolling="no" id="frameId-6" class="tableau-embed" src="//public.tableau.com/views/ESDR2/2_Enrolment?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&Mincode={{ $school->mincode }}"></iframe>
        @endif
        @if ($school->w_enrol2)
          <h3 class="slide-title light-blue">{{ trans('esdr2.3_StudByGrade') }} {{ $metadata['school_contextual_allgrades_yr'] }}</h3>
          <iframe scrolling="no" id="frameId-7" class="tableau-embed" src="//public.tableau.com/views/ESDR2/3_StudByGrade?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&Mincode={{ $school->mincode }}"></iframe>
        @endif
      @endif

      @if ($report_slug == 'fsa')

        @if ($school->w_fsa1)

          <h3 class="slide-title light-blue">{{ trans('esdr2.fsa_heading') }}</h3>

          @if($school->fsa_writers_re_4 >= 1)
            <h4 class="light-blue sub-sub-heading">{{ trans('esdr2.grade_heading') }} 4</h4>
            @include('components.chart-legend')
            <iframe scrolling="no" id="frameId-101-school" class="tableau-embed" src="//public.tableau.com/views/ESDR2/7a_FSA4?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&Mincode={{ $school->mincode }}"></iframe>
          @endif

          @if($school->fsa_writers_re_7 >= 1)
            <h4 class="light-blue sub-sub-heading">{{ trans('esdr2.grade_heading') }} 7</h4>
            @include('components.chart-legend')
            <iframe scrolling="no" id="frameId-101b-school" class="tableau-embed" src="//public.tableau.com/views/ESDR2/7b_FSA7?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&Mincode={{ $school->mincode }}"></iframe>
          @endif

        @endif

        @if ($school->w_fsa2)

          <h3 class="slide-title light-blue">{{ trans('esdr2.fsa_heading2') }} - {{ trans('esdr2.fsa_heading_reading') }}</h3>
          <iframe scrolling="no" id="frameId-102" class="tableau-embed" src="//public.tableau.com/views/ESDR2/8_FSA2?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&Mincode={{ $school->mincode }}&SKILL=Reading"></iframe>
          @include('components.chart-legend_fsa')

          <h3 class="slide-title light-blue">{{ trans('esdr2.fsa_heading3') }} - {{ trans('esdr2.fsa_heading_writing') }}</h3>
          <iframe scrolling="no" id="frameId-103" class="tableau-embed" src="//public.tableau.com/views/ESDR2/8_FSA2?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&Mincode={{ $school->mincode }}&SKILL=Writing"></iframe>
          @include('components.chart-legend_fsa')

          <h3 class="slide-title light-blue">{{ trans('esdr2.fsa_heading4') }} - {{ trans('esdr2.fsa_heading_numeracy') }}</h3>
          <iframe scrolling="no" id="frameId-104" class="tableau-embed" src="//public.tableau.com/views/ESDR2/8_FSA2?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&Mincode={{ $school->mincode }}&SKILL=Numeracy"></iframe>
          @include('components.chart-legend_fsa')

        @endif

      @endif

      @if ($report_slug == 'grade-to-grade-transitions' && $school->w_g2g)
        <h3 class="slide-title light-blue">{{ trans('esdr2.g2g_heading') }}</h3>
        <iframe scrolling="no" id="frameId-11" class="tableau-embed" src="//public.tableau.com/views/ESDR2/9_G2G?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&Mincode={{ $school->mincode }}"></iframe>
      @endif

      @if ($report_slug == 'student-satisfaction' && $school->w_sat1)
        <h3 class="slide-title light-blue">{{ trans('esdr2.student_sat_heading') }}</h3>
        @include('components.chart-legend')
        <iframe scrolling="no" id="frameId-13" class="tableau-embed" src="//public.tableau.com/views/ESDR2/11_SatSurv?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&Mincode={{ $school->mincode }}"></iframe>
      @endif

      @if ($report_slug == 'post-secondary-career-prep' && $school->w_sat2)
        <h3 class="slide-title light-blue">{{ trans('esdr2.post_sec_heading') }}</h3>
        <iframe scrolling="no" id="frameId-14" class="tableau-embed" src="//public.tableau.com/views/ESDR2/11_SatSurv2?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&Mincode={{ $school->mincode }}"></iframe>
      @endif

      @if ($report_slug == 'prov-exams' && $school->w_exam)
        <h3 class="slide-title light-blue">{{ trans('esdr2.prov_exam_heading') }}</h3>
        @include('components.chart-legend')
        <iframe scrolling="no" id="frameId-12" class="tableau-embed" src="//public.tableau.com/views/ESDR2/10_Exams?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&Mincode={{ $school->mincode }}"></iframe>
      @endif

      @if ($report_slug == 'transition-to-post-secondary' && $school->w_psi)
        <h3 class="slide-title light-blue">{{ trans('esdr2.transition_to_post_sec_heading') }}</h3>
        <iframe scrolling="no" id="frameId-15" class="tableau-embed" src="//public.tableau.com/views/ESDR2/12_STP?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&Mincode={{ $school->mincode }}"></iframe>
      @endif

    </div>
  </section>

@endsection

{{-- Add subtitle for page based on params. passed from controller. --}}
@section('subtitle'){{ $school->school_name }}: {{ $report_headings[$school_report_slugs[$current_report_index - 0]] }}@endsection
