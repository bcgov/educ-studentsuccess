<div id="header">
  <div class="restrain">
    <div id="logo">
      <a href="http://www2.gov.bc.ca/"><img src="/img/gov3_bc_logo.png" alt="Government of B.C." title="Government of B.C."></a>
    </div>

    @if(Route::getCurrentRoute()->uri() != '/')
      <h1 class="visuallyhidden">@yield('subtitle')</h1>
    @else
      <h1 class="visuallyhidden">{{ trans('esdr2.site_title') }} - @yield('subtitle')</h1>
    @endif

    <div id="language-switcher">
      <a class="{{ App::getLocale() }} language-switcher<?php if (App::isLocale('en')) print ' active'; ?>" href="{{ url('lang/en') }}">English </a><span style="color:white;">|</span>

      {{-- This `if` condition is temporary while the site is being translated. --}}
      <a onclick="javascript: alert('Ce site sera disponible en français prochainement.');" class="{{ App::getLocale() }} language-switcher<?php if (App::isLocale('fr')) print ' active'; ?>" href="#">Français</a>


    </div>
  </div>
</div><!-- /#header -->

<nav id="secondary-nav" class="contracted">
  <div class="expand sub-menu-trigger restrain">{{ trans('esdr2.open_trigger') }} <i class="fa fa-caret-down" aria-hidden="true"></i></div>
  <ul class="secondary-nav-container restrain white">
    <li><a class="secondary-nav-link" href="/">{{ trans('esdr2.home_link') }}</a></li>
    <li><a class="secondary-nav-link" href="/all/school-districts">School Districts</a></li>
    <li><a class="secondary-nav-link" href="/all/cities">Cities</a></li>
    <li><a class="secondary-nav-link" href="/childcare">Child Care</a></li>
	  <li><a class="secondary-nav-link" href="/reporting">Resources and Analytics</a></li>
    <li><a class="secondary-nav-link" href="/glossary">{{ trans('esdr2.glossary_heading') }}</a></li>
  </ul>
</nav>
