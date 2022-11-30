@if ($report_slug == 'contextual-information')
  <h3 class="ministry-blue" id="report-subtitle">{{ trans('esdr2.context_information_heading') }}</h3>
  <p class="white report-meta">{{ trans('esdr2.contextual_info_copy') }}</p>
  {{-- <p class="white report-meta">For more information about this district and their plans for enhancing student learning, please refer to the district's Web site.</p> --}}
  <p class="white report-meta">For a more complete set including additional years and subpopulations view the open data for <a href="https://catalogue.data.gov.bc.ca/dataset/bc-schools-student-enrolment-and-fte-by-grade">Student Enrolment and FTE by Grade</a></p>

@endif

@if ($report_slug == 'students-entering-school')
  <h3 class="ministry-blue" id="report-subtitle">{{ trans('esdr2.early_development_heading') }}</h3>
  <p class="white report-meta">{{ trans('esdr2.early_development_copy') }}<br><br><a target="_blank" href="http://earlylearning.ubc.ca/edi">{{ trans('esdr2.learn_more_devel_link') }}</a></p>
@endif

@if ($report_slug == 'completion-rates')
  <h3 class="ministry-blue" id="report-subtitle">{{ trans('esdr2.completion_rate_heading') }}</h3>
  <p class="white report-meta">{{ trans('esdr2.comp_rate_copy1') }} <a href="http://www2.gov.bc.ca/gov/content?id=86CA1D62603948EBBDC4410399842DED">{{ trans('esdr2.comp_rate_link1') }}</a> {{ trans('esdr2.comp_rate_copy2') }} <a href="http://www2.gov.bc.ca/gov/content?id=9A33DD439E184672865E4DDF677F4002">{{ trans('esdr2.comp_rate_link2') }}</a>, {{ trans('esdr2.comp_rate_copy3') }}</p>
  <p class="white report-meta">For a more complete set including additional years and subpopulations please see open data for <a href="https://catalogue.data.gov.bc.ca/dataset/bc-schools-six-year-completion-rate">Six Year Completion Rates</a></p>
@endif

@if ($report_slug == 'fsa')
  <h3 class="ministry-blue" id="report-subtitle">{{ trans('esdr2.fsa_heading') }}</h3>
  <p class="white report-meta">{{ trans('esdr2.fsa_copy1') }}</p>
  <p class="white report-meta">For a more complete set including additional years and subpopulations view the open data for <a href="https://catalogue.data.gov.bc.ca/dataset/bc-schools-foundation-skills-assessment-fsa-">FSA</a></p>
@endif

@if ($report_slug == 'grade-to-grade-transitions')
  <h3 class="ministry-blue" id="report-subtitle">{{ trans('esdr2.g2g_heading') }}</h3>
  <p class="white report-meta">{{ trans('esdr2.g2g_copy1') }}</p>
<p class="white report-meta">For a more complete set including additional years and subpopulations view the open data for <a href="https://catalogue.data.gov.bc.ca/dataset/bc-schools-grade-to-grade-transition">Grade to Grade Transition</a></p>
@endif

@if ($report_slug == 'student-satisfaction')
  <h3 class="ministry-blue" id="report-subtitle">{{ trans('esdr2.student_sat_heading') }}</h3>
  <p class="white report-meta">{{ trans('esdr2.student_sat_copy1') }}</p>
  <p class="white report-meta"><a href="http://www2.gov.bc.ca/gov/content?id=E7AB48A7A39D4CC2935463F806306AD0">{{ trans('esdr2.student_sat_link1') }}</a></p>
@endif

@if ($report_slug == 'post-secondary-career-prep')
  <h3 class="ministry-blue" id="report-subtitle">{{ trans('esdr2.post_sec_heading') }}</h3>
  <p class="white report-meta">{{ trans('esdr2.post_sec_copy1') }}</p>
@endif

@if ($report_slug == 'grad-assess')
  <h3 class="ministry-blue" id="report-subtitle">{{ trans('esdr2.prov_exam_heading') }}</h3>
  <p class="white report-meta">Graduation assessments have changed to align with the new curriculum. As part of the updated graduation requirements, students in the <a href="https://www2.gov.bc.ca/gov/content/education-training/k-12/support/graduation">B.C. Graduation Program</a> will complete three provincial assessments. These assessments focus on the demonstration and application of <strong>numeracy</strong> and <strong>literacy</strong>. The graduation assessments are a valuable indicator of where individual students might have challenges in literacy and numeracy and can be used to help plan their education. They also provide a snapshot of how our education system is meeting the needs of students in these key areas.</p>
  <ul class="white" style="margin-left: 16px;">
    <li style="list-style: square;"><a href="https://curriculum.gov.bc.ca/assessment/grade-10-numeracy-assessment">{{trans('esdr2.prov_exams_copy1')}}</a> {{trans('esdr2.prov_exams_copy_explain')}}</li>
    <li style="list-style: square;"><a href="https://curriculum.gov.bc.ca/assessment/literacy-assessment/grade-10-literacy-assessment">{{trans('esdr2.prov_exams_copy2')}}</a> {{trans('esdr2.prov_exams_copy_explain')}}</li>
	<li style="list-style: square;"><a href="https://curriculum.gov.bc.ca/assessment/literacy-assessment/grade-12-literacy-assessment">{{trans('esdr2.prov_exams_copy3')}}</a> {{trans('esdr2.prov_exams_copy_explain2')}}</li>
  </ul>
   <p class="white report-meta">There will be no course-based Language Arts 12 provincial exams after the 2018/19 school year.</p>	
  <p class="white report-meta" style="margin-top: 1rem;"><a target="_blank" href="https://curriculum.gov.bc.ca/provincial/assessment">{{ trans('esdr2.prov_exams_link1') }}</a></p>
  <p class="white report-meta">For a more complete set including additional years and subpopulations view the open data for <a href="https://catalogue.data.gov.bc.ca/dataset/graduation-assessments">Graduation Assessments</a> </p>
@endif

@if ($report_slug == 'prov-exams')
  <h3 class="ministry-blue" id="report-subtitle">{{ trans('esdr2.prov_exam_heading') }}</h3>
  <p class="white report-meta">Graduation assessments have changed to align with the new curriculum. As part of the updated graduation requirements, students in the <a href="https://www2.gov.bc.ca/gov/content/education-training/k-12/support/graduation">B.C. Graduation Program</a> will complete three provincial assessments. These assessments focus on the demonstration and application of <strong>numeracy</strong> and <strong>literacy</strong>. The graduation assessments are a valuable indicator of where individual students might have challenges in literacy and numeracy and can be used to help plan their education. They also provide a snapshot of how our education system is meeting the needs of students in these key areas.</p>
  <ul class="white" style="margin-left: 16px;">
    <li style="list-style: square;"><a href="https://curriculum.gov.bc.ca/assessment/grade-10-numeracy-assessment">{{trans('esdr2.prov_exams_copy1')}}</a> {{trans('esdr2.prov_exams_copy_explain')}}</li>
    <li style="list-style: square;"><a href="https://curriculum.gov.bc.ca/assessment/literacy-assessment/grade-10-literacy-assessment">{{trans('esdr2.prov_exams_copy2')}}</a> {{trans('esdr2.prov_exams_copy_explain')}}</li>
	<li style="list-style: square;"><a href="https://curriculum.gov.bc.ca/assessment/literacy-assessment/grade-12-literacy-assessment">{{trans('esdr2.prov_exams_copy3')}}</a> {{trans('esdr2.prov_exams_copy_explain2')}}</li>
  </ul>
   <p class="white report-meta">There will be no course-based Language Arts 12 provincial exams after the 2018/19 school year.</p>	
  <p class="white report-meta" style="margin-top: 1rem;"><a target="_blank" href="https://curriculum.gov.bc.ca/provincial/assessment">{{ trans('esdr2.prov_exams_link1') }}</a></p>
  <p class="white report-meta">For a more complete set including additional years and subpopulations view the open data for <a href="https://catalogue.data.gov.bc.ca/dataset/graduation-assessments">Graduation Assessments</a> </p>
@endif



@if ($report_slug == 'transition-to-post-secondary')
  <h3 class="ministry-blue" id="report-subtitle">{{ trans('esdr2.transition_to_post_sec_heading') }}</h3>
  <p class="white report-meta">{{ trans('esdr2.transition_to_post_sec_copy1') }}</p>
  <ul class="white" style="margin-left: 16px;">
    @if (isset($school))
      <li style="list-style: square;">{{ trans('esdr2.transition_to_post_sec_student_copy2') }} {{ $metadata['school_stp_cohort_yr'] }} </li>
      <li style="list-style: square;">{{ trans('esdr2.transition_to_post_sec_copy3') }} {{ $metadata['school_stp_grad_yr'] }}</li>
      <li style="list-style: square;">{{ trans('esdr2.transition_to_post_sec_copy4') }} {{ $metadata['school_stp_psi_yr'] }}</li> 
    @else
      <li style="list-style: square;">{{ trans('esdr2.transition_to_post_sec_copy2') }} {{ $metadata['district_stp_cohort_yr'] }}</li>
      <li style="list-style: square;">{{ trans('esdr2.transition_to_post_sec_copy3') }} {{ $metadata['district_stp_grad_yr'] }}</li>
      <li style="list-style: square;">{{ trans('esdr2.transition_to_post_sec_copy4') }} {{ $metadata['district_stp_psi_yr'] }}</li>
    @endif
  </ul>
  <p class="white report-meta">{{ trans('esdr2.transition_to_post_sec_copy5') }}</p>
  <p class="white report-meta" style="margin-top: 1rem;"><a href="http://www2.gov.bc.ca/gov/content/education-training/post-secondary-education/data-research/student-transitions-project">{{ trans('esdr2.transition_to_post_sec_link1') }}</a></p>
@endif
