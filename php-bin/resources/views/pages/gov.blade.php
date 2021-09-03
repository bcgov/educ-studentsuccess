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
                <option value="/school-district/{{ $school_district->sd }}/report/student-satisfaction">School Satisfaction</option>
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
<section style="padding-top: 3rem;" class="slide fill-viewport">
    <div class="slide-content restrain">
    <h3 class="slide-title light-blue">Key contacts</h3>
        <table class="governance-results-table table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th class="gov-head governance-position col-xs-1">Position</th>
                    <th class="gov-head governance-name col-xs-5">Name</th> 
                    <th class="gov-head governance-phone col-xs-2">Phone</th>
                    <th class="gov-head governance-mobile col-xs-2">Mobile</th>
                    <th class="gov-head governance-email col-xs-2">Email</th>
                    <!-- <th class="governance-extra1">Extra</th>
                    <th class="governance-extra2">Extra</th> -->
                </tr>
            </thead>  
            <tbody>  
            @foreach ($govInfos as $govInfo) 
                <tr>
                    <td class="governance-position">{{ $govInfo->position }}</td>
                    <td class="governance-name">{{ $govInfo->name }}</td>
                    <td class="governance-phone">{{ $govInfo->phone }}</td>
                    <td class="governance-mobile">{{ $govInfo->mobile }}</td>
                    <td class="governance-email">{{ $govInfo->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
