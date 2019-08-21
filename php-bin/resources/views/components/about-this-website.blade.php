<section class="slide" id="about-this-website">
  <div class="slide-content restrain">
    <!-- About this Website -->
    <div class="light-gray-bg top-stripe">
    <h2 class="slide-title light-blue center">{{ trans('esdr2.about_site_heading') }}</h2>
    <img class="green-bar" src="{{URL::to('/')}}/img/green-bar.png" alt=""/>
	  <h3 class="light-blue center">{{ trans('esdr2.about_copy12') }}</h3>    
    <div class="restrain">
      <div class="halfs">
        <p>{{ trans('esdr2.about_copy6') }}  <a href="http://www2.gov.bc.ca/gov/content/education-training/administration/kindergarten-to-grade-12/enhancing-student-learning"></a>{{ trans('esdr2.about_copy7') }}</a></p>
        <p>
          {{ trans('esdr2.about_copy8') }} <a href="http://www.bced.gov.bc.ca/apps/imcl/imclWeb/Home.do">{{ trans('esdr2.about_copy9') }}</a>. {{ trans('esdr2.about_copy10') }} <a href="/glossary">{{ trans('esdr2.about_copy11') }}</a>.
        </p>
      </div>
      <div class="halfs">
        <p>{{ trans('esdr2.about_copy1') }}  
            <div class="halfs"><div class="halfs"><img class="stat-icons" src="{{URL::to('/')}}/img/analyze-graphic.png" alt=""/></div><div class="halfs"><p class="light-blue">{{ trans('esdr2.about_copy4') }}</p></div></div>
            <div class="halfs"><div class="halfs"><img class="stat-icons" src="{{URL::to('/')}}/img/strategic-graphic.png" alt=""/></div><div class="halfs"><p class="light-blue">{{ trans('esdr2.about_copy5') }}</p></div></div>     
        </p>
      </div>
    </div>
    </div>
    <!-- Educated Citizen
    <h2 style="margin-top: 4rem;" class="slide-title light-blue center">{{ trans('esdr2.educated_citz_heading') }}</h2> -->
    <img class="educated-citizen" src="{{URL::to('/')}}/img/educated-citizen.png" alt=""/>
    <div class="green-bg">
      <p class="white-text">{{ trans('esdr2.educated_citz_copy1') }}</p>
      <p class="white-text">{{ trans('esdr2.educated_citz_copy2') }}</p>
    </div>
    
    <div class="light-gray-bg bottom-stripe">
    <div class="restrain">
    <h2 style="" class="slide-title light-blue center">{{ trans('esdr2.about_contact_heading2') }}</h2>
    <img class="green-bar" src="{{URL::to('/')}}/img/green-bar.png" alt=""/>
    <!-- Questions Section -->
       
        
          <p>{{ trans('esdr2.about_copy3') }}</p>
          <ul class="light-blue halfs">
            <li>{{ trans('esdr2.about_question1') }}</li>
            <li>{{ trans('esdr2.about_question2') }}</li>
            <li>{{ trans('esdr2.about_question3') }}</li>
            <li>{{ trans('esdr2.about_question4') }}</li>
          </ul>
          <ul class="light-blue halfs">
            <li>{{ trans('esdr2.about_question5') }}</li>
            <li>{{ trans('esdr2.about_question6') }}</li>
            <li>{{ trans('esdr2.about_question7') }}</li>
          </ul>
        </div>
    </div>

    <h2 style="" class="slide-title light-blue center">{{ trans('esdr2.feedback_heading') }}</h2>
    <img class="green-bar" src="{{URL::to('/')}}/img/green-bar.png" alt=""/>
    <p class="center">{{ trans('esdr2.feedback_copy1') }}</p>


      <p class="light-blue center">{{ trans('esdr2.feedback_question1') }} {{ trans('esdr2.feedback_question2') }} {{ trans('esdr2.feedback_question3') }}</p>
      <p class="light-blue center">{{ trans('esdr2.feedback_question4') }}</p>
     
    <div class="center button-contact"><br><a href="mailto:educ.systemperformance@gov.bc.ca">{{ trans('esdr2.contact_copy') }}</a></div>

  </div>
</section>
