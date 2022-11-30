
<div class="restrain">
  <nav id="table-of-contents">   
    <ul class="toc-sub-section">
      <li class="toc-chart sd-chart">
        <h4 class="toc slide-sub-heading">School District<br>Information</h4>
        <img class="green-bar" style="margin:0px; float: left" src="{{URL::to('/')}}/img/green-bar-1.png" alt=""/>
      </li>  
      <li class="toc-chart sd-chart">
        <div class='image'>
          <a href="/school-district/{{ $school_district->sd }}/report/contextual-information">
            <img alt="{{ trans('esdr2.alt_text_demographic') }}" class="toc-chart-thumbnail report-icon" src="/img/charts/icon-demographic-information.jpg" />
            <h4 class='bottom-left'><span class="spacer">Demographic</span> <br><span class="spacer">Information</span></h4>
          </a>
        </div>	
      </li>
      <li class="toc-chart sd-chart">
        <div class='image'>
              <a href=" /governance/{{ $school_district->sd }}">
                <img alt="{{ trans('esdr2.alt_governance_information_heading') }}" class="toc-chart-thumbnail report-icon" src="/img/charts/icon-governance-information.png" />
                <h4 class='bottom-left'><span class="spacer">Key</span> <br><span class="spacer">Contacts</span></h4>
              </a>
        </div>     
      </li>
      <li class="toc-chart sd-chart">
        <div class='image'>
          <a href=" /finance/{{ $school_district->sd }}">
            <img alt="{{ trans('esdr2.alt_financial_information_heading') }}" class="toc-chart-thumbnail report-icon" src="/img/charts/icon-finance-information.png" />
            <h4 class='bottom-left'><span class="spacer">Financial</span> <br><span class="spacer">Information</span></h4>
          </a>
        </div>     
      </li>
    </ul>
<hr>   
    <ul class="toc-sub-section">
      <li class="toc-chart sd-chart">
        <h4 class="toc slide-sub-heading">Intellectual<br>Development</h4>
        <img class="green-bar" style="margin:0px; float: left" src="{{URL::to('/')}}/img/green-bar-1.png" alt=""/>
      </li>
      <li class="toc-chart sd-chart">
        <div class='image'>
          <a href="/school-district/{{ $school_district->sd }}/report/completion-rates">
            <img alt="Image of a chart depicting Student Completion Rates." class="toc-chart-thumbnail report-icon" src="/img/charts/icon-completion-rate.jpg" />
            <h4 class='bottom-left'><span class="spacer">Completion</span> <br><span class="spacer">Rate</span></h4>
          </a>
        </div>  
      </li>
      <li class="toc-chart sd-chart">
        <div class='image'>
          <a href="/school-district/{{ $school_district->sd }}/report/fsa">
            <img alt="Image of a chart depicting Student Growth Over Time." class="toc-chart-thumbnail report-icon" src="/img/charts/icon-foundation-skills-assessment.jpg" />
            <h4 class='bottom-left'><span class="spacer">Foundation Skills</span> <br><span class="spacer">Assessment</span></h4>
          </a>
        </div>  
      </li>
      <li class="toc-chart sd-chart">
        <div class='image'>
          <a href="/school-district/{{ $school_district->sd }}/report/grade-to-grade-transitions">
            <img alt="Image of a chart depicting Student Grade to Grade Transitions." class="toc-chart-thumbnail report-icon" src="/img/charts/icon-grade-to-grade-transitions.jpg" />
            <h4 class='bottom-left'><span class="spacer">Grade-to-Grade</span> <br><span class="spacer">Transitions</span></h4>
          </a>
        </div>  
      </li>
      <li class="toc-chart sd-chart">
        <div class='image'>  
          <a href="/school-district/{{ $school_district->sd }}/report/grad-assess">
            <img alt="Image of a chart depicting BC Provincial Assessment Scores." class="toc-chart-thumbnail report-icon" src="/img/charts/icon-provincial-examinations.jpg" />
            <h4 class='bottom-left'><span class="spacer">Graduation</span> <br><span class="spacer">Assessments</span></h4>
          </a>
        </div>  
      </li>
    </ul>
<hr>   
    <ul class="toc-sub-section">
      <li class="toc-chart sd-chart"><h4 class="toc slide-sub-heading">Human<br>and Social<br>Development</h4>
        <img class="green-bar" style="margin:0px; float: left" src="{{URL::to('/')}}/img/green-bar-1.png" alt=""/>
      </li>
      <li class="toc-chart sd-chart">
        <div class='image'>
          <a href="/school-district/{{ $school_district->sd }}/report/students-entering-school">
            <img alt="Image of a chart depicting education data." class="toc-chart-thumbnail report-icon" src="/img/charts/icon-characteristicsistudents-entering-school.jpg" />
            <h4 class='bottom-left'><span class="spacer">Characteristics of<br></span><span class="spacer">Students Entering <br>School</span></h4>
          </a>
        </div>  
      </li>
      <li class="toc-chart sd-chart"><a href="/school-district/{{ $school_district->sd }}/report/student-satisfaction">
        <div class='image'>
          <a href="/school-district/{{ $school_district->sd }}/report/student-satisfaction">
            <img alt="Image of a chart depicting Student Satisfaction." class="toc-chart-thumbnail report-icon" src="/img/charts/icon-student-satisfaction.jpg" />
            <h4 class='bottom-left'><span class="spacer">Student<br></span><span class="spacer">Learning Survey</span></h4>
          </a>
        </div>  
      </li>
    </ul>
<hr>
    
    <ul class="toc-sub-section">
      <li class="toc-chart sd-chart">
        <h4 class="toc slide-sub-heading">Career<br>Development</h4>
        <img class="green-bar" style="margin:0px; float: left" src="{{URL::to('/')}}/img/green-bar-1.png" alt=""/>
      </li>
      {{-- This is an excetion for Mission School District. See also: SchoolDistrictsController@getSdReport and pages.sd-report --}}
      @if ($school_district->sd != '075')
        <li class="toc-chart sd-chart">
          <div class='image'>
            <a href="/school-district/{{ $school_district->sd }}/report/post-secondary-career-prep">
              <img alt="Image of a chart depicting Post-Secondary and Career Preparation values." class="toc-chart-thumbnail report-icon" src="/img/charts/icon-post-secondary-career-prep.jpg" />            
              <h4 class='bottom-left'><span class="spacer">Post-Secondary<br></span><span class="spacer">and Career Preparation</span></h4>
            </a>
          </div>  
        </li>
      @endif
      <li class="toc-chart sd-chart">
        <div class='image'>
          <a href="/school-district/{{ $school_district->sd }}/report/transition-to-post-secondary">
            <img alt="Small image of a infographic depicting values pertinent to students transitioning to post-secondary education." class="toc-chart-thumbnail report-icon" src="/img/charts/icon-transition-bc-post-secondary.jpg" />       
            <h4 class='bottom-left'><span class="spacer">Transition to B.C.<br></span><span class="spacer">Post-Secondary</span></h4>
          </a>
        </div>  
      </li>
    </ul>
<hr>
    <ul class="toc-sub-section">
      <li class="toc-chart sd-chart">
        <h4 class="toc slide-sub-heading">{{ trans('esdr2.particular_reports_heading1') }}</h4>
        <img class="green-bar" style="margin:0px; float: left" src="{{URL::to('/')}}/img/green-bar-1.png" alt=""/>
      </li>
      <li class="toc-chart sd-chart">	 
      <div class='image'>
        {{-- This is an excetion for Mission School District. See also: SchoolDistrictsController@getSdReport and pages.sd-report --}}
        @if ($school_district->sd != '099')		  
          <a id="ahawd-download-report-link" data-sd="{{ $school_district->sd }}" href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-{{ $school_district->sd }}.pdf" target="_blank">
          <img alt="Image of a chart depicting Aboriginal: How Are We Doing reports." class="toc-chart-thumbnail report-icon" src="/img/charts/ahawd.png" />
          <h4 class='bottom-left'><span class="spacer" style="color:white;">Aboriginal Students: <br></span><span class="spacer" style="color:white;">How Are We Doing?</span><br> <span style="color:white;">(PDF) </a></span><span style="color:white;">(<a href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-{{ $school_district->sd }}.xlsx" target="_blank"><span style="color:white;">XLXS</span></a>)</span></h4>
          <br><br>
      </div>
        @else  
          <a id="ahawd-download-report-link" data-sd="{{ $school_district->sd }}" href="https://www2.gov.bc.ca/assets/gov/education/administration/kindergarten-to-grade-12/reports/ab-hawd/ab-hawd-school-district-public.pdf" target="_blank">
          <img alt="Image of a chart depicting Aboriginal: How Are We Doing reports." class="toc-chart-thumbnail report-icon" src="/img/charts/ahawd.png" />
          <h4 class='bottom-left'><span class="spacer" style="color:white;">Aboriginal Students: <br></span><span class="spacer" style="color:white;">How Are We Doing?</span><br> <span style="color:white;">(PDF) </a></span><span style="color:white;">(<a href="https://www2.gov.bc.ca/assets/download/3319D82A9B1945E28B893B0031524D6F" target="_blank"><span style="color:white;">XLXS</span></a>)</span></h4>
          <br><br>
        @endif		  
      </li>
      <!-- <li class="toc-chart sd-chart">
        @if ($school_district->sd == '099')	
          <a id="hawd-download-report-link" href="https://www2.gov.bc.ca/assets/download/041C7A8EDD2A4CF880AAEAD05CC7A3E0"><img alt="Image of the cover for How are we doing report." class="toc-chart-thumbnail" src="/img/charts/CYICthumb.png" />
            {{ trans('esdr2.how_are_we_doing_report_heading') }}</a> (PDF)
        @endif    
      </li>
      <li class="toc-chart sd-chart">
        @if ($school_district->sd == '099')
          <a id="hawd-download-report-link" href="/enrolment-app"><img alt="Image of 2 students." class="toc-chart-thumbnail" src="/img/Icon_Student_Enrollment.png" />
        {{ trans('esdr2.enrolment_app_heading') }}
          </a>
        @endif  
      </li> -->
    </ul>
  </nav>
</div>
