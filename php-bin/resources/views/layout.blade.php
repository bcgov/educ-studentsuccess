<!DOCTYPE html>
<html lang="{{ App::getLocale() }}"> 
<head>

  <meta charset="utf-8">
  <meta name="description" content="{{ trans('esdr2.meta_desc') }}">
  <meta name="keywords" content="bc, education, performance, schools, british columbia">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ trans('esdr2.site_title') }} - @yield('subtitle')</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/x-icon" href="/favicon.ico">

  {{-- Template specific CSS --}}
  @stack('css')
  <link href="/css/style.css{{ !App::environment('production', 'staging') ? '?cache_bust='.rand() : '' }}" rel="stylesheet" type="text/css">
  <link href="/css/studentsuccess.css" rel="stylesheet" type="text/css">
<!--  <link href="/css/bootstrap4.css" rel="stylesheet" type="text/css">-->
  <script src="/js/vega/promise.min.js"></script>
  <script src="/js/vega/symbol.min.js"></script>
  <script src="/js/vega/fetch.min.js"></script>
  <!--<script src="/js/vega/vega.min.js"></script>
  <script src="/js/vega/vega5.js"></script>-->
  <script src="https://cdn.jsdelivr.net/npm/vega@5"></script>
  <script src="https://cdn.jsdelivr.net/npm/vega-lite@3"></script>
  <script src="https://cdn.jsdelivr.net/npm/vega-embed@5"></script>
   {{-- Include Snowplow Analytics on every page. --}}
   @if (App::environment('production'))
		<script type="text/javascript">
// <!-- Snowplow starts plowing - Standalone vE.2.14.0 -->
;(function(p,l,o,w,i,n,g){if(!p[i]){p.GlobalSnowplowNamespace=p.GlobalSnowplowNamespace||[];
 p.GlobalSnowplowNamespace.push(i);p[i]=function(){(p[i].q=p[i].q||[]).push(arguments)
 };p[i].q=p[i].q||[];n=l.createElement(o);g=l.getElementsByTagName(o)[0];n.async=1;
 n.src=w;g.parentNode.insertBefore(n,g)}}(window,document,"script","https://www2.gov.bc.ca/StaticWebResources/static/sp/sp-2-14-0.js","snowplow"));
var collector = 'spt.apps.gov.bc.ca';
 window.snowplow('newTracker','rt',collector, {
  appId: "Snowplow_standalone",
  cookieLifetime: 86400 * 548,
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
//  <!-- Snowplow stop plowing -->
			

		</script>
  @else
    <!-- Snowplow outputs here when enviroment variable is set to PRODUCTION. -->
	<script type="text/javascript">
	// <!-- Snowplow starts plowing - Standalone vE.2.14.0 -->
	;(function(p,l,o,w,i,n,g){if(!p[i]){p.GlobalSnowplowNamespace=p.GlobalSnowplowNamespace||[];
	 p.GlobalSnowplowNamespace.push(i);p[i]=function(){(p[i].q=p[i].q||[]).push(arguments)
	 };p[i].q=p[i].q||[];n=l.createElement(o);g=l.getElementsByTagName(o)[0];n.async=1;
	 n.src=w;g.parentNode.insertBefore(n,g)}}(window,document,"script","https://www2.gov.bc.ca/StaticWebResources/static/sp/sp-2-14-0.js","snowplow"));
	var collector = 'spt.apps.gov.bc.ca';
	 window.snowplow('newTracker','rt',collector, {
	  appId: "Snowplow_standalone",
	  cookieLifetime: 86400 * 548,
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
	//  <!-- Snowplow stop plowing -->
	</script>
  @endif  
</head>

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
  $(function(){
    // bind change event to select
    $('#dynamic_select').on('change', function () {
        var url = $(this).val(); // get selected value
        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });
  });
</script>
<!-- <script>
    vegaEmbed(
      '#view',
      'https://raw.githubusercontent.com/StevenjHiggs90/G2G/master/mobile_comp_a'
    );
  </script> -->
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
<style>
  html, body { height: 100% }
</style>
  {{-- Dump all template specific scripts into this template. --}}
  @stack('scripts')

</body>
</html>
