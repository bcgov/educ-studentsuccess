<?php

// http://stackoverflow.com/a/173887/1171790
if (php_sapi_name() == "cli") {

  foreach (glob("./*.pdf") as $file) {
    rename($file, str_replace(" ", "-", $file));
  }

} else { // Not in command line mode. 

  header("HTTP/1.0 404 Not Found");
  exit();

}
