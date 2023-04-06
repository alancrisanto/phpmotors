<?php

// *****************************
// This is the vehicle controller
// *****************************

// Creates or access a session
session_start();

  // Get the database connection file
  require_once '../library/connections.php';
    // Get the PHP Motors model for use as needed
  require_once '../model/main-model.php';
  // Get the vehicle model
  require_once '../model/vehicles-model.php';
  // Get the functions library
  require_once '../library/functions.php';
  // get the upload model
  require_once '../model/uploads-model.php';
  // Get the reviews model
  require_once '../model/review-model.php';
  
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
    case 'newClassification':
      include "../view/add-classification.php";
      break;
    case 'vehicle':
      include "../view/add-vehicle.php";
      break;
    case 'addClassification':
      // Filter and store data
      $newClassification = filter_input(INPUT_POST, 'newClassification', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      // Check for missing data
      if (empty($newClassification)){
        $message = "<p class='error-msg'>Please provide information for all empty form fields.</p>";
        include '../view/add-classification.php';
        exit;
      }
      // Send data to the model
      $regOutcome = newClassification($newClassification);

      // Check and report the result
      if($regOutcome === 1){
        // include '../view/vehicle-man.php';
        header("Location: /phpmotors/vehicles");
        exit;
      } else {
        $message = "<p class='error-msg'>Sorry, but the registration failed. Please try again.</p>";
        include '../view/add-classification.php';
        exit;
      }
      break;

    case 'addVehicle':
      $carClass = trim(filter_input(INPUT_POST, 'carClass', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $vehicleMake = trim(filter_input(INPUT_POST, 'vehicleMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $vehicleModel = trim(filter_input(INPUT_POST, 'vehicleModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $vehicleDescription = trim(filter_input(INPUT_POST, 'vehicleDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $vehicleImagePath = trim(filter_input(INPUT_POST, 'vehicleImagePath', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $vehicleThumbnail = trim(filter_input(INPUT_POST, 'vehicleThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $vehiclePrice = trim(filter_input(INPUT_POST, 'vehiclePrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
      $vehicleStock = trim(filter_input(INPUT_POST, 'vehicleStock', FILTER_SANITIZE_NUMBER_INT));
      $vehicleColor = trim(filter_input(INPUT_POST, 'vehicleColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

      if(empty($carClass) || empty($vehicleMake) || empty($vehicleModel) || empty($vehicleDescription) || empty($vehicleImagePath) || empty($vehicleThumbnail) || empty($vehiclePrice) || empty($vehicleStock) || empty($vehicleColor)){
        $message = "<p class='error-msg'>Please provide information for all empty form fields.</p>";
        include '../view/add-vehicle.php';
        exit; 
      };

      $regOutcome = newVehicle($vehicleMake, $vehicleModel, $vehicleDescription, $vehicleImagePath, $vehicleThumbnail, $vehiclePrice, $vehicleStock, $vehicleColor, $carClass);

      if($regOutcome == 1){
        $message = "<p class='success-msg'>Succes! Vehicle registration was confirmed</p>";
        include '../view/vehicle-man.php';
        exit;
      } else {
        $message = "<p class='error-msg'>Sorry, but the registration failed. Please try again.</p>";
        include '../view/add-vehicle.php';
        exit;
      };
      break;

    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */ 
    case 'getInventoryItems': 
      // Get the classificationId 
      $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
      // Fetch the vehicles by classificationId from the DB 
      $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
      echo json_encode($inventoryArray); 
      break;
    
    case 'mod':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if(count($invInfo)<1){
        $message = 'Sorry, no vehicle information could be found.';
      }
      include '../view/vehicle-update.php';
      exit;
      break;
    case 'updateVehicle':
      $carClass = trim(filter_input(INPUT_POST, 'carClass', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $vehicleMake = trim(filter_input(INPUT_POST, 'vehicleMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $vehicleModel = trim(filter_input(INPUT_POST, 'vehicleModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $vehicleDescription = trim(filter_input(INPUT_POST, 'vehicleDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $vehicleImagePath = trim(filter_input(INPUT_POST, 'vehicleImagePath', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $vehicleThumbnail = trim(filter_input(INPUT_POST, 'vehicleThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $vehiclePrice = trim(filter_input(INPUT_POST, 'vehiclePrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
      $vehicleStock = trim(filter_input(INPUT_POST, 'vehicleStock', FILTER_SANITIZE_NUMBER_INT));
      $vehicleColor = trim(filter_input(INPUT_POST, 'vehicleColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

      if(empty($carClass) || empty($vehicleMake) || empty($vehicleModel) || empty($vehicleDescription) || empty($vehicleImagePath) || empty($vehicleThumbnail) || empty($vehiclePrice) || empty($vehicleStock) || empty($vehicleColor)){
        $message = "<p class='error-msg'>Please complete all information for the updated item! Double check the classification of the item.</p>";
        include '../view/vehicle-update.php';
        exit; 
      };

      $$updateResult = updateVehicle($vehicleMake, $vehicleModel, $vehicleDescription, $vehicleImagePath, $vehicleThumbnail, $vehiclePrice, $vehicleStock, $vehicleColor, $carClass, $invId);

      if($$updateResult == 1){
        $message = "<p class='success-msg'>Congratulations, the $vehicleMake $vehicleModel was successfully updated.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/vehicles/');
        exit;
      } else {
        $message = "<p class='error-msg'>Error. The vehicle update was not possible.</p>";
        include '../view/vehicle-update.php';
        exit;
      };
      break;
      case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
          }
          include '../view/vehicle-delete.php';
          exit;
          break;
    case 'deleteVehicle':
      $make = filter_input(INPUT_POST, 'make', FILTER_SANITIZE_STRING);
        $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        // Add Data to database
        $deleteResult = deleteVehicle($invId);
        // Check and report the result
        if($deleteResult === 1){
            $message = "<p class='success-msg'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
          $message = "<p class='error-msg'>Error: $invMake $invModel was not deleted.</p>";
          $_SESSION['message'] = $message;
	        header('location: /phpmotors/vehicles/');
	        exit;
        }
      break;
    case 'classification':
      $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $vehicles = getVehiclesByClassification($classificationName);
      if(!count($vehicles)){
        $message = "<p class='error-msg'>Sorry, no $classificationName could be found.</p>";
      } else {
        $vehicleDisplay = buildVehiclesDisplay($vehicles);
      }
      // echo $vehicleDisplay;
      // exit;
      include '../view/classification.php';
      break;
    case 'vehicleDetail':
      $vehicleId = filter_input(INPUT_GET, 'vehicle', FILTER_SANITIZE_NUMBER_INT);
      $vehicleDetail = getVehiclesById($vehicleId);
      $vehicleThumbnailPath = getThumbnails($vehicleId);
      $reviewList = getInventoryReviews($vehicleId);

      // Build the html for the review list.
      $reviewHTML = '<div class = "reviews">';
      foreach($reviewList as $review){
          $reviewHTML .= buildReview($review['clientFirstname'], $review['clientLastname'], $review['reviewDate'], $review['reviewText']);
      }
      $reviewHTML .= "</div>";

      // json_encode($vehicleDetail); //comenté esta línea y el código funciona normal
      if(!count($vehicleDetail)){
        $message = "<p class='error-msg'>Sorry, no data could be found.</p>";
      } else {
        $vehicleDetailThumbnail = displayThumbnailView($vehicleThumbnailPath);
        $vehicleDisplayDetail = buildVehiclesDetail($vehicleDetail, $vehicleDetailThumbnail);
      }
      include '../view/vehicle-detail.php';
      break;
      // include '../view/vehicle-detail.php';
    default:
      $classificationList = buildClassificationList($classifications);
      include '../view/vehicle-man.php';
      break;
  };

?>