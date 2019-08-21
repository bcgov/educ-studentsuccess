@extends('layout')
@section('subtitle'){{ $school->school_name }} {{ trans('esdr2.school_reports_label') }}@endsection

@section('content')

  @include('components.school-meta')

  <section class="slide aqua-bg options-row">
    <div class="slide-content restrain">

      <div class="sd-sub-nav">

        @if (!$school->independent)
          <a class="big button" href="/school-district/{{ $school->sd }}">{{ trans('esdr2.about_sd_label') }} {{ Helper::removeLeadingZeros($school->sd) }}</a>
        @endif
        
      </div>

    </div>
  </section>

  <section class="slide light-gray-bg" style="padding-top: 3rem; padding-bottom: 3rem;">
    @include('components.school-charts-menu')
  </section>

@endsection
