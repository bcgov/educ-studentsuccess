@php
  
  $report_slugs_with_legends = array(
    'completion-rates',
    'fsa',
    'student-satisfaction',
    'post-secondary-career-prep',
    'prov-exams',
    'grad-assess'
  );

  if (in_array($report_slug, $report_slugs_with_legends)) {

    $report_slug_mappings = array(
      'completion-rates' => 'district_completion_rate_yr',
      'fsa' => 'district_fsa_yr',
      'student-satisfaction' => 'district_sats_surv_yr',
      'post-secondary-career-prep' => 'district_psi_surv_yr',
      'prov-exams' => 'district_exams_yr',
      'grad-assess' => 'district_exams_yr'
    );
    try{
    	$metadata_location = $report_slug_mappings[$report_slug];
		$report_year_high_value = $metadata[$metadata_location];
    }catch(exception $e){
		$report_year_high_value = "N/A";
    }

    $report_years = explode('/', $report_year_high_value);

    $report_year_low_value = ($report_years[0] - 4);

    if (isset($report_years[1])) {
      
      $report_year_low_value .= '/'.($report_years[1] - 4);
      if($report_slug == "fsa"){
	  	$report_year_low_value = "2017/18";
 	  }
    }
    

  }
@endphp

<div class="chart-legend">
  <div class="typical-range">
    <div class="typical-range-graphic"></div>
    <div class="legend-desc">
      @if (!isset($school))
        {{ trans('esdr2.typical_range_copy1') }}
      @else
        {{ trans('esdr2.typical_range_school_copy1') }}
      @endif
    </div>
  </div>
  <div class="selected-districts">
    <div class="selected-districts-graphic"></div>
    <div class="legend-desc">
      @if (!isset($school) && $report_slug != "grad-assess")
        {{ trans('esdr2.typical_range_copy2') }} ({{ $report_year_high_value }})
      @elseif (!isset($school) && $report_slug == "grad-assess")
        {{ trans('esdr2.typical_range_copy2') }}
      @else
        {{ trans('esdr2.typical_range_copy2') }} {{ $report_year_high_value }}
      @endif
    </div>
  </div>
  <div class="range-of-districts">
    <div class="range-of-districts-graphic"></div>
    <div class="legend-desc">
      @if (!isset($school) && $report_slug != "grad-assess")
        {{ trans('esdr2.typical_range_copy3') }} ({{ $report_year_low_value }} - {{ $report_year_high_value }})
      @elseif (!isset($school) && $report_slug == "grad-assess")  
        {{ trans('esdr2.typical_range_copy3') }}
      @else
        {{ trans('esdr2.typical_range_school_copy3') }} ({{ $report_year_low_value }} - {{ $report_year_high_value }})
      @endif
    </div>
  </div>
</div>