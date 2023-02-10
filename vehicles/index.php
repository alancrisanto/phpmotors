<?php
// This is the vehicle controller

  // Get the database connection file
  require_once '../library/connections.php';
    // Get the PHP Motors model for use as needed
  require_once '../model/main-model.php';
  // Get the vehicle model
  require_once '../model/vehicles-model.php';
  // get the functions
  require_once '../model/functions.php';  
  // Get the array of classifications
  $classifications = getClassifications();
  
  // Create the navbar dinamically from the database
  $navList = navbar($classifications);


  // This is the main controller
  $action = filter_input(INPUT_POST, 'action');
  if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
  }

  switch ($action) {
    case 'classification':
      include "../view/add-classification.php";
      break;
    case 'vehicle':
      include "../view/add-vehicle.php";
      break;
    case 'addClassification':
      // Filter and store data
      $newClassification = filter_input(INPUT_POST, 'newClassification');
      // Check for missing data
      if (empty($newClassification)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/add-classification.php';
        exit;
      }
      // Send data to the model
      $regOutcome = newClassification($newClassification);

      // Check and report the result
      if($regOutcome === 1){
        include '../view/vehicle-man.php';
        exit;
      } else {
        $message = "<p>Sorry, but the registration failed. Please try again.</p>";
        include '../view/add-classification.php';
        exit;
      }
      break;

    case 'addVehicle':
      $carClass = filter_input(INPUT_POST, 'carClass');
      $vehicleMake = filter_input(INPUT_POST, 'vehicleMake');
      $vehicleModel = filter_input(INPUT_POST, 'vehicleModel');
      $vehicleDescription = filter_input(INPUT_POST, 'vehicleDescription');
      $vehicleImagePath = filter_input(INPUT_POST, 'vehicleImagePath');
      $vehicleThumbnail = filter_input(INPUT_POST, 'vehicleThumbnail');
      $vehiclePrice = filter_input(INPUT_POST, 'vehiclePrice');
      $vehicleStock = filter_input(INPUT_POST, 'vehicleStock');
      $vehicleColor = filter_input(INPUT_POST, 'vehicleColor');

    if(empty($carClass) || empty($vehicleMake) || empty($vehicleModel) || empty($vehicleDescription) || empty($vehicleImagePath) || empty($vehicleThumbnail) || empty($vehiclePrice) || empty($vehicleStock) || empty($vehicleColor)){
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/add-vehicle.php';
      exit; 
    };

    $regOutcome = newVehicle($vehicleMake, $vehicleModel, $vehicleDescription, $vehicleImagePath, $vehicleThumbnail, $vehiclePrice, $vehicleStock, $vehicleColor, $carClass);

    if($regOutcome === 1){
      $message = "<p>Succes! Vehicle registration was confirmed</p>";
      include '../view/vehicle-man.php';
      exit;
    } else {
      $message = "<p>Sorry, but the registration failed. Please try again.</p>";
      include '../view/add-vehicle.php';
      exit;
    };
    break;
    default:
      include '../view/vehicle-man.php';
      break;
  };

?>