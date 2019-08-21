@extends('layout')
@section('subtitle'){{ trans('esdr2.glossary_heading') }}@endsection

@section('content')

  <div class="aqua-bg directory-masthead">
    <div class="restrain">
    
      <h2 id="directory-main-heading" class="ministry-blue slide-title">{{ trans('esdr2.glossary_heading_long') }}</h2>

    </div>
  </div>

  <section class="slide">
    <div class="slide-content restrain" id="glossary">

      <ul class="directory_alpha_menu">

        @foreach ($glossary_entries as $glossary_letter => $glossary_item)
          @if ($glossary_letter == '#')
            <li class="letter-selection center"><a href="#1">{{ $glossary_letter }}</a></li>
          @else
            <li class="letter-selection center"><a href="#{{ $glossary_letter }}">{{ $glossary_letter }}</a></li>
          @endif
        @endforeach
 
      </ul>

      <input type="text" class="search" placeholder="{{ trans('esdr2.search_glossary_lable') }}" id="glossarySearch">
      <span aria-hidden="true" id="clear-search" title="{{ trans('esdr2.clear_search_label') }}">&times;</span>

      {{-- This is a *BIG* CSS styling hack. The first glossary-permalink will not position itself correctly and I am going crazy. --}}
      @php
        $myHackCounterThing = 0;
      @endphp

      <ul class="glossary directory-wrapper">

        @foreach ($glossary_entries as $glossary_letter => $glossary_item)
          @if ($glossary_letter == '#')
            <li id="1" class="directory-letter-section">
          @else
            <li id="{{ $glossary_letter }}" class="directory-letter-section">
          @endif
            <span class="directory letter">{{ $glossary_letter }}</span>

            <ul>
              @foreach ($glossary_item as $glossary_entry)
                <li id="{{ $glossary_entry['gid'] }}">

                  <h3 class="glossary-title">{{ $glossary_entry['title'] }}</h3>

                  @php
                    $myHackCounterThing++;
                  @endphp
                  
                  @if ($myHackCounterThing !== 1)
                    <a title="{{ trans('esdr2.permalink_for') }} {{ $glossary_entry['title'] }}" href="#{{ $glossary_entry['gid'] }}" class="fa fa-link glossary-permalink"></a>
                  @else 
                    <a style="position: relative; right: -18px;" title="{{ trans('esdr2.permalink_for') }} {{ $glossary_entry['title'] }}" href="#{{ $glossary_entry['gid'] }}" class="fa fa-link glossary-permalink"></a>
                  @endif

                  {{-- 
                    Using `!!` ensures that Laravel doesn't sanitize HTML. Markup is passed directly to template. 
                    This is kind of a security concern. We trust that folks updating the data/markup in the database will 
                    not put anything malicous in there..
                  --}}
                  <div class="glossary-definition">{!! $glossary_entry['definition'] !!}</div>

                </li>
              @endforeach
            </ul>

          </li>
        @endforeach

      </ul>

    </div>
  </section>

@endsection

@push('scripts')

  <script>

    $(document).ready(function() {

      function resetGlossary() {
        $('.directory-letter-section, .directory-letter-section ul li').show();
      }

      // Click handler for the "clear" button.
      $('#clear-search').click(function() {
        $('#glossarySearch').val('');
        resetGlossary();
      });

      var searchForGlossaryTerms = debounce(function() {

        if ($('#glossarySearch').val() != '') {

          // Check if all the items are already hidden
          var allHidden = true;
          $('ul.glossary.directory-wrapper li.directory-letter-section').each(function() {

            if($(this).is(':visible')) {
              allHidden = false;
              return false;
            }

          });

          // If all items are hidden, reset the glossary and search again on the next keystroke
          if (allHidden) {
            resetGlossary();
          }
        
          var thisVal = $(this).val().toLowerCase();

          $('.glossary-title').each(function() {

            var searchTerm = $(this).text().toLowerCase();

            if (searchTerm.indexOf(thisVal) !== -1) {
              $(this).parent('li').show();
            } else {
              $(this).parent('li').hide();
            }

          });

          $('.directory-letter-section ul').each(function() {

            var hasSomethingToSay = false;
            
            $(this).children('li').each(function() {
              if($(this).is(':visible')) {
                hasSomethingToSay = true;
                // https://forum.jquery.com/topic/breaking-the-each-loop
                return false;
              }
            });

            if (hasSomethingToSay) {
              $(this).parent().show();
            } else {
              $(this).parent().hide();
            }

          });

        } else { 

          // Glossary search value is empty.
          resetGlossary();

        }
        
      }, 250); // END debounce() definition

      // Call debounce'd function on keyup
      $('#glossarySearch').on('keyup', searchForGlossaryTerms); // input change 

    }); // doc ready

  </script>

@endpush
