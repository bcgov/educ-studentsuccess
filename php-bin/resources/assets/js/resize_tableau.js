var t_device = 'desktop',
  t_tabletWidth = 605,
  t_desktopWidth = 1005;

function resizeTableau() {

  var new_t_device = 'phone';

  if ($(window).width() >= t_tabletWidth) {
    new_t_device = 'tablet';
  }

  if ($(window).width() >= t_desktopWidth) {
    new_t_device = 'desktop';
  }

  if (new_t_device != t_device) {

    t_device = new_t_device;

    $('.tableau-embed').each(function() {
      var current_url = $(this).attr('src');
      $(this).attr('src', updateURLParameter(current_url, ':device', t_device));
      console.info('Tableau iframe(s) resized. New Tableau iframe size is:', t_device);
    });

  }

}

$(document).ready(function() {

  // Check if we need to update on document load.
  if ($(window).width() < 1005) {
    resizeTableau();
  }

  // Listen for window resize and fire resizeTableau() after resize.
  var resizeTableau_debounced = debounce(function() {
    resizeTableau();
  }, 333);
  window.addEventListener('resize', resizeTableau_debounced);

});
