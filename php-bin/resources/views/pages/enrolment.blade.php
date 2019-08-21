@extends('layout')
@section('subtitle'){{ trans('esdr2.glossary_heading') }}@endsection

@section('content')
<div class="container" id='intro'>
    <!-- Jumbotron / hero section, a component -->
    <div class="row">
      <div class="col-sm-12 col-md-5">
        <h2 class="intro_header">Enrolment Model</h2>
        <p>Student enrolment is influenced by four main drivers: demographics, migration, public-independent
          transition, and course load retention. All values are reported in funded Full-Time Equivalent (FTE).</p>
        <div class="cta_container mt-5">
          <a class="btn ctaBtn btn-lg mr-3" href="#enrolment_model">EXPLORE</a>
          <a class="btn ctaGhost btn-lg" href="#booklet">STATIC REPORT</a>
        </div>
        <p class="gradient_para"><i class="far fa-chart-bar"></i><span>An interactive dashboard exploring enrolment
            data</span></p>
      </div>
      <div class="col-sm-12 col-md-7">
        <img src="./assets/img/hero_isometric.png" class="isometric_img" alt="hero img">
      </div>
    </div>
  </div>

  <div class="container" id="enrolment_model">
    <div class="row">
      <div class="col-md-8 mx-auto driver_section">
        <h3 class="section_header text-center"><span>Key Metrics and Impact</span></h3>
        <p>The Ministry of Education District Enrolment Model (DEM) has been developed based on the Cohort
          Survival Method approach. This method takes into consideration the existing student population and calculates
          how many students will leave and enter the system in a given school year. These flows of students are grouped
          into
          the four enrolment drivers: Migration, Demographics, Independent-Public Student Transition, and Continuous
          Student Retention. Each of these drivers will be explained in more detail below and apply only to B.C. 
          Public
          School students.</p>
      </div>
      <div class="col-sm-12 col-md-8">
        <div id="modelContainer"></div>
      </div>

      <div class="col-sm-12 col-md-4">
        <div id='model_control'>
          <div class="controlSection">
            <h4 id="distName">SD99-Province</h4>
          </div>
          <div class="controlSection">
            <h5>Time Range</h5>
            <div id="model_slider"></div>
          </div>
          <div class="controlSection">
            <h5>School District</h5>
            <div id="model_distDropdown" class="dropDowns">
              <span>SD99-Province</span>
              <div class="list"></div>
            </div>
          </div>
          <div class="controlSection">
            <h5>District Reports</h5>
            <a class="ghostBtn reportBtn"
              href="https://www2.gov.bc.ca/gov/content/education-training/k-12/administration/program-management/reporting-on-k-12/district-reports"
              target="_blank">View Reports<i class="fa fa-angle-right ml-3"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container" id="demographics">
    <div class="row">
      <div class="col-md-8 mx-auto driver_section">
        <h3 class="section_header text-center"><span>Demographics</span></h3>
        <p>The demographics driver provides an indication of whether more kindergarten students are entering B.C. public
          schools relative for those leaving the school system through graduation. If the Net Demographics value is
          positive, it indicates that more five year olds are entering Kindergarten relative to the number of Grade 12
          students that are graduating.
        </p>
      </div>
      <div class="col-sm-12 col-md-8">
        <div id="demo_container"></div>
      </div>
      <div class="col-sm-12 col-md-4">
        <div id="demo_control">
          <div class="controlSection">
            <h5>Demographic Type</h5>
            <div id="demo_radio">
              <div>
                <input type="radio" id="ntk" name="demo-type" value="NEW_KINDERGARTEN" checked>
                <label for="ntk">New to Kindergarten</label>
              </div>
              <div>
                <input type="radio" id="grad" name="demo-type" value="GRADUATES">
                <label for="grad">Graduates</label>
              </div>
              <div>
                <input type="radio" id="net" name="demo-type" value="NET">
                <label for="net">Net Demographics</label>
              </div>
            </div>
          </div>
          <div class="controlSection">
            <h5>School District</h5>
            <button type="button" class="ghostBtn" data-toggle="modal" data-target="#demoModal">Add Districts<i
                class="fa fa-plus ml-3"></i></button>
          </div>
          <div id="demoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Select Districts</h5>
                  <div id="demoModal_msg">(*Please select no more than 8 districts)</div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                  <div id="demo_deselect"><i class="fas fa-times mr-1"></i>Deselect All</div>
                  <button type="button" class="ghostBtn" data-dismiss="modal">Close</button>
                  <button id="demo_save" type="button" class="flatBtn" data-dismiss="modal">Save changes</button>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div id="demo_legend"></div>
      </div>
    </div>
  </div>

  <div class="container" id='migration_overview'>
    <div class="row mb-5">
      <div class="col-sm-12 col-md-4">
        <h3 class="section_header"><span>Student Migration</span></h3>
        <p>The migration driver provides a measure of how many students are entering or leaving a district. It is
          further broken down into Interprovincial migration, district to district migration, and International
          immigration. District to district migration is a transfer of students within the province, where as
          interprovincial or international migration involves students entering or exiting the Public School System
          external to B.C. and external to Canada.
        </p>
        <p>The following migration visualizations address District to District Migration. These values represent
          students from all facility types.</p>
      </div>
      <div class="col-sm-12 col-md-8">
        <div id="aniContainer">
          <div id="animationMap"></div>
          <div id="ani_control" class="row">
            <div id="play-pause" class="play"></div>
            <div id="ani-slider" class="col-6"></div>
            <div id="ani_year">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="container" id="flow_map">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <div id="mapContainer">
          <div id="interactiveMap"></div>
        </div>
      </div>

      <div class="col-sm-12 col-md-4">
        <h3 class="section_header"><span>Where Do Students Go</span></h3>
        <div id='flow_control'>
          <div class="controlSection">
            <h5>School Year</h5>
            <div id="yearDropdown" class="dropDowns" tabindex="1">
              <span>2017/2018</span>
              <div class="list">
                <div data-value="2018">2017/2018</div>
                <div data-value="2017">2016/2017</div>
                <div data-value="2016">2015/2016</div>
                <div data-value="2015">2014/2015</div>
                <div data-value="2014">2013/2014</div>
              </div>
            </div>
          </div>
          <div class="controlSection">
            <h5>School District</h5>
            <div id="distDropdown" class="dropDowns" tabindex="1">
              <span>Select a school district</span>
              <div class="list"></div>
            </div>
          </div>
          <div class="controlSection">
            <h5>Migration Flow</h5>
            <div id="flow_type">
              <h6 class="mr-3">Type</h6>
              <button class="flowBtn selected" id="btn_all" value="all">All</button>
              <button class="flowBtn" id="btn_inflow" value="inflow">Inflow</button>
              <button class="flowBtn" id="btn_outflow" value="outflow">Outflow</button>
            </div>
            <div id="flow_switch">
              <h6>Top 5 Flow</h6>
              <input type="checkbox" id="flat_switch" />
              <label for="flat_switch"></label>
            </div>
            <img class="img-fluid" src="/assets/img/flow_legend.png" alt="flow legend">
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="container" id="transition">
    <div class="row">
      <div class="col-md-8 mx-auto driver_section">
        <h3 class="section_header text-center"><span>Public-Independent Student Transition</span></h3>
        <p>The transition driver measures how many students move from the Independent School system to the Public School
          system as a net positive outflow, and movement from the Public School system to the Independent School system
          as a net negative outflow.</p>
      </div>
      <div class="col-sm-12 col-md-5">
        <div id="trans_control">
          <h5>School Year</h5>
          <div id="trans_slider">
          </div>
        </div>

        <div id="graph_container">

          <h5 class="col-12 text-center trans_title">Transition Overview (% is of the total enrolment)</h5>
          <div id="school_graph">
            <div>
              <img id="public_school_icon" class="img-fluid" src="/assets/img/public2.png" alt="public school">
              <h6 class="text-center font-weight-bold">Public</h6>
            </div>
            <div id="trans_rate" class="col-3">
              <div id="pub_to_ind" class="text-center"></div>
              <div id="ind_to_pub" class="text-center"></div>
            </div>
            <div>
              <img id="independent_school_icon" class="img-fluid" src="/assets/img/independent2.png"
                alt="independent school">
              <h6 class="text-center font-weight-bold">Independent</h6>
            </div>
          </div>


        </div>
      </div>

      <div class="col-sm-12 col-md-7">
        <div id="trans_control_2">
          <div class="col-7">
            <h5>School District</h5>
            <div id="trans_dist_dropdown" class="dropDowns" tabindex="1">
              <span>Top 5 districts</span>
              <div class="list">
              </div>
            </div>
          </div>
          <div class="col-5">
            <h5>Transition Type</h5>
            <div id="trans_type_dropdown" class="dropDowns" tabindex="1">
              <span>Public entered</span>
              <div class="list">
                <div data-value="ENTER_PUBLIC">Public entered</div>
                <div data-value="LEAVE_PUBLIC">Public left</div>
                <div data-value="NET_INDEPENDENT">Net change</div>
              </div>
            </div>
          </div>
        </div>

        <div id="transition_container"></div>
      </div>
    </div>
  </div>

  <div class="container" id="retention">
    <div class="row">
      <div class="col-md-8 mx-auto driver_section">
        <h3 class="section_header text-center"><span>Full-time to Part-time Retention</span></h3>
        <p>The retention driver provides an indication if students are moving from a full course load to a partial
          course load or vice-versa. If net retention is positive, then students are increasing their course loads on
          average compared to the previous year. If net retention is negative, then students are decreasing their course
          load on average compared to the previous year.</p>
      </div>
      <div class="col-sm-12 col-md-8">
        <div id="retention_control">
          <div class="row">
            <div class="controlSection col-7">
              <h5>School District</h5>
              <div id="retention_distDropdown" class="dropDowns" tabindex="1">
                <span>SD05-Southeast Kootenay</span>
                <div class="list"></div>
              </div>
            </div>
          </div>
        </div>

        <div id="retention_container"></div>
      </div>

      <div class="col-sm-12 col-md-4 d-flex flex-wrap align-items-center">
        <img src="./assets/img/retention_img.png" class="isometric_img" alt="retention_dcr">
      </div>

    </div>
  </div>

  <div class="container" id="booklet">
    <div class="row">
      <div class="col-md-8 mx-auto  mb-5 text-center driver_section">
        <h3 class="section_header"><span>B.C. School Enrolment Booklet</span></h3>
        <h5>For more data at the provincial and district levels. Please view the detailed 2018/2019 B.C. School Enrolment
          Booklet.</h5>
        <a class="btn ctaBtn btn-lg" href="#" role="button">DOWNLOAD</a>
      </div>
    </div>
  </div>
@endsection
@push('css')
  <link href="/css/enrolmentCSS/styles-bootstrap4.css" rel="stylesheet" type="text/css">
@endpush
@push('scripts')
  <script src="/js/d3_js/d3.v4.min.js"></script>
  <script src="/js/d3_js/leaflet.js"></script>
  <script src="/js/d3_js/popper.min.js"></script>
  <script src="/js/d3_js/demographics.js"></script>
  <script src="/js/d3_js/enrolment_model.js"></script>
  <script src="/js/d3_js/migration_interactive_map.js"></script>
  <script src="/js/d3_js/migration_overview.js"></script>
  <script src="/js/d3_js/retention.js"></script>
  <script src="/js/d3_js/transition.js"></script>
  //'php-bin/resources/assets/js/leaflet.js',
          //'php-bin/resources/assets/js/vendor/popper.min.js',
          //'php-bin/resources/assets/js/d3_js/demographics.js',
          //'php-bin/resources/assets/js/d3_js/enrolment_model.js',
          //'php-bin/resources/assets/js/d3_js/migration_interactive_map.js',
          //'php-bin/resources/assets/js/d3_js/migration_overview.js',
          //'php-bin/resources/assets/js/d3_js/retention.js',
          //'php-bin/resources/assets/js/d3_js/transition.js'
@endpush

