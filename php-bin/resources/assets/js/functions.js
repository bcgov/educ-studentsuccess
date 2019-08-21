// Debounce function for our resize and scroll events.
// https://davidwalsh.name/javascript-debounce-function
function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
}

// Update URL params.
// https://stackoverflow.com/a/10997390/1171790
function updateURLParameter(url, param, paramVal) {
  var TheAnchor = null;
  var newAdditionalURL = "";
  var tempArray = url.split("?");
  var baseURL = tempArray[0];
  var additionalURL = tempArray[1];
  var temp = "";

  if (additionalURL) {
    var tmpAnchor = additionalURL.split("#");
    var TheParams = tmpAnchor[0];
    TheAnchor = tmpAnchor[1];
    if (TheAnchor)
      additionalURL = TheParams;

    tempArray = additionalURL.split("&");

    for (var i = 0; i < tempArray.length; i++) {
      if (tempArray[i].split('=')[0] != param) {
        newAdditionalURL += temp + tempArray[i];
        temp = "&";
      }
    }        
  } else {
    var tmpAnchor = baseURL.split("#");
    var TheParams = tmpAnchor[0];
    TheAnchor  = tmpAnchor[1];

    if(TheParams)
      baseURL = TheParams;
  }

  if(TheAnchor)
    paramVal += "#" + TheAnchor;

  var rows_txt = temp + "" + param + "=" + paramVal;

  return baseURL + "?" + newAdditionalURL + rows_txt;
}
