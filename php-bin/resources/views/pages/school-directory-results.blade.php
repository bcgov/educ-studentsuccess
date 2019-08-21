@extends('layout')
@section('subtitle'){{ trans('esdr2.sd_directory_heading') }} {{ Helper::formatCityForHuman($selected_city) }} {{ 'B.C.' }}@endsection

@section('content')

  <div class="aqua-bg directory-masthead">
    <div class="restrain">
      <h2 id="directory-main-heading" class="ministry-blue slide-title">{{ trans('esdr2.city_directory_heading') }} - {{ Helper::formatCityForHuman($selected_city) }}</h2>
    </div>
  </div>

  @include('components.school-directory-results-table')

@endsection
