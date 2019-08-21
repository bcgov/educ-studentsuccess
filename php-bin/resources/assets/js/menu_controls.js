$(document).ready(function() {

  // Secondary nav on small screens
  $('.sub-menu-trigger').click(function(){
    if ($('#secondary-nav').hasClass('contracted')) {
      $('#secondary-nav').removeClass('contracted').addClass('expanded');
      $(this).html(jsTranslations.close_trigger + ' <i class="fa fa-caret-up" aria-hidden="true"></i>');
    } else if ($('#secondary-nav').hasClass('expanded')) {
      $('#secondary-nav').removeClass('expanded').addClass('contracted');
      $(this).html(jsTranslations.open_trigger + ' <i class="fa fa-caret-down" aria-hidden="true"></i>');
    }
  });

});
