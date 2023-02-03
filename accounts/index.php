<?php 
  // this the account controller

  // Get the database connection file
  require_once '../library/connections.php';
    // Get the PHP Motors model for use as needed
  require_once '../model/main-model.php';
  // get the accounts model
  require_once '../model/accounts-model.php';

  // Get the array of classifications
  $classifications = getClassifications();
    
    // var_dump($classifications);
    // exit;
    $navList = '<ul class="nav-ul">';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';


  // This is the main controller
  $action = filter_input(INPUT_POST, 'action');
  if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
  }

  switch ($action) {
    case 'login':
      include '../view/login.php';
      break;
    case 'registration':
      include '../view/registration.php';
      break;
    case 'register':
      //Filter and store data
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
      $clientLastname = filter_input(INPUT_POST, 'clientLastname');
      $clientEmail = filter_input(INPUT_POST, 'clientEmail');
      $clientPassword = filter_input(INPUT_POST, 'clientPassword');

      // Check for missing data
      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit; 
      }

      // Send the data to the model
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

      // Check and report the result
      if($regOutcome === 1){
        $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
        include '../view/login.php';
        exit;
      } else {
        $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
        include '../view/registration.php';
        exit;
      }
      break;
    
    default:
    //   include 'view/login.php';
      break;
    }
?>