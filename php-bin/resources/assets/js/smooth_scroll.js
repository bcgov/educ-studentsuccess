// Initialize magicOffset with our best guess of the heights of the headers.
var magicOffset = 105; // We will update this in a matter of miliseconds. 

$(document).ready(function() {

  // Hides the "Back to Top" button if doc height is short.
  if ($(document).height() > 1005) {
    $('#back-to-top').css('opacity', '1').css('cursor', 'pointer'); 

    // Simple "back-to-top" click listener 
    $('#back-to-top').click(function() {
      $('html, body').stop().animate({
          scrollTop: 0
        }, 900, 'swing');
    });
  }

}); // document ready()

$(window).bind('load', function() {

  magicOffset = $('#header').height() + $('#secondary-nav').height();

  // "smooth scrolls" the page to the anchor. 
  // Listens on links like `href=/#hash` and `href=#hash`
  $('a[href^="#"]').on('click', function (e) {
    e.preventDefault();

    var target = this.hash,
      $target = $(target);

    $('html, body').stop().animate({
      scrollTop: $target.offset().top - magicOffset 
    }, 900, 'swing', function () {
      if(history.pushState) {
        history.pushState(null, null, target);
      }
      else {
        window.location.hash = target;
      }
    });
  });

  // Scrolls the page to the correct position allowing for the visual offset of the header(s).
  // Even though we are inside window.load, we need to wait an additional 400 miliseconds
  // because otherwise, $(window).scrollTop() will result in zero.
  setTimeout(function() { 
    // If we have loaded the page with a "hash" (pound) sign in the URL:
    if(window.location.hash) {
      window.scrollTo(0, parseInt($(window).scrollTop(), 10) - magicOffset);
    }
  }, 400);

}); // window has loaded.
