$(document).ready(function() {

$('.icon').on('click', function() {
  $(this).toggleClass('open');
});

$('#enrolment_subnav .nav-link').on('click', function() {
  $('#enrolment_subnav .nav-link').attr('class','nav-link');
  this.classList.add('active');
})

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

//for IE, IE 11, edge
if (navigator.userAgent.indexOf('MSIE ')>0 || navigator.userAgent.match(/Trident.*rv\:11\./) || navigator.userAgent.indexOf('Edge')>0) {
  alert("Please use Chrome or Firefox for best experience.");
  $("a").on('click', function(event) {
    if (this.hash !== "") {
      
      event.preventDefault();

      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){

        window.location.hash = hash;
      });
    } 
  });
 }

});
