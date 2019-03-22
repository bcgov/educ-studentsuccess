//transforming menu
$('.icon').on('click', function() {
  $(this).toggleClass('open');
});

// //dropdown selection
// $('#yearDropdown').on('click', function(et) {
//   $(this).toggleClass('active');
//   $('#distDropdown').removeClass('active');
// });

// $('#distDropdown').on('click', function(et) {
//   $(this).toggleClass('active');
//   $('#yearDropdown').removeClass('active');
// });

$(document).on('click', function(et) {
  //if you click on anything except the dropdown itself, close the dropdown
  if (!$(et.target).closest('.dropDown').length) {
    $('body').find('.dropDown').removeClass('active');
  }
});



$(document).on('click', function(et) {
  if (!$(et.target).closest('.icon').length) {
    $('body').find('.icon').removeClass('open');
    $('body').find('.navbar-collapse').removeClass('show');
  }
});


