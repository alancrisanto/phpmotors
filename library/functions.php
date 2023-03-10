<?php
function checkEmail($clientEmail){
  $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
  return $valEmail;
}

// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
function checkPassword($clientPassword){
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
  return preg_match($pattern, $clientPassword);
}

// Note: The regular expression above allows spaces to be treated as a 
// "special character".

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

// Build the classifications select list 
function buildClassificationList($classifications){ 
  $classificationList = '<select name="classificationId" id="classificationList">'; 
  $classificationList .= "<option>Choose a Classification</option>"; 
  foreach ($classifications as $classification) { 
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
  } 
  $classificationList .= '</select>'; 
  return $classificationList; 
}

?>