<?php
function navbar ($classifications){
  // Build a navigation bar using the $classifications array
  $navList = '<ul class="nav-ul">';
  $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
  foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
  };
  $navList .= '</ul>';

  return $navList;
}

?>