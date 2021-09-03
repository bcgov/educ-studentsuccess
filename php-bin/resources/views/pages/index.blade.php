@extends('layout')
@section('subtitle'){{ date('Y') }}@endsection

@section('content')
<section class="slide" id="top-section" style="margin-bottom: -5px;">
  <div class="aqua-bg" id="hero">
    <div class="restrain">
    
      <!--<p class="white"><span class="title2-font">{{ trans('esdr2.welcome_heading1') }} </span> <strong><span class="title-font">{{ trans('esdr2.welcome_heading2') }}</span></strong></p>
      <p class="white title-font"><strong>{{ trans('esdr2.welcome_heading3') }}</strong></p>-->
      <!--<p id="tagline">{{ trans('esdr2.tagline') }}</p>-->
      <img class="main-title" src="{{URL::to('/')}}/img/information-title.png" alt=""/>

       <h3 id="search" class="white">{{ trans('esdr2.main_search_label') }} </h3>
       <!-- <img class="down-arrow" src="{{URL::to('/')}}/img/down-arrow.png" alt=""/></h3>  -->
      <br>
      <div class="restrain bgw">
        <div class="halfs">
           <span aria-hidden="true" title="{{ trans('esdr2.clear_search_label') }}" id="clear-search"><i class="fa fa-search"></i></span>
           <!-- &times; -->
          <input class="search" id="main-search" type="text" placeholder="{{ trans('esdr2.search_placeholder') }}" />
        </div>     
        <div class="halfs search-right all-districts">
          |  <a class="view-all" href="/all/school-districts">{{ trans('esdr2.school_districts_button') }}</a>
          |  <a class="view-all" href="/all/cities">{{ trans('esdr2.cities_button') }}</a>
        </div>  

      </div>
      <!--
      <div id="main-search-wrapper">
        <span aria-hidden="true" title="{{ trans('esdr2.clear_search_label') }}" id="clear-search">&times;</span>
        <input class="search" id="main-search" type="text" placeholder="{{ trans('esdr2.search_placeholder') }}" />
      </div>
      <div id="main-search-button-wrapper" class="center">
        <a class="big main-search button" href="/all/school-districts">{{ trans('esdr2.school_districts_button') }}</a>
        <a class="big main-search button" href="/all/cities">{{ trans('esdr2.cities_button') }}</a>
      </div>
-->
    </div>
  </div>
</section>
@include('components/about-this-website')

@endsection

@push('css')
  <link href="/css/easy-autocomplete.min.css" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
  <script src="/js/jquery.easy-autocomplete.min.js"></script>
  <script src="/js/vega/promise.min.js"></script>
  <script src="/js/vega/symbol.min.js"></script>
  <script src="/js/vega/fetch.min.js"></script>
  <!--<script src="/js/vega/vega.min.js"></script>
  <script src="/js/vega/vega5.js"></script> -->
	<script src="/js/front.js{{ !App::environment('production', 'staging') ? '?cache_bust='.rand() : '' }}"></script>
@endpush
