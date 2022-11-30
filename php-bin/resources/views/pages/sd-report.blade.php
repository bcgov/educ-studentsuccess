
@extends('layout')
@section('content')

@include('components.sd-meta')
<script>
$(function() {
  // bind change event to select
  $('#dynamic_select').on('change', function() {
    var url = $(this).val(); // get selected value
    if (url) { // require a URL

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
            <option value="/school-district/{{ $school_district->sd }}/report/student-satisfaction">Student Satisfaction and Wellness</option>
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
        @foreach ($labels as $key=>$label)
        <h3 class="slide-title light-blue">{{$label}}</h3>
        <div id="desktopView{{ $key }}" class="desktop"></div>
        <div id="tabletView{{ $key }}" class="tablet"></div>
        <div id="mobileView{{ $key++ }}" class="mobile"></div>
        
        <br>
        @endforeach

        @foreach ($mobileData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#mobileView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($desktopData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#desktopView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($tabletData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#tabletView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
      @endif

      @if ($report_slug == 'students-entering-school')
        
        <h3 class="slide-title light-blue">{{ trans('esdr2.students_entering_school_heading') }}</h3>
        <iframe scrolling="no" id="frameId-8" class="tableau-embed" src="//public.tableau.com/views/ESDR1/4_EDI?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 50%;"></div> 
      @endif

      @if ($report_slug == 'completion-rates')
        @include('components.chart-legend')
    
        @foreach ($labels as $key=>$label)
        <h3 class="slide-title light-blue">{{$label}}</h3>
        <div id="desktopView{{ $key }}" class="desktop"></div>
        <div id="tabletView{{ $key }}" class="tablet"></div>
        <div id="mobileView{{ $key++ }}" class="mobile"></div>
        
        <br>
        @endforeach

        @foreach ($mobileData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#mobileView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($desktopData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#desktopView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($tabletData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#tabletView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
      @endif

      @if ($report_slug == 'fsa')
        
        @include('components.chart-legend')
        @foreach ($labels as $key=>$label)
        <h3 class="slide-title light-blue">{{$label}}</h3>
        <div id="desktopView{{ $key }}" class="desktop"></div>
        <div id="tabletView{{ $key }}" class="tablet"></div>
        <div id="mobileView{{ $key++ }}" class="mobile"></div>
        
        <br>
        @endforeach

        @foreach ($mobileData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#mobileView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($desktopData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#desktopView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($tabletData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#tabletView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
      @endif

      @if ($report_slug == 'grade-to-grade-transitions')
        @foreach ($labels as $key=>$label)
          <h3 class="slide-title light-blue">{{$label}}</h3>
          <div id="desktopView{{ $key }}" class="desktop"></div>
          <div id="tabletView{{ $key }}" class="tablet"></div>
          <div id="mobileView{{ $key++ }}" class="mobile"></div>
          
          <br>
        @endforeach    
        @foreach ($mobileData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#mobileView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($desktopData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#desktopView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($tabletData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#tabletView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach

      @endif

      @if ($report_slug == 'student-satisfaction')

        @include('components.chart-legend')
        @foreach ($labels as $key=>$label)
          <h3 class="slide-title light-blue">{{$label}}</h3>
          <div id="desktopView{{ $key }}" class="desktop"></div>
          <div id="tabletView{{ $key }}" class="tablet"></div>
          <div id="mobileView{{ $key++ }}" class="mobile"></div>
          
          <br>
        @endforeach    
        @foreach ($mobileData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#mobileView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($desktopData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#desktopView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($tabletData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#tabletView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach

        @endif
      @if ($report_slug == 'post-secondary-career-prep')
        @include('components.chart-legend')
        @foreach ($labels as $key=>$label)
          <h3 class="slide-title light-blue">{{$label}}</h3>
          <div id="desktopView{{ $key }}" class="desktop"></div>
          <div id="tabletView{{ $key }}" class="tablet"></div>
          <div id="mobileView{{ $key++ }}" class="mobile"></div>
          
          <br>
        @endforeach    
        @foreach ($mobileData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#mobileView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($desktopData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#desktopView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($tabletData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#tabletView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach

      @endif

      @if ($report_slug == 'prov-exams')
        <h3 class="slide-title light-blue">{{ trans('esdr2.prov_exam_heading') }}</h3>
        @include('components.chart-legend')
        <iframe scrolling="no" id="frameId-12" class="tableau-embed" src="//public.tableau.com/views/ESDR1/13_Assessments?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{ $school_district->sd }}"></iframe>
        <div style="background:white;margin-top: -41px;position:absolute;height: 27px;width: 100%;"></div> 
      @endif
      @if ($report_slug == 'grad-assess')
        @include('components.chart-legend')
        @foreach ($labels as $key=>$label)
        <h3 class="slide-title light-blue">{{$label}}</h3>
        <div id="desktopView{{ $key }}" class="desktop"></div>
        <div id="tabletView{{ $key }}" class="tablet"></div>
        <div id="mobileView{{ $key++ }}" class="mobile"></div>
        
        <br>
        @endforeach

        @foreach ($mobileData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#mobileView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($desktopData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#desktopView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($tabletData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#tabletView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
      @endif

      @if ($report_slug == 'transition-to-post-secondary')
        @foreach ($labels as $key=>$label)
        <h3 class="slide-title light-blue">{{$label}}</h3>
        <div id="desktopView{{ $key }}" class="desktop"></div>
        <div id="tabletView{{ $key }}" class="tablet"></div>
        <div id="mobileView{{ $key++ }}" class="mobile"></div>
       
        <br>
        @endforeach
        @foreach ($mobileData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#mobileView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($desktopData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#desktopView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
        @foreach ($tabletData as $key=>$data)
          <script type="text/javascript"> 
            var view;        
            var spec = {!! json_encode($data) !!};
            var viewVar = "#tabletView"+{{ $key++ }};
            console.log(viewVar);
            vegaEmbed(viewVar, spec, {"actions": false}).then(function(result) {
              // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
            }).catch(console.error);                     
          </script>
        @endforeach
      @endif

    </div>
  </section>

@endsection

@section('subtitle'){{ $school_district->district_name }} {{ trans('esdr2.sd_heading') }}: {{ $report_headings[$sd_report_slugs[$current_report_index - 0]] }}@endsection
@push('scripts') 
	<script src="https://vega.github.io/vega/assets/promise.min.js"></script>
	<script src="https://vega.github.io/vega/assets/symbol.min.js"></script>
	<script src="https://vega.github.io/vega/assets/fetch.min.js"></script>
	<script src="https://vega.github.io/vega/vega.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vega@5"></script>
@endpush