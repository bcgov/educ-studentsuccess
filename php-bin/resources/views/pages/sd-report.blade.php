
@extends('layout')
@section('content')

@include('components.sd-meta')
<script>
$(function() {
  // bind change event to select
  $('#dynamic_select').on('change', function() {
    var url = $(this).val(); // get selected value
    if (url) { // require a URL
      console.log($school_district->sd)
      window.location = url; // redirect
    }
    return false;
  });
});
</script>
  <section class="slide aqua-bg options-row">
    <div class="slide-content restrain">
    <div class="form-group">
      <!-- <label class="control-label col-sm-offset-2 col-sm-2" for="company">Company</label> -->
    </div>
    <div class="sd-sub-nav">

      <div class="col-sm-12 col-md-8 more-reports">
          <select id="dynamic_select" class="form-control report-select">
            <option value="" selected>Select another report</option>
            <option value="/school-district/{{ $school_district->sd }}/report/contextual-information">Demographic Information</option>
            <option value="/governance/{{ $school_district->sd }}">Key contacts</option>
            <option value="/finance/{{ $school_district->sd }}">Financial Information</option>
            <option value="/school-district/{{ $school_district->sd }}/report/completion-rates">Completion Rate</option>
            <option value="/school-district/{{ $school_district->sd }}/report/fsa">Foundation Skills Assessment</option>
            <option value="/school-district/{{ $school_district->sd }}/report/grade-to-grade-transitions">Grade-to-Grade Transitions</option>
            <option value="/school-district/{{ $school_district->sd }}/report/grad-assess">Graduation Assessments</option>
            <option value="/school-district/{{ $school_district->sd }}/report/students-entering-school">Characteristics of Students Entering School</option>
            <option value="/school-district/{{ $school_district->sd }}/report/student-satisfaction">School Satisfaction</option>
            <option value="/school-district/{{ $school_district->sd }}/report/post-secondary-career-prep">Post-Secondary and Career Preparation</option>
            <option value="/school-district/{{ $school_district->sd }}/report/transition-to-post-secondary">Transition to B.C. Post-Secondary</option>
          </select> 
          
      </div>
      <div class="col-sm-12 col-md-4 more-reports">
        <a class="view-all" href="/school-district/{{ $school_district->sd }}">View All Reports</a>
      </div>
    
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
            'grad-assess' => trans('esdr2.prov_exam_heading'),
            'transition-to-post-secondary' => trans('esdr2.transition_to_post_sec_heading')
          );
          $report_headings_keys = array_keys($report_headings);
        @endphp
      </div>

    </div>
  </section>

  <section style="padding-top: 3rem;" class="slide fill-viewport">
    <div class="slide-content restrain">

      @if ($report_slug == 'contextual-information')

        <h3 class="slide-title light-blue">{{ trans('esdr2.1_ComDemo') }}</h3>
        <iframe scrolling="no" id="frameId-5" class="tableau-embed" src="//public.tableau.com/views/ESDR1/1_ComDemo?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }},099"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>
        <hr class="chart-hr" style="margin-top: 30px; margin-bottom: 50px;">

        <h3 class="slide-title light-blue">{{ trans('esdr2.2_Enrolment') }}</h3>
        <iframe scrolling="no" id="frameId-6" class="tableau-embed" src="//public.tableau.com/views/ESDR1/2_Enrolment?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>
        <hr class="chart-hr" style="margin-top: 30px; margin-bottom: 50px;">

        <h3 class="slide-title light-blue">{{ trans('esdr2.3_StudByGrade') }} {{ $metadata['district_contextual_allgrades_yr'] }}</h3>
        <iframe scrolling="no" id="frameId-7" class="tableau-embed" src="//public.tableau.com/views/ESDR1/3_StudByGrade?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>
        <hr class="chart-hr" style="margin-top: 30px; margin-bottom: 50px;">  
      @endif

      @if ($report_slug == 'students-entering-school')
        
        <h3 class="slide-title light-blue">{{ trans('esdr2.students_entering_school_heading') }}</h3>
        <iframe scrolling="no" id="frameId-8" class="tableau-embed" src="//public.tableau.com/views/ESDR1/4_EDI?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>
      @endif

      @if ($report_slug == 'completion-rates')
		 

        <h3 class="slide-title light-blue">{{ trans('esdr2.completion_rate_heading') }}</h3>
        @include('components.chart-legend')
        <iframe scrolling="no" id="frameId-91" class="tableau-embed" src="//public.tableau.com/views/ESDR2/5_CompRate?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>
        * All Students includes non-residents, some of whom are international students.  
        <hr class="chart-hr" style="margin-top: 30px; margin-bottom: 50px;">

        <h3 class="slide-title light-blue">{{ trans('esdr2.completion_rate_abbo1') }}</h3>
        <iframe scrolling="no" id="frameId-92" class="tableau-embed" src="//public.tableau.com/views/ESDR1/6_CompRate3?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}&Student%20Group=ABORIGINAL,BC%20Residents"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>
        <hr class="chart-hr" style="margin-top: 30px; margin-bottom: 50px;">

        <h3 class="slide-title light-blue">{{ trans('esdr2.completion_rate_abbo2') }}</h3>
        <iframe scrolling="no" id="frameId-93" class="tableau-embed restrain" src="//public.tableau.com/views/ESDR1/6_CompRate3?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}&Student%20Group=SPECIAL%20NEEDS,BC%20Residents"></iframe>
        <div style="background:white;margin-top: -37px;position:absolute;height: 27px;width: 100%;"></div>
        <hr class="chart-hr" style="margin-top: 30px; margin-bottom: 50px;">
      @endif

      @if ($report_slug == 'fsa')
        
        <h3 class="slide-title light-blue">{{ trans('esdr2.fsa_heading') }}</h3>
        @include('components.chart-legend')
        <iframe scrolling="no" id="frameId-101" class="tableau-embed" src="//public.tableau.com/views/ESDR1/7_FSA?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>
        <hr class="chart-hr" style="margin-top: 30px; margin-bottom: 50px;">

        <h3 class="slide-title light-blue">{{ trans('esdr2.fsa_heading2') }} - {{ trans('esdr2.fsa_heading_reading') }}</h3>
        <iframe scrolling="no" id="frameId-102" class="tableau-embed" src="//public.tableau.com/views/ESDR1/8_FSA2?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}&SKILL=Reading"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>
        @include('components.chart-legend_fsa')
        <hr class="chart-hr" style="margin-top: 30px; margin-bottom: 50px;">

        <h3 class="slide-title light-blue">{{ trans('esdr2.fsa_heading3') }} - {{ trans('esdr2.fsa_heading_writing') }}</h3>
        <iframe scrolling="no" id="frameId-103" class="tableau-embed" src="//public.tableau.com/views/ESDR1/8_FSA2?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}&SKILL=Writing"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>
        @include('components.chart-legend_fsa')
        <hr class="chart-hr" style="margin-top: 50px; margin-bottom: 50px;">

        <h3 class="slide-title light-blue" style="margin-bottom: 0;">{{ trans('esdr2.fsa_heading4') }} - {{ trans('esdr2.fsa_heading_numeracy') }}</h3>
        <iframe scrolling="no" id="frameId-104" class="tableau-embed" src="//public.tableau.com/views/ESDR1/8_FSA2?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}&SKILL=Numeracy"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>
        @include('components.chart-legend_fsa')
        <hr class="chart-hr" style="margin-top: 50px; margin-bottom: 50px;">
      @endif

      @if ($report_slug == 'grade-to-grade-transitions')
        <h3 class="slide-title light-blue">{{ trans('esdr2.g2g_heading') }}</h3>
        <iframe scrolling="no" id="frameId-11" class="tableau-embed" src="//public.tableau.com/views/ESDR1/9_G2G?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>  
        @endif

      @if ($report_slug == 'student-satisfaction')
        <h3 class="slide-title light-blue">{{ trans('esdr2.student_sat_heading') }}</h3>
        @include('components.chart-legend')
        <iframe scrolling="no" id="frameId-13" class="tableau-embed restrain" src="//public.tableau.com/views/ESDR1/11_SatSurv?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>    
        @endif

      @if ($report_slug == 'post-secondary-career-prep')
        <h3 class="slide-title light-blue">{{ trans('esdr2.post_sec_heading') }}</h3>
        @include('components.chart-legend')
        <iframe scrolling="no" id="frameId-14" class="tableau-embed" src="//public.tableau.com/views/ESDR1/11_SatSurv2?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>    
        @endif

      @if ($report_slug == 'prov-exams')
        <h3 class="slide-title light-blue">{{ trans('esdr2.prov_exam_heading') }}</h3>
        @include('components.chart-legend')
        <!-- <iframe scrolling="no" id="frameId-12" class="tableau-embed" src="//public.tableau.com/views/ESDR1/10_Exams?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe> -->
        <iframe scrolling="no" id="frameId-12" class="tableau-embed" src="//public.tableau.com/views/ESDR1/13_Assessments?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>    
      @endif
      @if ($report_slug == 'grad-assess')
        <h3 class="slide-title light-blue">{{ trans('esdr2.prov_exam_heading') }}</h3>
        @include('components.chart-legend')
        <!-- <iframe scrolling="no" id="frameId-12" class="tableau-embed" src="//public.tableau.com/views/ESDR1/10_Exams?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe> -->
        <iframe scrolling="no" id="frameId-12" class="tableau-embed" src="//public.tableau.com/views/ESDR1/13_Assessments?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>    
      @endif

      @if ($report_slug == 'transition-to-post-secondary')
        <h3 class="slide-title light-blue">{{ trans('esdr2.transition_to_post_sec_heading') }}</h3>
        <iframe scrolling="no" id="frameId-15" class="tableau-embed" src="//public.tableau.com/views/ESDR1/12_STP?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div>    
      @endif

    </div>
  </section>

@endsection

@section('subtitle'){{ $school_district->district_name }} {{ trans('esdr2.sd_heading') }}: {{ $report_headings[$sd_report_slugs[$current_report_index - 0]] }}@endsection
