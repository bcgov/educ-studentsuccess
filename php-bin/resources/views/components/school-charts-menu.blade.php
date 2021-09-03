<div class="restrain">

  @if (!$school->w_enrol1 && !$school->w_enrol2 && !$school->w_fsa1 && !$school->w_fsa2 && !$school->w_g2g && !$school->w_exam && !$school->w_sat1 && !$school->w_sat2 && !$school->w_psi)

    <h3 class="ministry-blue slide-title">{{ trans('esdr2.reports_heading2') }}</h3>
    <p>{{ trans('esdr2.no_data_error1') }}</p>

  @else

    <h3 id="available-reports" class="ministry-blue slide-title">{{ trans('esdr2.reports_heading1') }}:</h3>

    <nav id="table-of-contents">

      @if ($school->w_enrol1 || $school->w_enrol2)
        <h4 class="toc slide-sub-heading">{{ trans('esdr2.context_information_heading') }}</h4>
        <ul class="toc-sub-section">
          <li class="toc-chart">
            <a href="/school/{{ $school->mincode }}/report/contextual-information"><img alt="{{ trans('esdr2.alt_text_demographic') }}" class="toc-chart-thumbnail" src="/img/charts/chart1_context_300x200.png" />
            {{ trans('esdr2.demographic_lable') }}</a>
          </li>
        </ul>
      @endif
<!--
      @if ($school->w_fsa1 || $school->w_fsa2 || $school->w_g2g || $school->w_exam)
        <h4 class="toc slide-sub-heading">{{ trans('esdr2.intel_dev_heading') }}</h4>
        <ul class="toc-sub-section">
      @endif
        @if ($school->w_fsa1 || $school->w_fsa2) {{-- FSA Student Growth Over Time - Reading, FSA Student Growth Over Time - Writing, FSA Student Growth Over Time - Numeracy --}}
          <li class="toc-chart">
            <a href="/school/{{ $school->mincode }}/report/fsa"><img alt="Image of a chart depicting Student Growth Over Time." class="toc-chart-thumbnail" src="/img/charts/chart4_fsa_300x200.png" />
            {{ trans('esdr2.fsa_heading') }}</a>
          </li>
        @endif
        @if ($school->w_g2g) {{-- Grade-to-Grade Transitions --}}
          <li class="toc-chart">
            <a href="/school/{{ $school->mincode }}/report/grade-to-grade-transitions"><img alt="Image of a chart depicting Student Grade to Grade Transitions." class="toc-chart-thumbnail" src="/img/charts/chart5_grade-to-grade_300x200.png" />
            {{ trans('esdr2.g2g_heading') }}</a>
          </li>
        @endif
        @if ($school->w_exam) {{-- Provincial Examinations --}}
          <li class="toc-chart">
            <a href="/school/{{ $school->mincode }}/report/prov-exams"><img alt="Image of a chart depicting BC Provincial Examinations Scores." class="toc-chart-thumbnail" src="/img/charts/chart7_exams_300x200.png" />
            {{ trans('esdr2.prov_exam_heading') }}</a>
          </li>
        @endif
      @if ($school->w_fsa1 || $school->w_fsa2 || $school->w_g2g || $school->w_exam)
        </ul>
      @endif

      @if ($school->w_sat1)
        <h4 class="toc slide-sub-heading">{{ trans('esdr2.human_and_social_heading') }}</h4>
        <ul class="toc-sub-section">
          <li class="toc-chart">
            <a href="/school/{{ $school->mincode }}/report/student-satisfaction"><img alt="Image of a chart depicting Student Satisfaction." class="toc-chart-thumbnail" src="/img/charts/chart8_satsurvey_300x200.png" />
            {{ trans('esdr2.student_sat_heading') }}</a>
          </li>
        </ul>
      @endif

      @if ($school->w_sat2 || $school->w_psi)
        <h4 class="toc slide-sub-heading">{{ trans('esdr2.career_development_heading') }}</h4>
        <ul class="toc-sub-section">
      @endif
        @if ($school->w_sat2) {{-- Post-Secondary and Career Preparation --}}
          <li class="toc-chart">
            <a href="/school/{{ $school->mincode }}/report/post-secondary-career-prep"><img alt="Image of a chart depicting Post-Secondary and Career Preparation values." class="toc-chart-thumbnail" src="/img/charts/chart6_post-secondary_300x200.png" />
            {{ trans('esdr2.post_sec_heading') }}</a>
          </li>
        @endif
        @if ($school->w_psi) {{-- Transition to BC Post-Secondary Education --}}
          <li class="toc-chart">
            <a href="/school/{{ $school->mincode }}/report/transition-to-post-secondary"><img alt="Small image of a infographic depicting values pertinent to students transitioning to post-secondary education." class="toc-chart-thumbnail" src="/img/charts/chart9_transition_300x200.png" />
            {{ trans('esdr2.transition_to_post_sec_heading') }}</a>
          </li>
        @endif
      @if ($school->w_sat2 || $school->w_psi)
        </ul>
      @endif
-->
    </nav>

  @endif

</div>
