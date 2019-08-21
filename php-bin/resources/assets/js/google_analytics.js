$(document).ready(function() {

  // Click handler for PDF downloads.
  $('#main-download-report-link, #ahawd-download-report-link').click(function() {
    var report_school_district = $(this).attr('data-sd');

    if (typeof ga !== 'undefined' && ga) {

      if ($(this).attr('id') == 'main-download-report-link') {
        ga('send', 'event', 'Downloads', 'pdf download', 'SD' + report_school_district);
        console.log('GA pdf download event sent.', report_school_district);
      } else if ($(this).attr('id') == 'ahawd-download-report-link') {
        ga('send', 'event', 'Downloads', 'ahawd pdf download', 'SD' + report_school_district);
        console.log('GA ahawd pdf download event sent.', report_school_district);
      }

    }
    
  });
});
