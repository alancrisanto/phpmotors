<?php
if($_SESSION['clientData']['clientLevel'] < 2){
  header('location: /phpmotors/');
  exit;
}
?>
<?php
      // Build the classifications option list
      $carClassifications = getClassifications();
      $classifList = '<select name="carClass" id="carClass">';
      $classifList .= "<option>Choose a Car Classification</option>";
      foreach ($carClassifications as $classification) {
      $classifList .= "<option value='$classification[classificationId]'";
      if(isset($classificationId)){
        if($classification['classificationId'] === $classificationId){
        $classifList .= ' selected ';
        }
      } elseif(isset($invInfo['classificationId'])){
        if($classification['classificationId'] === $invInfo['classificationId']){
          $classifList .= ' selected ';
        }
      }
      $classifList .= ">$classification[classificationName]</option>";
      }
      $classifList .= '</select>';
      ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/small.css">
  <link rel="stylesheet" href="/phpmotors/css/medium.css">
  <link rel="stylesheet" href="/phpmotors/css/large.css">
  <!-- <link rel="stylesheet" href="/phpmotors/css/normalize.css"> -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Quantico:wght@400;700&display=swap" rel="stylesheet">
  <title>
    <?php 
      if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	      echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	    elseif(isset($invMake) && isset($invModel)) { 
	      echo "Delete $invMake $invModel"; }
      ?> | PHP Motors
  </title>
</head>
<body>
  <header>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
  </header>
  <nav>
    <?php 
    //require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/navbar.php'; 
    echo $navList;
    ?>
  </nav>
  <main>
    <h1>
      <?php 
        if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	        echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
        elseif(isset($invMake) && isset($invModel)) { 
	        echo "Delete$invMake $invModel"; }
      ?>
    </h1>
    <p class="warning-msg">Confirm Vehicle Deletion. The delete is permanent.</p>
    <?php
      if (isset($message)) {
          echo $message;
      }
    ?>

    <form action="/phpmotors/vehicles/index.php" method="POST">
      <label for="carClass">Choose a classification</label>
      <?php
        echo $classifList;
      ?>
      <!-- <select id="carClass" name="carClass"> -->

      <label for="vehicleMake">Make</label>
      <input type="text" name="vehicleMake" id="vehicleMake" required readonly <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } ?>>
      <label for="vehicleModel">Model</label>
      <input type="text" name="vehicleModel" id="vehicleModel" required readonly <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } ?>>
      <label for="vehicleDescription">description</label>
      <textarea name="vehicleDescription" id="vehicleDescription" rows="4" required readonly><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; } ?></textarea>

      <input type="submit" name="submit" value="Delete Vehicle" class="inputBtn deleteBtn">
      <input type="hidden" name="action" value="deleteVehicle">
      <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];}  ?>">
    </form>
  </main>
  <footer>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html> 