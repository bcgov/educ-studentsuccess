@extends('layout')
@section('subtitle'){{ trans('esdr2.not_found1') }}@endsection

@section('content')

  <div class="aqua-bg fill-viewport error-page" id="hero">
    <div class="restrain">

      <h2 id="report-title" class="center">{{ trans('esdr2.not_found1') }}</h2>
      <p id="tagline">
        {{ trans('esdr2.not_found_copy1') }}<br>
        {{ trans('esdr2.not_found_copy2') }} <a href="javascript: history.go(-1)">{{ trans('esdr2.not_found_link3') }}</a> {{ trans('esdr2.not_found_copy4') }} <a href="/">{{ trans('esdr2.not_found_link5') }}.</a><br><br>
        {{ trans('esdr2.try_our_search_tools_copy') }}<br>
      </p>

      <h3 id="search" class="white center">{{ trans('esdr2.main_search_label') }}</h3>
      
      <div id="main-search-wrapper">
        <span id="clear-search">&times;</span>
        <input id="main-search" type="text" placeholder="{{ trans('esdr2.search_placeholder') }}" />
      </div>

      <div id="main-search-button-wrapper" class="center">
        <a class="big main-search button" href="/all/school-districts">{{ trans('esdr2.school_districts_button') }}</a>
        <a class="big main-search button" href="/all/cities">{{ trans('esdr2.cities_button') }}</a>
      </div>

    </div>
  </div>

  @include('components/about-this-website')

@endsection

@push('css')
  <link href="/css/easy-autocomplete.min.css" rel="stylesheet" type="text/css">
  <style>
    
    #hero.error-page #report-title {
      background: transparent;
    }

  </style>
@endpush

@push('scripts')
  <script src="/js/jquery.easy-autocomplete.min.js"></script>
  <script src="/js/front.js"></script>
@endpush
