<div class="restrain">
  <div id="back-to-top"><span class="new-line"><i style="padding-top: 7px;" class="fa fa-chevron-up" aria-hidden="true"></i></span><span id="back-to-top-trigger">{{ trans('esdr2.back_to_top') }}</span></div>
</div>

<div id="footer-bar-thing">
  <div class="restrain">
    
    <div class="some-links">

      <a class="some-link" title="{{ trans('esdr2.share_this_page') }} Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//studentsuccess.gov.bc.ca/{{ Request::path() }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
    
      <a class="some-link" title="{{ trans('esdr2.share_this_page') }} Twitter" target="_blank" href="https://twitter.com/home?status=http%3A//studentsuccess.gov.bc.ca/{{ Request::path() }}%20Check%20out%20this%20page%20on%20the%20B.C.%20Education%20Performance%20Website%20%23bced"><i class="fa fa-twitter" aria-hidden="true"></i></a>

      <a class="some-link" title="{{ trans('esdr2.share_this_page') }} Pintrest" target="_blank" href="https://pinterest.com/pin/create/button/?url=http%3A//studentsuccess.gov.bc.ca/{{ Request::path() }}&media=http%3A//studentsuccess.gov.bc.ca/img/happy_people.png&description=Check%20out%20the%20great%20work%20being%20done%20by%20%23bced"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
      
      <a class="some-link" title="{{ trans('esdr2.share_this_page_email') }}" href="mailto:?body={{ Request::url() }}&subject={{ trans('esdr2.checkout_this_page') }}"><i class="fa fa-envelope" aria-hidden="true"></i></a>
    </div>

  </div>
</div>

<footer id="footer">
  <div class="restrain">

    <nav>
      <ul>
        <li><a href="http://www2.gov.bc.ca/gov/content/home">{{ trans('esdr2.footer_home_link') }}</a></li>
        <li><a href="http://www2.gov.bc.ca/gov/content/about-gov-bc-ca">{{ trans('esdr2.footer_about_link') }}</a></li>
        <li><a href="http://www2.gov.bc.ca/gov/content/home/disclaimer">{{ trans('esdr2.footer_disclaimer_link') }}</a></li>
        <li><a href="http://www2.gov.bc.ca/gov/content/home/privacy">{{ trans('esdr2.footer_privacy_link') }}</a></li>
        <li><a href="http://www2.gov.bc.ca/gov/content/home/accessibility">{{ trans('esdr2.footer_accessibility_link') }}</a></li>
        <li><a href="http://www2.gov.bc.ca/gov/content/home/copyright">{{ trans('esdr2.footer_copywrite_link') }}</a></li>
        <li><a href="http://www2.gov.bc.ca/gov/content/home/contact-us">{{ trans('esdr2.footer_contactus_link') }}</a></li>
      </ul>
    </nav>

    <p class="white" style="padding: 2rem 0;">{{ trans('esdr2.footer_formore_questions') }} <a style="text-decoration: underline;" href="mailto:educ.systemperformance@gov.bc.ca">educ.systemperformance@gov.bc.ca</a>.</p>

  </div>
</footer><!-- /#footer -->
