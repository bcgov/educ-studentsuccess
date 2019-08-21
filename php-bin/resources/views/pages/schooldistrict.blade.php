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

        <a id="main-download-report-link" data-sd="{{ $school_district->sd }}" class="big button" href="/pdf/Enhanced-School-District-Report-for-SD{{ $school_district->sd }}.pdf">{{ trans('esdr2.download_report_lable') }} (PDF)</a>

        <a class="big button" title="{{ trans('esdr2.see_all_schools_lable3') }} {{ $school_district->district_name }} {{ trans('esdr2.sd_heading') }} {{ trans('esdr2.see_all_schools_lable2') }}" href="/schools/in-school-district/{{ $school_district->sd }}">{{ trans('esdr2.see_all_schools_lable') }} {{ Helper::removeLeadingZeros($school_district->sd) }} {{ trans('esdr2.see_all_schools_lable2') }}</a> 

      </div>

    </div>
  </section>

  <section class="slide light-gray-bg" style="padding-top: 3rem; padding-bottom: 3rem;">
    @include('components.sd-charts-menu')
  </section>

@endsection
