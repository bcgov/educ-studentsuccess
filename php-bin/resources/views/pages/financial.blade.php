@extends('layout')

@section('content')
@include('components.sd-meta')
<section class="slide aqua-bg options-row">
	<div class="slide-content restrain">      
	  <div class="sd-sub-nav">
		<div class="col-sm-12 col-md-8 more-reports">
			<select id="dynamic_select" class="form-control report-select">
				<option value="" selected>Select another report</option>
				<option value="/school-district/{{ $school_district->sd }}/report/contextual-information">Demographic Information</option>
				<option value="/governance/{{ $school_district->sd }}">Key contacts</option>
				<option value="/finance/{{ $school_district->sd }}">Financial Information</option>
				<option value="/school-district/{{ $school_district->sd }}/report/completion-rates">Completion Rate</option>
				<option value="/school-district/{{ $school_district->sd }}/report/fsa">Foundation Skills Assessment</option>
				<option value="/school-district/{{ $school_district->sd }}/report/grade-to-grade-transitions">Grade-to-Grade Transitions</option>
				<option value="/school-district/{{ $school_district->sd }}/report/grad-assess">Graduation Assessments</option>
				<option value="/school-district/{{ $school_district->sd }}/report/students-entering-school">Characteristics of Students Entering School</option>
				<option value="/school-district/{{ $school_district->sd }}/report/student-satisfaction">Student Satisfaction and Wellness</option>
				<option value="/school-district/{{ $school_district->sd }}/report/post-secondary-career-prep">Post-Secondary and Career Preparation</option>
				<option value="/school-district/{{ $school_district->sd }}/report/transition-to-post-secondary">Transition to B.C. Post-Secondary</option>
			</select> 
			
		</div>
		<div class="col-sm-12 col-md-4 more-reports">
			<a class="view-all" href="/school-district/{{ $school_district->sd }}">View All Reports</a>
		</div>
	  </div>
	</div>
</section>

<div class="">
	<section style="padding-top: 3rem;" class="slide fill-viewport">
		<div class="slide-content restrain">
		<!-- <iframe width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=c1ac82c0-be1e-40c8-a3b2-69a2bf9a1c78&autoAuth=true&ctid=b9fec68c-c92d-461e-9a97-3d03a0f18b82&config=eyJjbHVzdGVyVXJsIjoiaHR0cHM6Ly93YWJpLXVzLW5vcnRoLWNlbnRyYWwtZi1wcmltYXJ5LXJlZGlyZWN0LmFuYWx5c2lzLndpbmRvd3MubmV0LyJ9" frameborder="0" allowFullScreen="true"></iframe> -->
			<h3 class="slide-title light-blue">Capacity Utilization</h3>
			<iframe scrolling="no" id="frameId-96" class="tableau-embed" style="min-height: 430px" src="//public.tableau.com/views/ESDR1/15_Capacity_Utilization?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{$school_district->sd}}"></iframe> 

			<h3 class="slide-title light-blue">Enrolment and Funding</h3>
			<iframe scrolling="no" id="frameId-97" class="tableau-embed" style="min-height: 430px" src="//public.tableau.com/views/ESDR1/16_Enrolment_and_Funding?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{$school_district->sd}}"></iframe>

			<h3 class="slide-title light-blue">Indigenous Education Finances</h3>
			<table class="finance-results-table table table-striped table-hover">
				<tbody>  
				@foreach ($indiEducFinance as $indiEdFin) 
					<tr>
						<th class="gov-head finance-program" style="text-align: left;">Local Enhancement Agreements Signed (expressd as a fraction over total first nations in a school district)</th>
						<td class="finance-status">{{ $indiEdFin->local_enhancement_agreements_signed }}</td>						
					</tr> 				
					<tr>
						<th class="gov-head finance-funding" style="text-align: left;">Indigenous Education Council (IEC)</th> 
						<td class="finance-completion-year">{{ $indiEdFin->indigenous_education_council }}</td>
					</tr>
				@endforeach
				</tbody>
        	</table>
			<h3 class="slide-title light-blue">Financial Indicators</h3>
			<iframe scrolling="no" id="frameId-98" class="tableau-embed" style="min-height: 617px" src="//public.tableau.com/views/ESDR1/17_Capital_Projects_In_Progress?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{$school_district->sd}}"></iframe> 

			<h3 class="slide-title light-blue">Minor Capital Program Funding (Since 2016/17)</h3>
			<table class="finance-results-table table table-striped table-hover">
				<thead class="thead-dark">
					<tr>
						<th class="gov-head finance-program" style="text-align: left;">Program</th>
						<th class="gov-head finance-funding" style="text-align: left;">Funding</th> 
					</tr>
				</thead>  
				<tbody>  
					@foreach ($minor_capital as $mcap) 
						<tr>
							<td class="finance-status">{{ $mcap->program }}</td>
							<td class="finance-completion-year">{{ $mcap->funding }}</td>
						</tr>
					@endforeach
				</tbody>
        	</table>
			
			<h3 class="slide-title light-blue">Capital Projects</h3>
			<!-- <iframe scrolling="no" id="frameId-99" width='100%' height='100%' src="//public.tableau.com/views/ESDR1/18_Capital_Projects_Completed?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{$school_district->sd}}"></iframe>  -->
			<table class="finance-results-table table table-striped table-hover">
				<thead class="thead-dark">
					<tr>
						<th class="gov-head finance-status" style="text-align: left;">Status</th>
						<th class="gov-head finance-completion-year" style="text-align: left;">Completion Year</th> 
						<th class="gov-head finance-facility-name" style="text-align: left;">School Name</th>
						<th class="gov-head finance-project-details" style="text-align: left;">Project Details</th>
						<th class="gov-head finance-project-estimated-cost" style="text-align: left;">Budget</th>
					</tr>
				</thead>  
				<tbody>  
					@foreach ($capital as $cap) 
						<tr>
							<td class="finance-status">{{ $cap->status }}</td>
							<td class="finance-completion-year">{{ $cap->completion_year }}</td>
							<td class="finance-facility-name">{{ $cap->facility_name }}</td>
							<td class="finance-project-details">{{ $cap->project_details }}</td>
							<td class="finance-project-estimated-cost">{{ $cap->budget }}</td>
						</tr>
					@endforeach
				</tbody>
        	</table>
		</div>
	</section>
</div>
@endsection