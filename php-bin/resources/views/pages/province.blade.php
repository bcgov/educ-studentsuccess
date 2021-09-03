@extends('layout')
@section('subtitle'){{ $school_district->district_name }} {{ trans('esdr2.sd_heading') }}@endsection

@section('content')

  <section class="slide blue-bg" style="padding-top: 3rem;">
    <div class="slide-content restrain">

      <img src="/img/maps/map_sd_099.png" alt="Map of British Columbia" class="key-image thirds">

      <p class="white school-meta">{{ trans('esdr2.prov_results_label') }}</p>
      
      <h2 class="ministry-blue slide-title">{{ trans('esdr2.british_columbia_heading') }}</h2>

      <p class="school-meta white">

        @if ($school_district->phy_address_line_1)
          {{ trans('esdr2.ministry_of_education_lable') }}: <a target="_blank" href="https://www.google.ca/maps/place/{{ str_replace(' ', '+', $school_district->present()->formatSchoolDistrictAddress) }}">{{ $school_district->present()->formatSchoolDistrictAddress }}</a>
        @endif

        @if ($school_district->contact_phone) 
          <br>{{ trans('esdr2.phone_contact_label') }}: <a href="tel:{{ $school_district->present()->concatPhoneNumber }}">{{ $school_district->contact_phone }}</a>
        @endif

        @if ($school_district->contact_phone_extension) 
          ext. {{ $school_district->contact_phone_extension }}
        @endif

        @if ($school_district->website) 
          <br>{{ trans('esdr2.website_contact_label') }}: <a href="{{ $school_district->website }}" target="_blank">www2.gov.bc.ca</a>
        @endif

        @if ($school_district->contact_first_name && $school_district->position && $school_district->contact_last_name)
          <br>{{ $school_district->position }}: {{ $school_district->contact_first_name }} {{ $school_district->contact_last_name }}
        @endif

      </p>

    </div>
  </section>
 
  <section class="slide aqua-bg">
    <div class="slide-content restrain">

      <div class="sd-sub-nav">

        @if ($school_district->website) 
          <a class="big button" href="{{ $school_district->website }}" target="_blank">{{ trans('esdr2.provincial_website_lable') }}</a>
        @endif

        <a id="main-download-report-link" data-sd="099" class="big button" href="/pdf/Enhanced-School-District-Report-for-SD099.pdf">{{ trans('esdr2.download_report_lable') }} (PDF)</a>

      </div>

    </div>
  </section>
  <div style="margin-top: -5px; padding-top:4rem; padding-bottom: 6rem; background-image: url('{{URL::to('/')}}/img/bg-images/bg-narrow-grey-1.jpg');background-repeat: no-repeat;" class="reports-heading">
    <div class="restrain">
      <h3 class="ministry-blue slide-title">
        {{ trans('esdr2.reports_heading1') }}
      </h3>
    </div>
  </div>
  <section class="slide" style="padding-top: 3rem; padding-bottom: 3rem;">
    @include('components.sd-charts-menu')
  </section>
  <div style="margin-top: -5px; padding-top:4rem; padding-bottom: 5rem; background-image: url('{{URL::to('/')}}/img/bg-images/bg-district-foot.jpg');background-repeat: no-repeat;" class="reports-heading">
  <div class="restrain">
    <div class="row">
      <div class="col-sm-12 col-md-5">
        <img src="/img/reports-pic.png" alt="picture of reports" width="auto" height="190px">
      </div>
      <div class="col-sm-12 col-md-7">
        <p><h3 class="dark-blue">FSA Item Analysis</h3></p>
        <p><img class="green-bar" style="margin:0px; float: left" src="{{URL::to('/')}}/img/green-bar-2.png" alt=""/><br></p>
        <p>Reports for educators to help interpret and understand<br>
          student's results for hte provincial Grades 4 and 7 Foundation<br>
          Skills Assessment.
        </p>
        <p><a class="btn btn-primary btn-lg" style="border-radius:0px;" href="/fsa/index.html">View the Data+</a></p>
      </div>
    </div>
  </div>
</div>
@endsection
