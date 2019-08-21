<section class="slide blue-bg" style="padding-top: 3rem;@if(isset($report_slug)) min-height: 27rem;@endif">
  <div class="slide-content restrain">

    <img src="/img/maps/map_sd_{{ $school_district->sd }}.png" alt="{{ trans('esdr2.map_desc1') }} {{ $school_district->sd }} {{ trans('esdr2.map_desc2') }}." class="key-image thirds">

    @if ($school_district->sd != '099')
      <p class="white school-meta">{{ trans('esdr2.sd_heading') }}</p>
    @endif
    
    <h2 class="ministry-blue slide-title">
      {{ $school_district->district_name }} 
      @if ($school_district->sd != '099')
        ({{ Helper::removeLeadingZeros($school_district->sd) }})
      @endif
    </h2>

    @if(isset($report_slug))
  
      @include('components.report-meta-descriptions')

    @else

      <p class="school-meta white">

        {{-- Presenter. See: `php-bin/app/Presenters/SchoolDistrictPresenter.php --}}
        @if ($school_district->phy_address_line_1)
          {{ trans('esdr2.district_office_label') }}: <a target="_blank" href="https://www.google.ca/maps/place/{{ str_replace(' ', '+', $school_district->present()->formatSchoolDistrictAddress) }}">{{ $school_district->present()->formatSchoolDistrictAddress }}</a>
        @endif

        @if ($school_district->contact_phone) 
          {{-- https://css-tricks.com/the-current-state-of-telephone-links/ --}}
          <br>{{ trans('esdr2.phone_contact_label') }}: <a title="{{ trans('esdr2.telephone_school') }} {{ $school_district->district_name }} {{ trans('esdr2.sd_heading') }}" href="tel:{{ $school_district->present()->concatPhoneNumber }}">{{ $school_district->contact_phone }}</a>
        @endif

        @if ($school_district->contact_phone_extension) 
          ext. {{ $school_district->contact_phone_extension }}
        @endif

        @if ($school_district->website) 
          <br>{{ trans('esdr2.website_contact_label') }}: <a href="{{ $school_district->website }}" target="_blank">{{ $school_district->present()->humanReadableWebsite }}</a>
        @endif

        {{-- @if ($school_district->contact_email)
          <br>{{ trans('esdr2.email_contact_label') }}: <a title="{{ trans('esdr2.email_contact_label') }} {{ $school_district->district_name }} {{ trans('esdr2.sd_heading') }}" href="mailto:{{ $school_district->contact_email }}?subject={{ trans('esdr2.email_subject') }}@if($school_district->contact_first_name && $school_district->contact_last_name)&body=Dear {{ $school_district->contact_first_name }} {{ $school_district->contact_last_name }},@endif">{{ $school_district->contact_email }}</a>
        @endif --}}

        @if ($school_district->contact_first_name && $school_district->position && $school_district->contact_last_name)
          <br>{{ $school_district->position }}: {{ $school_district->contact_first_name }} {{ $school_district->contact_last_name }}
        @endif

      </p>

    @endif

  </div>
</section>
