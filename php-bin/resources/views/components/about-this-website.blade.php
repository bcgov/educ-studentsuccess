<section class="slide" id="about">
    <div class="slide-content">
        <!-- About this Website -->
        <div style="position:relative; background-color: #f2f0f1;">
            <!-- <img src="/img/bg-images/right-hex-pattern.png" alt="image of a gray banner" style="position:absolute; right:92px; top:38px;"> -->
            <img src="/img/bg-images/left-hexpattern.png" alt="image of a gray banner"
                style="position:absolute; right:96px; top:46px;">
            <img src="/img/bg-images/left-hexpattern.png" alt="image of a gray banner"
                style="position:absolute;left:96px; top:46px;">
            <div class="restrain">

                <h2 class="slide-title dark-blue" style="padding-top:35px; position: relative;">Insight into The
                    Education Sector</h2>
                <img class="green-bar" style="margin-left: 0px; margin-top: -33px; position: relative;"
                    src="{{URL::to('/')}}/img/green-bar-2.png" alt="" />
                <br>
                <!-- <div class="halfs" style="width:66.5%;">
					<p>School data is an important part of the B.C. education system as it strives to support each student's development. It drives continuous improvements in the education system and supports student's intellectual, human/social and career development under<a href="http://www2.gov.bc.ca/gov/content/education-training/administration/kindergarten-to-grade-12/enhancing-student-learning"> B.C.'s Framework for Enhancing Student Learning.</a></p>
					<br>
					<p>Summary reports, infographics and other data visualizations present data in context to help analyze provincial and local performance. Check out data that schools and districts use to support student learning in your area.</p>
					<p><a class="btn btn-primary btn-lg top-button" href="http://www2.gov.bc.ca/gov/content/education-training/administration/kindergarten-to-grade-12/enhancing-student-learning">GLOSSARY +</a>Look-up definitions of data terms</p>
					<p><a class="btn btn-primary btn-lg top-button data-bc-button" href="http://www2.gov.bc.ca/gov/content/education-training/administration/kindergarten-to-grade-12/enhancing-student-learning">DATABC +</a>Explore more B.C. education data</p>
					<img class="tablet-image" src="/img/bg-images/StudentSuccessTablet.png" alt="tablet picture">
				</div> -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12" style="margin-bottom:20px;">
                        <p>School data is an important part of the B.C. education system as it strives to support each
                            student's development. It drives continuous improvements in the education system and
                            supports student's intellectual, human/social and career development under<a
                                href="https://www2.gov.bc.ca/gov/content?id=9B67EA34A5F54130BB5E9D4EE6F0E16E"> B.C.'s
                                Framework for Enhancing Student Learning.</a></p>
                        <br>
                        <p>Summary reports, infographics and other data visualizations present data in context to help
                            analyze provincial and local performance. Check out data that schools and districts use to
                            support student learning in your area.</p>
                        <p><a class="btn btn-primary btn-lg top-button" href="/glossary">GLOSSARY
                                +</a>&nbsp;&nbsp;Look-up definitions of data terms</p>
                        <p><a class="btn btn-primary btn-lg top-button data-bc-button"
                                href="https://catalogue.data.gov.bc.ca/organization/ministry-of-education">DATABC
                                +</a>&nbsp;&nbsp;Explore more B.C. education data</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <img class="tablet-image" src="/img/bg-images/StudentSuccessTablet.png" alt="tablet picture">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="slide-content"> -->

    <!-- Educated Citizen
    <h2 style="margin-top: 4rem;" class="slide-title light-blue center">{{ trans('esdr2.educated_citz_heading') }}</h2> -->

    <script type="text/javascript">
    // $("#homeFrameId-6").on("load", function() {
    //   alert("Hello World");
    //   let head = $("#homeFrameId-6").contents().find("head");
    //   let css = '<style>.tab-toolbar.public.tab-fill.tab-widget {display: none;}</style>';
    //   $(head).append(css);
    // });

    function yesnoCheck() {
        if (document.getElementById('enrollment-info-check').checked) {
            document.getElementById('enrollment-info').style.display = 'block';
        } else document.getElementById('enrollment-info').style.display = 'none';

        if (document.getElementById('completion-rate-check').checked) {
            document.getElementById('completion-rate').style.display = 'block';
        } else document.getElementById('completion-rate').style.display = 'none';

        if (document.getElementById('grade-4-7-fsa-check').checked) {
            document.getElementById('grade-4-7-fsa').style.display = 'block';
        } else document.getElementById('grade-4-7-fsa').style.display = 'none';

        if (document.getElementById('provincial-assessments-check').checked) {
            document.getElementById('provincial-assessments').style.display = 'block';
        } else document.getElementById('provincial-assessments').style.display = 'none';

        if (document.getElementById('students-satisfaction-survey-check').checked) {
            document.getElementById('students-satisfaction-survey').style.display = 'block';
        } else document.getElementById('students-satisfaction-survey').style.display = 'none';

        if (document.getElementById('stp-check').checked) {
            document.getElementById('stp').style.display = 'block';
        } else document.getElementById('stp').style.display = 'none';

        if (document.getElementById('g2g-check').checked) {
            document.getElementById('g2g').style.display = 'block';
        } else document.getElementById('g2g').style.display = 'none';
    }
    //public.tableau.com/views/ESDR_PROVINCE/11_SatSurv_P?:showVizHome=no&amp;:display_share=no&amp;:embed=true&amp;:toolbar=no&amp;:device=desktop&amp;
    </script>

    <div style="position:relative;">
        <img src="/img/bg-images/BCmapSuccessHomeCropped.png" alt="image of a map of B.C."
            style="position:absolute; top:119px">
        <!-- <div class="mid-sec-bk" style="background-image: url('{{URL::to('/')}}/img/bg-images/BCmapSuccessHomeCropped.png');background-repeat: no-repeat;">	 -->
        <div class="restrain">
            <h2 class="dark-blue tp" style="text-align:left;">Overview of B.C. Public School Data</h2>
            <!-- <img class="green-bar center" style="margin:0px; margin-left: auto; margin-right: auto; display: block;" src="{{URL::to('/')}}/img/green-bar-2.png" alt=""/> -->
            <img class="green-bar" style="margin-left: 4px; margin-top: 7px; position: relative;"
                src="{{URL::to('/')}}/img/green-bar-2.png" alt="" />
        </div>
        <div class="row frontPage-charts">
            <div id="stp" style="display:block" class="col-md-8 restrain">
                <iframe scrolling="no" height="535px" id="homeFrameId-6" class="tableau-embed"
                    src='//public.tableau.com/views/ESDR_PROVINCE/12_STP_P?:showVizHome=no&amp;:display_share=no&amp;:embed=true&amp;:toolbar=no&amp;:device=desktop&amp;'
                     style='border: none'></iframe>
                <div style="background:white;margin-top: -49px;position:absolute;height: 27px;width: 100%;"></div>
            </div>
            <div id="enrollment-info" style="display: none" class="col-md-8 restrain">
                <iframe scrolling="no" height="535px" id="homeFrameId-1" class="tableau-embed"
                    src="//public.tableau.com/views/ESDR_PROVINCE/2_Enrolment_P?:showVizHome=no&amp;:display_share=no&amp;:embed=true&amp;:toolbar=no&amp;:device=desktop&amp;"></iframe>
                <div style="background:white;margin-top: -49px;position:absolute;height: 27px;width: 100%;"></div>
            </div>
            <div id="completion-rate" style="display:none" class="col-md-8 restrain">
                <iframe scrolling="no" height="535px" id="homeFrameId-2" class="tableau-embed"
                    src="//public.tableau.com/views/ESDR_PROVINCE/5_CompRate_P?:showVizHome=no&amp;:display_share=no&amp;:embed=true&amp;:toolbar=no&amp;:device=desktop&amp;"></iframe>
                <div style="background:white;margin-top: -49px;position:absolute;height: 27px;width: 100%;"></div>
            </div>
            <div id="grade-4-7-fsa" style="display:none" class="col-md-8 restrain">
                <iframe scrolling="no" height="535px" id="homeFrameId-3" class="tableau-embed"
                    src="//public.tableau.com/views/ESDR_PROVINCE/P_7_FSA_P?:showVizHome=no&amp;:display_share=no&amp;:embed=true&amp;:toolbar=no&amp;:device=desktop&amp;"></iframe>
                <div style="background:white;margin-top: -49px;position:absolute;height: 27px;width: 100%;"></div>
            </div>
            <div id="provincial-assessments" style="display:none" class="col-md-8 restrain">
                <iframe scrolling="no" height="535px" id="homeFrameId-4" class="tableau-embed"
                    src="//public.tableau.com/views/ESDR_PROVINCE/13_Assessments_P?:showVizHome=no&amp;:display_share=no&amp;:embed=true&amp;:toolbar=no&amp;:device=desktop&amp;"></iframe>
                <div style="background:white;margin-top: -49px;position:absolute;height: 27px;width: 100%;"></div>
            </div>
            <div id="students-satisfaction-survey" style="display:none" class="col-md-8 restrain">
                <iframe scrolling="no" height="535px" id="homeFrameId-5" class="tableau-embed"
                    src="//public.tableau.com/views/ESDR_PROVINCE/11_SatSurv_P?:showVizHome=no&amp;:display_share=no&amp;:embed=true&amp;:toolbar=no&amp;:device=desktop&amp;"></iframe>
                <div style="background:white;margin-top: -49px;position:absolute;height: 27px;width: 100%;"></div>
            </div>

            <!-- <div id="g2g" style="display:none" class="col-md-8 restrain">
				<iframe scrolling="no" height="500px" id="homeFrameId-7" class="tableau-embed" src="//public.tableau.com/views/ESDR_PROVINCE/9_G2G_P?:showVizHome=no&amp;:display_share=no&amp;:embed=true&amp;:toolbar=no&amp;:device=desktop&amp;"></iframe>
			</div> -->
            <div class="col-md-2 frontPage-radio" style="margin-top:67px;">
                <ul style="display: inline-block;">
                    <li style="list-style: none;"><input type="radio" onclick="javascript:yesnoCheck();" name="yesno"
                            id="stp-check" checked="checked"> Post-Secondary <br><span
                            style="margin-left: 16px;">Transitions</span></li>
                    <li style="list-style: none;"><input type="radio" onclick="javascript:yesnoCheck();" name="yesno"
                            id="enrollment-info-check"> Enrolment</li>
                    <li style="list-style: none;"><input type="radio" onclick="javascript:yesnoCheck();" name="yesno"
                            id="completion-rate-check"> Completion Rate</li>
                    <li style="list-style: none;"><input type="radio" onclick="javascript:yesnoCheck();" name="yesno"
                            id="grade-4-7-fsa-check"> Foundation Skills <br><span
                            style="margin-left: 16px;">Assessment</span></li>
                    <li style="list-style: none;"><input type="radio" onclick="javascript:yesnoCheck();" name="yesno"
                            id="provincial-assessments-check"> Graduation Assessment</li>
                    <li style="list-style: none;"><input type="radio" onclick="javascript:yesnoCheck();" name="yesno"
                            id="students-satisfaction-survey-check"> Students Learning Survey</li>

                    <!-- <li style="list-style: none;"><input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="g2g-check"> Post-Secondary Transitions</li> -->
                </ul>
            </div>
        </div>
        <!-- </div> -->
    </div>

    <div class="restrain" style="position: relative;"><a class="btn btn-primary btn-lg" href="/reporting">LEARN MORE
            +</a></div>
    <!--		<img class="" src="{{URL::to('/')}}/img/bg-data-chart.jpg')" alt=""/>-->



    <div class="light-gray-bg" style="margin-bottom: -20px;">
        <div class="restrain" style="padding-bottom: 50px;">
            <ul class="light-blue thirds">
                <h3 class="dark-blue tp">Aboriginal <br>(HAWD) Report</h3>
                <img class="green-bar" style="margin:0px; float: left" src="{{URL::to('/')}}/img/green-bar-2.png"
                    alt="" />
                <a href="/ahawd"><img class="" style="padding-top: 20px" src="{{URL::to('/')}}/img/rna-image.png"
                        alt="" /></a>
                <p class="tp body-color">The annual How Are We Doing? report published by the Ministry of Education and
                    Child Care providing data about the public school system's performance in serving students of
                    Aboriginal ancestry.</p>
                <p style="padding-top:10px"><a class="btn btn-primary btn-lg" href="/ahawd">LEARN MORE +</a></p>
            </ul>
            <ul class="light-blue thirds" style="padding-left: 14px;">
                <h3 class="dark-blue tp">Child Care <br>Program Data</h3>
                <img class="green-bar" style="margin:0px; float: left" src="{{URL::to('/')}}/img/green-bar-2.png"
                    alt="" />
                <a href="{{URL::to('/')}}/childcare"><img class="" style="padding-top: 20px"
                        src="{{URL::to('/')}}/img/childcare-image.png" alt="" /></a>
                <p class="tp body-color">Program and services data to support parents and caregivers with a variety of
                    quality options and costs associated with child care.</p>
                <p style="padding-top:8px"><a class="btn btn-primary btn-lg get-in-touch"
                        href="{{URL::to('/')}}/childcare">LEARN MORE +</a></p>
            </ul>
            <ul class="light-blue thirds" style="padding-left: 30px;">
                <h3 class="dark-blue tp">Continue the Conversation</h3>
                <img class="green-bar" style="margin:0px; float: left" src="{{URL::to('/')}}/img/green-bar-2.png"
                    alt="" />
                <a href="mailto:educ.systemperformance@gov.bc.ca"><img class="" style="padding-top: 20px"
                        src="{{URL::to('/')}}/img/get-in-touch-image.png" alt="" /></a>
                <p class="tp body-color">Help us make improvements. We'd like to know your thoughts on this site or how
                    the data is presented.</p>
                <p style="padding-top: 4px"><a class="btn btn-primary btn-lg get-in-touch"
                        href="mailto:educ.systemperformance@gov.bc.ca" style="margin-top:35px">GET IN TOUCH +</a></p>
            </ul>
        </div>
    </div>

    <!--
    <h2 style="" class="slide-title light-blue center">{{ trans('esdr2.feedback_heading') }}</h2>
    <img class="green-bar" src="{{URL::to('/')}}/img/green-bar.png" alt=""/>
    <p class="center">{{ trans('esdr2.feedback_copy1') }}</p>


      <p class="light-blue center">{{ trans('esdr2.feedback_question1') }} {{ trans('esdr2.feedback_question2') }} {{ trans('esdr2.feedback_question3') }}</p>
      <p class="light-blue center">{{ trans('esdr2.feedback_question4') }}</p>

    <div class="center button-contact"><br><a href="mailto:educ.systemperformance@gov.bc.ca">{{ trans('esdr2.contact_copy') }}</a></div>
-->
    <script type="text/javascript">
    window.onload = function() {

        let myiFrame = document.getElementById("homeFrameId-6");
        console.log(myiFrame)
        let doc = myiFrame.contentDocument;
        //console.log(doc)
        doc.body.innerHTML = doc.body.innerHTML +
            '<style>.tab-toolbar.public.tab-fill.tab-widget {background: blue;}</style>';
    }
    </script>
</section>