<div class="restrain">

  <h3 class="ministry-blue slide-title">{{ trans('esdr2.reports_heading1') }}:</h3>

  <nav id="table-of-contents">

    <h4 class="toc slide-sub-heading">{{ trans('esdr2.context_information_heading') }}</h4>
    <ul class="toc-sub-section">
      <li class="toc-chart">
        <a href="/school-district/{{ $school_district->sd }}/report/contextual-information"><img alt="{{ trans('esdr2.alt_text_demographic') }}" class="toc-chart-thumbnail" src="/img/charts/chart1_context_300x200.png" />
        {{ trans('esdr2.demographic_lable') }}</a>
      </li>
    </ul>

    <h4 class="toc slide-sub-heading">{{ trans('esdr2.intel_dev_heading') }}</h4>
    <ul class="toc-sub-section">
      <li class="toc-chart">
        <a href="/school-district/{{ $school_district->sd }}/report/completion-rates"><img alt="Image of a chart depicting Student Completion Rates." class="toc-chart-thumbnail" src="/img/charts/chart3_completion_300x200.png" />
        {{ trans('esdr2.comp_rate_heading') }}</a>
      </li>
      <li class="toc-chart">
        <a href="/school-district/{{ $school_district->sd }}/report/fsa"><img alt="Image of a chart depicting Student Growth Over Time." class="toc-chart-thumbnail" src="/img/charts/chart4_fsa_300x200.png" />
        {{ trans('esdr2.fsa_heading') }}</a>
      </li>
      <li class="toc-chart">
        <a href="/school-district/{{ $school_district->sd }}/report/grade-to-grade-transitions"><img alt="Image of a chart depicting Student Grade to Grade Transitions." class="toc-chart-thumbnail" src="/img/charts/chart5_grade-to-grade_300x200.png" />
        {{ trans('esdr2.g2g_heading') }}</a>
      </li>
      <li class="toc-chart">
        <a href="/school-district/{{ $school_district->sd }}/report/prov-exams"><img alt="Image of a chart depicting BC Provincial Examinations Scores." class="toc-chart-thumbnail" src="/img/charts/chart7_exams_300x200.png" />
        {{ trans('esdr2.prov_exam_heading') }}</a>
      </li>
    </ul>

    <h4 class="toc slide-sub-heading">{{ trans('esdr2.human_and_social_heading') }}</h4>
    <ul class="toc-sub-section">
      <li class="toc-chart">
        <a href="/school-district/{{ $school_district->sd }}/report/students-entering-school"><img alt="Image of a chart depicting education data." class="toc-chart-thumbnail" src="/img/charts/chart2_characteristics_300x200.png" />
        {{ trans('esdr2.students_entering_school_heading') }}</a>
      </li>
      <li class="toc-chart">
        <a href="/school-district/{{ $school_district->sd }}/report/student-satisfaction"><img alt="Image of a chart depicting Student Satisfaction." class="toc-chart-thumbnail" src="/img/charts/chart8_satsurvey_300x200.png" />
        {{ trans('esdr2.student_sat_heading') }}</a>
      </li>
    </ul>

    <h4 class="toc slide-sub-heading">{{ trans('esdr2.career_development_heading') }}</h4>
    <ul class="toc-sub-section">
      {{-- This is an excetion for Mission School District. See also: SchoolDistrictsController@getSdReport and pages.sd-report --}}
      @if ($school_district->sd != '075')
        <li class="toc-chart">
          <a href="/school-district/{{ $school_district->sd }}/report/post-secondary-career-prep"><img alt="Image of a chart depicting Post-Secondary and Career Preparation values." class="toc-chart-thumbnail" src="/img/charts/chart6_post-secondary_300x200.png" />
          {{ trans('esdr2.post_sec_heading') }}</a>
        </li>
      @endif
      <li class="toc-chart">
        <a href="/school-district/{{ $school_district->sd }}/report/transition-to-post-secondary"><img alt="Small image of a infographic depicting values pertinent to students transitioning to post-secondary education." class="toc-chart-thumbnail" src="/img/charts/chart9_transition_300x200.png" />
        {{ trans('esdr2.transition_to_post_sec_heading') }}</a>
      </li>
    </ul>

    <h4 class="toc slide-sub-heading">{{ trans('esdr2.particular_reports_heading1') }}</h4>
    <ul class="toc-sub-section">
      <li class="toc-chart">
		 
      {{-- This is an excetion for Mission School District. See also: SchoolDistrictsController@getSdReport and pages.sd-report --}}
      @if ($school_district->sd != '099')		  
        <a id="ahawd-download-report-link" data-sd="{{ $school_district->sd }}" href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-{{ $school_district->sd }}.pdf" target="_blank"><img alt="Image of a chart depicting Indigenous: How Are We Doing reports." class="toc-chart-thumbnail" src="/img/charts/ahawd.png" />
        {{ trans('esdr2.abo_how_are_we_doing_heading') }}</a> (PDF)
	  @else  
        <a id="ahawd-download-report-link" data-sd="{{ $school_district->sd }}" href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-public.pdf" target="_blank"><img alt="Image of a chart depicting Indigenous: How Are We Doing reports." class="toc-chart-thumbnail" src="/img/charts/ahawd.png" />
        {{ trans('esdr2.abo_how_are_we_doing_heading') }}</a>XXXXXXXXXS (PDF)
	  @endif		  
      </li>
      <li class="toc-chart">
      @if ($school_district->sd == '099')	
        <a id="hawd-download-report-link" href="https://www2.gov.bc.ca/gov/content?id=448942935B6943DCAC404E5972226C81"><img alt="Image of the cover for How are we doing report." class="toc-chart-thumbnail" src="/img/charts/CYICthumb.png" />
          {{ trans('esdr2.how_are_we_doing_report_heading') }}</a> (PDF)
      @endif    
      </li>
      <li class="toc-chart">

        <a id="hawd-download-report-link" href="/enrolment-app"><img alt="Image of 2 students." class="toc-chart-thumbnail" src="/img/Icon_Student_Enrollment.png" />
         </a>
		  
      </li>
    </ul>

  </nav>
</div>
