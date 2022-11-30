@extends('layout')


@section('content')
<div class="reporting-page">
	<div style="position:relative;">
		
		<img src="/img/bg-images/r-a-top-banner.png" alt="image of hex boxes" style="position:absolute; z-index:-1; width:100%; max-height: 230px;min-height: 230px;">
		<div style="padding-top: 55px;">
			<h1 style="text-align:center"><strong>The goal is to ensure data is used</strong></h1>
			<h1 style="text-align:center"><strong>&nbsp;&nbsp;&nbsp;as an <em>effective tool</em> in helping</strong></h1>
			<h1 style="text-align:center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;all students succeed.</strong></h1>
		</div>
		
		<div style="padding-top:14rem; margin-bottom:5rem;" class="reports-heading">
				<img src="/img/arrorw-down.png" alt="downward arrow" style="position: absolute; top: 71%;left: 49%;line-height: 34px;">
		</div>
	</div>

	
	<div class="restrain">
	<h2 class="slide-title dark-blue" style="text-align:center;margin-bottom: 1rem;">Research and Analysis</h2>
	<img class="green-bar center" style="margin:0px; margin-left: auto; margin-right: auto; display: block;" src="{{URL::to('/')}}/img/green-bar-2.png" alt=""/>

	<div class="center" style="margin: 4rem 0rem;"><p>The following reports are available in PDF format and highlight the latest inquiries from the following categories. <strong><a  href="mailto:educ.systemperformance@gov.bc.ca">Contact us</a></strong> if you would<br>
	  &nbsp;&nbsp;&nbsp;like to request additional information, or if you are looking for previously annual reports published prior to 2020.</p>
	</div>
	<div class="row">
<!-- Ab How are we doing Card -->
		<div class="r-n-a-panel panel panel-default col-xs-12 col-sm-4 col-lg-4">
			<div class="panel-heading">
				<a id="ahawd-download-report-link" href="https://www2.gov.bc.ca/assets/download/9B4891712EFB4C118A5DB9694065A673" target="_blank">
					<img alt="" class="toc-chart-thumbnail" src="/img/charts/ab-how-are-we-doing-panel-img.png" />
				</a>	
			</div>
			<div class="panel-body">
				<p id="indigenous" class="panel-body-title dark-blue">Indigenous</p>
				<a id="ahawd-download-report-link" href="https://www2.gov.bc.ca/assets/download/9B4891712EFB4C118A5DB9694065A673" target="_blank">
					<p>{{ trans('esdr2.abo_how_are_we_doing_heading') }} (PDF)</p>
				</a>	
			</div>
		</div>
<!-- CYIC Card -->
		<div class="r-n-a-panel panel panel-default col-xs-12 col-sm-4 col-lg-4">
			<div class="panel-heading">
				<a id="cyic-report-link" href="https://www2.gov.bc.ca/assets/download/041C7A8EDD2A4CF880AAEAD05CC7A3E0" target="_blank">
					<img alt="" class="toc-chart-thumbnail" src="/img/charts/cyic-panel-img.png" />
				</a>	
			</div>
			<div class="panel-body">
				<p id="learner-centered" class="panel-body-title dark-blue">Learner Centered</p>
				<a id="cyic-report-link" href="https://www2.gov.bc.ca/assets/download/041C7A8EDD2A4CF880AAEAD05CC7A3E0" target="_blank">
					<p>Children and Youth in Care: How Are We Doing? (PDF)</p>
				</a>	
			</div>
		</div>
<!-- Surrey Class Size Card -->
		<div class="r-n-a-panel panel panel-default col-xs-12 col-sm-4 col-lg-4">
			<div class="panel-heading">
				<a id="surrey-class-size-download-report-link" href="/pdf/student-impacts-report-feb2021.pdf" target="_blank">
					<img alt="" class="toc-chart-thumbnail" src="/img/covid19-student-impacts.PNG" style="width:302px;height:221px;"/>
				</a>
			</div>
			<div class="panel-body">
				<p id="data-science"class="panel-body-title dark-blue">Data Science</p>
				<a id="surrey-class-size-download-report-link" href="/pdf/student-impacts-report-feb2021.pdf" target="_blank">
					<p>COVID-19 Student Impacts Report (PDF)</p>
				</a>	
			</div>
		</div>
	</div>

	<div class="row">
		<!-- FSA Card -->
		<div class="r-n-a-panel panel panel-default col-xs-12 col-sm-12 col-lg-4">
			<div class="panel-heading">
				<a id="fsa-report-link" href="/fsa/index.html" target="_blank">
					<img alt="" class="toc-chart-thumbnail" src="/img/charts/fsa-panel-img.png" style="height:221px"/>
				</a>
			</div>
			<div class="panel-body">
				<p id="learner-centered" class="panel-body-title dark-blue">Learner Centered</p>
				<a id="fsa-report-link" href="/fsa/index.html" target="_blank">
					<p>Foundation Skills Assessment Reports</p>
				</a>	
			</div>
		</div>		
		<div class="r-n-a-panel panel panel-default col-xs-12 col-sm-12 col-lg-4">
			<div class="panel-heading">
				<a id="enrollment-report-image" href="/enrolment-app" target="_blank">
					<img alt="enrollment model thumbnail" class="enrollment-model-thumbnail" src="/img/charts/enrolment-model-icon.png" />
				</a>
			</div>
			<div class="panel-body">
				<p id="learner-centered" class="panel-body-title dark-blue">Data Science</p>
				<a id="enrollment-report-link" href="/enrolment-app" target="_blank">
					<p>Enrolment Model Report</p>
				</a>	
			</div>
		</div>		
		<div class="r-n-a-panel panel panel-default col-xs-12 col-sm-12 col-lg-4">
			<div class="panel-heading">
				<a id="childcare-report-image" href="/childcare" target="_blank">
					<img alt="childcare thumbnail" class="enrollment-model-thumbnail" src="/img/charts/ChildCareimage.png" style="height:221px"/>
				</a>
			</div>
			<div class="panel-body">
				<p id="learner-centered" class="panel-body-title dark-blue">Child Care</p>
				<a id="childcare-report-link" href="/childcare" target="_blank">
					<p>Child Care Reports</p>
				</a>	
			</div>
		</div>		
	</div>	
	</div>
</div>
@endsection
