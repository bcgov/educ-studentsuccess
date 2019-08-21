// Autocomplete options.
// http://easyautocomplete.com/guide#sec-trigger-event
var autocompleteOptions = {
  url: '/api/v1/allSchoolsWithSchoolDistricts.json',
  getValue: 's',
  requestDelay: 250,
  list: {
    maxNumberOfElements: 5,
    match: {
      enabled: true
    },
    onChooseEvent: function() {

      // Probably a valid school.
      if ($('#main-search').getSelectedItemData().mincode != undefined) {

        var mincode = $('#main-search').getSelectedItemData().mincode;
        setTimeout(function() { 
          window.location.href = '/school/' + mincode; 
        }, 250, mincode);

      // Probably a school district.
      } else if($('#main-search').getSelectedItemData().sd != undefined) {

        var sd = $('#main-search').getSelectedItemData().sd;
        setTimeout(function() { 
          window.location.href = '/school-district/' + sd; 
        }, 250, sd);

      } else {

        alert('Error: This search input is not functioning properly. Please contact us using the \"Contact Us\" link at the bottom of this page to let us know about the problem.');

      }
      
    }, 
   /* onShowListEvent: function() {
      $('.easy-autocomplete.eac-bootstrap input').css('border-radius', '1rem 1rem 0 0');
    },
    onHideListEvent: function() {
      $('.easy-autocomplete.eac-bootstrap input').css('border-radius', '1rem');
    },*/
    //MT Takes out styling on the search box
    onShowListEvent: function() {
      $('.easy-autocomplete.eac-bootstrap input');
    },
    onHideListEvent: function() {
      $('.easy-autocomplete.eac-bootstrap input');
    },
    showAnimation: {
      type: 'normal', // normal|slide|fade
      time: 200,
      callback: function() {}
    }
  },
  theme: 'bootstrap'
};

// Initialize autocomplete.
$(document).ready(function() {

  $('#main-search').easyAutocomplete(autocompleteOptions);
  // Click handler for the "clear" button.
  $('#clear-search').click(function() {
    $('#main-search').val('');
  });

});
