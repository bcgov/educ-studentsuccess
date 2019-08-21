<section class="slide">
  <div class="slide-content restrain" style="min-height: 33rem;">

    <h3 style="margin-bottom: 0;" class="ministry-blue slide-title directory-table-heading">{{ trans('esdr2.sd_heading') }}</h3>

    @if ($sdID)
      <table class="directory-results-table">
        <tr>
          <td>{{ $district_name }} ({{ Helper::removeLeadingZeros($sdID) }})</td>
          <td class="view_report_lable"><a title="{{ trans('esdr2.view_sd_label') }} {{ Helper::removeLeadingZeros($sdID) }}" href="/school-district/{{ $sdID }}">{{ trans('esdr2.view_report_lable') }} {{ $district_name }}</a></td>
        </tr>
      </table>
    @endif

    @if ($w_public)
      <h3 id="public-schools" class="ministry-blue slide-title directory-table-heading">{{ trans('esdr2.public_school_lable_plural') }}</h3>
      <table class="directory-results-table">
        <tr>
          <th class="school-name">{{ trans('esdr2.name_lable') }}</th>
          <th class="school-grade-range">{{ trans('esdr2.grade_level_label') }}</th> 
          <th class="school-address">{{ trans('esdr2.address_label') }}</th>
        </tr>
        @foreach ($schools as $school) 
          @if (!$school->independent)
            <tr>
              <td class="school-name"><a href="/school/{{ $school->mincode }}">{{ Helper::fixEcole($school->school_name) }}</a></td>
              <td class="school-grade-range">{{ Helper::formatSchoolGradeRangeStr($school->mincode) }}</td>
              <td class="school-address"><a target="_blank" href="https://www.google.ca/maps/place/{{ str_replace(' ', '+', $school->present()->formatSchoolAddress) }}">{{ $school->present()->formatSchoolAddress }}</a></td>
            </tr>
          @endif
        @endforeach
      </table>
    @endif
    
    @if ($w_indi) 
      <h3 id="indi-schools" class="ministry-blue slide-title directory-table-heading">{{ trans('esdr2.inidi_school_lable_plural') }}</h3>
      <table class="directory-results-table">
        <tr>
          <th class="school-name">{{ trans('esdr2.name_lable') }}</th>
          <th class="school-grade-range">{{ trans('esdr2.grade_level_label') }}</th> 
          <th class="school-address">{{ trans('esdr2.address_label') }}</th>
        </tr>
        @foreach ($schools as $school) 
          @if ($school->independent)
            <tr>
              <td class="school-name"><a href="/school/{{ $school->mincode }}">{{ Helper::fixEcole($school->school_name) }}</a></td>
              <td class="school-grade-range">{{ Helper::formatSchoolGradeRangeStr($school->mincode) }}</td>
              {{-- <td class="school-address">{{ Helper::formatStreetAddressForHuman($school->phy_address_line_1) }}, {{ $school->present()->formatCityForHuman }} BC</td> --}}
              <td class="school-address"><a target="_blank" href="https://www.google.ca/maps/place/{{ str_replace(' ', '+', $school->present()->formatSchoolAddress) }}">{{ $school->present()->formatSchoolAddress }}</a></td>
            </tr>
          @endif
        @endforeach
      </table>
    @endif

  </div>
</section>
