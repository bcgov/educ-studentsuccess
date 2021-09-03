@extends('layout')

@section('content')

<div class="light-gray-bg">
	<section style="padding-top: 3rem;" class="slide fill-viewport">
		<div class="slide-content restrain">
<!--			<iframe scrolling="no" id="frameId-95" class="tableau-embed" style="min-height: 430px" src="//public.tableau.com/views/ESDR1/14_Governance?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{$district}}"></iframe>-->
			<iframe width="1140" height="541.25" src="https://app.powerbi.com/reportEmbed?reportId=c1ac82c0-be1e-40c8-a3b2-69a2bf9a1c78&autoAuth=true&ctid=b9fec68c-c92d-461e-9a97-3d03a0f18b82&config=eyJjbHVzdGVyVXJsIjoiaHR0cHM6Ly93YWJpLXVzLW5vcnRoLWNlbnRyYWwtZi1wcmltYXJ5LXJlZGlyZWN0LmFuYWx5c2lzLndpbmRvd3MubmV0LyJ9" frameborder="0" allowFullScreen="true"></iframe>
			<iframe scrolling="no" id="frameId-96" class="tableau-embed" style="min-height: 430px" src="//public.tableau.com/views/ESDR1/15_Capacity_Utilization?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{$district}}"></iframe> 
			<iframe scrolling="no" id="frameId-97" class="tableau-embed" style="min-height: 430px" src="//public.tableau.com/views/ESDR1/16_Enrolment_and_Funding?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{$district}}"></iframe> 
			<iframe scrolling="no" id="frameId-98" class="tableau-embed" style="min-height: 430px" src="//public.tableau.com/views/ESDR1/17_Capital_Projects_In_Progress?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{$district}}"></iframe> 
			<iframe scrolling="no" id="frameId-99" class="tableau-embed" style="min-height: 430px" src="//public.tableau.com/views/ESDR1/18_Capital_Projects_Completed?:showVizHome=no&:display_share=no&:embed=true&:toolbar=no&:device=desktop&SD={{$district}}"></iframe> 	
		</div>
	</section>
</div>
@endsection