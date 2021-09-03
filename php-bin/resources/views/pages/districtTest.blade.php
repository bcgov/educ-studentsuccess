@extends('layout')

@section('content')
<!-- Start of body -->
@include('components.sd-meta')

  <section class="slide aqua-bg">
    <div class="slide-content restrain">

      <div class="sd-sub-nav">

        @if ($school_district->website) 
          <a class="big button" href="{{ $school_district->website }}" target="_blank">{{ trans('esdr2.district_website_label') }}</a>
        @endif

        {{-- district_plan doesn't currently exit in the DB. This code here for future use. --}}
        @if ($school_district->district_plan)
          <a class="big button" href="#">{{ trans('esdr2.district_plan_heading') }}</a>
        @endif

        <a id="main-download-report-link" data-sd="{{ $school_district->sd }}" class="big button" href="/pdf/Enhanced-School-District-Report-for-SD{{ $school_district->sd }}.pdf">{{ trans('esdr2.download_report_lable') }} (PDF)</a>

        <a class="big button" title="{{ trans('esdr2.see_all_schools_lable3') }} {{ $school_district->district_name }} {{ trans('esdr2.sd_heading') }} {{ trans('esdr2.see_all_schools_lable2') }}" href="/schools/in-school-district/{{ $school_district->sd }}">{{ trans('esdr2.see_all_schools_lable') }} {{ Helper::removeLeadingZeros($school_district->sd) }} {{ trans('esdr2.see_all_schools_lable2') }}</a> 

      </div>

    </div>
  </section>

  <section class="slide light-gray-bg" style="padding-top: 3rem; padding-bottom: 3rem;">
    <h1>This should be a big heading for Student Success</h1>
    <br><br><br>
    <p>This is a paragraph I am writing</p>
    <br>

    <div id="view"></div>
    <script type="text/javascript">
      var view;
      fetch('https://raw.githubusercontent.com/StevenjHiggs90/G2G/master/completion_rates_b.json')
        .then(res => res.json())
        .then(spec => render(spec))
        .catch(err => console.error(err));
      function render(spec) {
	  
        view = new vega.View(vega.parse(spec), {
		
          renderer:  'canvas',  // renderer (canvas or svg)
          container: '#view',   // parent DOM container
          hover:     true       // enable hover processing
        });
        return view.runAsync();
      }
    </script>
  </section>
@endsection
@push('scripts') 
	<script src="https://vega.github.io/vega/assets/promise.min.js"></script>
	<script src="https://vega.github.io/vega/assets/symbol.min.js"></script>
	<script src="https://vega.github.io/vega/assets/fetch.min.js"></script>
	<script src="https://vega.github.io/vega/vega.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/vega@5"></script>
@endpush