//transforming menu
$('.icon').on('click', function() {
  console.log('menu');
  $(this).toggleClass('close');
});

$('#yearDropdown').on('click', function(et) {
  console.log('dropdown')
  $(this).toggleClass('active');
})
