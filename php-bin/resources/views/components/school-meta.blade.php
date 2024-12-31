<section class="slide blue-bg" style="padding-top: 3rem;@if(isset($report_slug)) min-height: 27rem;@endif">
    <div class="slide-content restrain">

        @if (!$school->independent)
        <img src="/img/maps/map_sd_{{ $school->sd }}.png" alt="{{ trans('esdr2.map_graphic_alt') }} {{ $school->sd }}."
            class="key-image thirds">
        @endif

        <p class="white school-meta">
            @if ($school->independent)
            {{ trans('esdr2.inidi_school_lable') }}
            @else
            {{ trans('esdr2.public_school_lable') }}
            @endif
        </p>

        <h2 class="ministry-blue slide-title">{{ Helper::fixEcole($school->school_name) }}</h2>

        @if (isset($report_slug))

        @include('components.report-meta-descriptions')

        @else

        <p class="school-meta white">

            {{-- Presenter. See: `php-bin/app/Presenters/SchoolPresenter.php --}}
            @if ($school->phy_address_line_1)
            {{ trans('esdr2.school_address_lable') }}: <a target="_blank"
                href="https://www.google.ca/maps/place/{{ str_replace(' ', '+', $school->present()->formatSchoolAddress) }}">{{ $school->present()->formatSchoolAddress }}</a>
            @endif

            @if ($school->phone_number)
            {{-- https://css-tricks.com/the-current-state-of-telephone-links/ --}}
            <br>{{ trans('esdr2.phone_contact_label') }}: <a
                title="{{ trans('esdr2.telephone_school') }} {{ $school->school_name }} {{ trans('esdr2.sd_heading') }}"
                href="tel:{{ $school->present()->concatPhoneNumber }}">{{ substr_replace(substr_replace($school->phone_number, ' ', 3, 0), '-', -4, 0) }}</a>
            @endif

            @if ($school->phone_number_extension)
            ext. {{ $school->phone_number_extension }}
            @endif

            @if ($school->website)
            <br>{{ trans('esdr2.website_contact_label') }}: <a href="{{ $school->website }}"
                target="_blank">{{ $school->present()->humanReadableWebsite }}</a>
            @endif

            @if ($school->email_address)
            <br>{{ trans('esdr2.email_contact_label') }}: <a
                title="{{ trans('esdr2.email_contact_label') }} {{ $school->school_name }} {{ trans('esdr2.sd_heading') }}."
                href="mailto:{{ $school->email_address }}?subject={{ trans('esdr2.email_subject') }}@if($school->principal_title)&body=Dear {{ $school->principal_title }}. {{ $school->principal_name }},@endif">{{ $school->email_address }}</a>
            @endif

            @if ($school->principal_name && $school->principal_title)
            <br>{{ trans('esdr2.principal_lable') }}: {{ $school->principal_title }} {{ $school->principal_name }}
            @endif

            @if ($district_name && $school->sd)
            <br>{{ trans('esdr2.sd_heading') }}: {{ $district_name }} ({{ Helper::removeLeadingZeros($school->sd) }})
            @endif

            @if ($mincode && Helper::formatSchoolGradeRangeStr($mincode) != '')
            <br>{{ trans('esdr2.grade_level_label') }}: {{ Helper::formatSchoolGradeRangeStr($mincode) }}
            @endif

            <br>{{ trans('esdr2.mincode_label') }}: {{ $mincode }}

        </p>

        @endif

    </div>
</section>