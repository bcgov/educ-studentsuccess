@extends('layout')
@section('subtitle'){{ trans('esdr2.childcare_heading') }}@endsection

@section('content')

  <div class="blue-bg directory-masthead childcare" style="padding-top:0.7em; padding-bottom:0em">
    <div class="restrain">
    <img src="/img/ChildCare.png" alt="Small map graphic with School." class="key-image thirds">
      <h2 id="directory-main-heading" class="ministry-blue slide-title">B.C. Child Care Data and Reports</h2>
      <h4 style="color:white">The Ministry of Education and Child Care provides several programs and services to support parents with quality child care options and to assist parents with the costs associated with child care.</h4><br><br>
      <h4 style="color:white"><a href="https://www2.gov.bc.ca/gov/content?id=10DC4052D2D449BEA4FDC8D8463500D2">Learn more about child care in B.C.</a></h4>
      <br>
    </div>
  </div>

  <section class="container">
  <br><br>
  <!-- prd -->
  <iframe title="Child Care Student Success - Child Care Operating Funding" width="1500" height="650" src="https://app.powerbi.com/view?r=eyJrIjoiNjZlYjEyOTAtZDM0ZS00MzllLWE5NTItODQ2YTJjNmJjOWIxIiwidCI6IjZmZGI1MjAwLTNkMGQtNGE4YS1iMDM2LWQzNjg1ZTM1OWFkYyJ9" frameborder="0" allowFullScreen="true"></iframe>
    <div style="background:white;margin-top: -65px;position:absolute;height: 60px;width: 100%;"></div>
  </section>

@endsection
