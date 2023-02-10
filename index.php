<?php 
// this the main controller
  // Get the database connection file
  require_once 'library/connections.php';
    // Get the PHP Motors model for use as needed
  require_once 'model/main-model.php';
  // get the functions
  require_once 'model/functions.php';

  // Get the array of classifications
  $classifications = getClassifications();
    
  // var_dump($classifications);
  // exit;
// Build a navigation bar using the $classifications array
  $navList = navbar($classifications);
  // echo $navList;
  // exit;


  // This is the main controller
  $action = filter_input(INPUT_POST, 'action');
  if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
  }

  switch ($action) {
    case 'template':
      include 'view/template.php';
      break;
    default:
      $pageTitle = "Home";
      include 'view/home.php';
      break;
    }
?>