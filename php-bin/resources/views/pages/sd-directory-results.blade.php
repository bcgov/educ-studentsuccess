@extends('layout')
@section('subtitle'){{ trans('esdr2.sd_directory_heading') }} {{ $district_name }} {{ trans('esdr2.sd_heading') }}@endsection

@section('content')

  <div class="aqua-bg directory-masthead">
    <div class="restrain">
      <h2 id="directory-main-heading" class="ministry-blue slide-title">{{ trans('esdr2.sd_directory_heading') }} {{ $district_name }} {{ trans('esdr2.sd_heading') }}</h2>
    </div>
  </div>

  @include('components.school-directory-results-table')

@endsection
