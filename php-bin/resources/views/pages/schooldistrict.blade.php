@extends('layout')
@section('subtitle'){{ $school_district->district_name }} {{ trans('esdr2.sd_heading') }}@endsection

@section('content')

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

      <a id="main-download-report-link" data-sd="{{ $school_district->sd }}" class="big button" href="/pdf/Enhanced-School-District-Report-for-SD{{ $school_district->sd }}.pdf">{{ trans('esdr2.download_report_lable') }}
        (PDF)</a>

      <a class="big button" title="{{ trans('esdr2.see_all_schools_lable3') }} {{ $school_district->district_name }} {{ trans('esdr2.sd_heading') }} {{ trans('esdr2.see_all_schools_lable2') }}" href="/schools/in-school-district/{{ $school_district->sd }}">{{ trans('esdr2.see_all_schools_lable') }}
        {{ Helper::removeLeadingZeros($school_district->sd) }} {{ trans('esdr2.see_all_schools_lable2') }}</a>

    </div>

  </div>
</section>
<div style="margin-top: -5px; padding-top:4rem; padding-bottom: 6rem; background-image: url('{{URL::to('/')}}/img/bg-images/bg-narrow-grey-1.jpg');background-repeat: repeat-x;" class="reports-heading">
  <div class="restrain">
    <h3 class="ministry-blue slide-title">
      {{ trans('esdr2.reports_heading1') }}
    </h3>
  </div>
</div>
<section class="slide " style="background-image: url('{{URL::to('/')}}/img/bg-images/bg-body-available-reports.jpg');background-repeat: no-repeat;">
  @include('components.sd-charts-menu')
</section>
<div style="margin-top: -5px; padding-top:4rem; padding-bottom: 5rem; background-image: url('{{URL::to('/')}}/img/bg-images/bg-district-foot.jpg');background-repeat: repeat-x;" class="reports-heading">
  <div class="restrain">
    <div class="row">
      <div class="col-sm-12 col-md-5">
        <img src="/img/reports-pic.png" alt="picture of reports" width="auto" height="190px">
      </div>
      <div class="col-sm-12 col-md-7">
        <p>
        <h3 class="dark-blue">FSA Item Analysis</h3>
        </p>
        <p><img class="green-bar" style="margin:0px; float: left" src="{{URL::to('/')}}/img/green-bar-2.png" alt="" /><br></p>
        <p>Reports for educators to help interpret and understand<br>
          students' results for the provincial Grades 4 and 7 Foundation<br>
          Skills Assessment.
        </p>
        <p><a class="btn btn-primary btn-lg" style="border-radius:0px;" href="/fsa/index.html">View the Data
            +</a></p>
      </div>
    </div>
  </div>
</div>
@endsection