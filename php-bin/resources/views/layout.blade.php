<!DOCTYPE html>
<html lang="{{ App::getLocale() }}"> 
<head>

  <meta charset="utf-8">
  <meta name="description" content="{{ trans('esdr2.meta_desc') }}">
  <meta name="keywords" content="bc, education, performance, schools, british columbia">

  <title>{{ trans('esdr2.site_title') }} - @yield('subtitle')</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/x-icon" href="/favicon.ico">

  {{-- Template specific CSS --}}
  @stack('css')
  <link href="/css/style.css{{ !App::environment('production', 'staging') ? '?cache_bust='.rand() : '' }}" rel="stylesheet" type="text/css">
  
   {{-- Include Snowplow Analytics on every page. --}}
   @if (App::environment('production'))
		<!-- Snowplow starts plowing - Standalone vA.2.10.2 -->
		<script type="text/javascript">
		;(function(p,l,o,w,i,n,g){if(!p[i]){p.GlobalSnowplowNamespace=p.GlobalSnowplowNamespace||[];
		 p.GlobalSnowplowNamespace.push(i);p[i]=function(){(p[i].q=p[i].q||[]).push(arguments)
		 };p[i].q=p[i].q||[];n=l.createElement(o);g=l.getElementsByTagName(o)[0];n.async=1;
		 n.src=w;g.parentNode.insertBefore(n,g)}}(window,document,"script","https://sp-js.apps.gov.bc.ca/MDWay3UqFnIiGVLIo7aoMi4xMC4y.js","snowplow"));
		 var collector = 'spt.apps.gov.bc.ca';
		 window.snowplow('newTracker','rt',collector, {
		  appId: "Snowplow_standalone",
		  platform: 'web',
		  post: true,
		  forceSecureTracker: true,
		  contexts: {
		   webPage: true,
		   performanceTiming: true
		  }
		 });
		 window.snowplow('enableActivityTracking', 30, 30); // Ping every 30 seconds after 30 seconds
		 window.snowplow('enableLinkClickTracking');
		 window.snowplow('trackPageView');
		</script>
		<!-- Snowplow stop plowing -->

  @else
    <!-- Snowplow outputs here when enviroment variable is set to PRODUCTION. -->
  @endif  
</head>

<body>

  @include('components/header')

  <main class="main-content">
    @yield('content')
  </main>

  @include('components/footer')

  {{-- JS Translations --}}
  <script>
    var jsTranslations = {};
    jsTranslations.open_trigger = '{{ trans('esdr2.open_trigger') }}';
    jsTranslations.close_trigger = '{{ trans('esdr2.close_trigger') }}';
  </script>

  {{-- Include Google Analytics on every page. --}}
  @if (App::environment('production'))

  @else
    <!-- Google Analytics outputs here when enviroment variable is set to PRODUCTION. -->
  @endif  

  <script src="/js/bundle.js{{ !App::environment('production', 'staging') ? '?cache_bust='.rand() : '' }}"></script>

  {{-- Dump all template specific scripts into this template. --}}
  @stack('scripts')

</body>
</html>
