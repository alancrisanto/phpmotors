<?php 
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1){
    header('Location: /index.php/');
}
?>
<?php
      // Build the classifications option list
      $carClassifications = getClassifications();
      $classifList = '<select name="classificationId" id="classificationId">';
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
		  echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	  elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }
  ?>
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
        if(isset($invInfo['vehicleMake']) && isset($invInfo['vehicleModel'])){ 
          echo "Modify $invInfo[vehicleMake] $invInfo[vehicleModel]";} 
        elseif(isset($vehicleMake) && isset($vehicleModel)) { 
          echo "Modify$vehicleMake $vehicleModel"; }
      ?>
    </h1>
    <p>*Note all Fields are Required</p>
    <?php
      if (isset($message)) {
          echo $message;
      }
    ?>

    <form action="/phpmotors/vehicles/index.php" method="POST">
      <label for="carClass">Choose a classification</label>
      

      <!-- <select id="carClass" name="carClass"> -->

      <label for="vehicleMake">Make</label>
      <input type="text" name="vehicleMake" id="vehicleMake" required <?php if(isset($vehicleMake)){ echo "value='$vehicleMake'"; } elseif(isset($invInfo['vehicleMake'])) {echo "value='$invInfo[vehicleMake]'"; }?>>
      <label for="vehicleModel">Model</label>
      <input type="text" name="vehicleModel" id="vehicleModel" required <?php if(isset($vehicleModel)){ echo "value='$vehicleModel'"; } elseif(isset($invInfo['vehicleModel'])) {echo "value='$invInfo[vehicleModel]'"; }?>>
      <label for="vehicleDescription">description</label>
      <textarea rows="3" name="vehicleDescription" id="vehicleDescription" required><?php if(isset($vehicleDescription)){ echo $vehicleDescription; } elseif(isset($invInfo['vehicleDescription'])) {echo $invInfo['vehicleDescription']; }?></textarea>
      <label for="vehicleImagePath">Image Path</label>
      <input type="text" name="vehicleImagePath" id="vehicleImagePath" required <?php if(isset($vehicleImagePath)){ echo "value='$vehicleImagePath'"; } elseif(isset($invInfo['vehicleImagePath'])) {echo "value='$invInfo[vehicleImagePath]'"; }?>>
      <label for="vehicleThumbnail">Thumbnail Path</label>
      <input type="text" name="vehicleThumbnail" id="vehicleThumbnail" required <?php if(isset($vehicleThumbnail)){ echo "value='$vehicleThumbnail'"; } elseif(isset($invInfo['vehicleThumbnail'])) {echo "value='$invInfo[vehicleThumbnail]'"; }?>>
      <label for="vehiclePrice">Price</label>
      <input type="number" name="vehiclePrice" id="vehiclePrice" required <?php if(isset($vehiclePrice)){ echo "value='$vehiclePrice'"; } elseif(isset($invInfo['vehiclePrice'])) {echo "value='$invInfo[vehiclePrice]'"; }?>>
      <label for="vehicleStock">In Stock</label>
      <input type="text" name="vehicleStock" id="vehicleStock" required <?php if(isset($vehicleStock)){ echo "value='$vehicleStock'"; } elseif(isset($invInfo['vehicleStock'])) {echo "value='$invInfo[vehicleStock]'"; }?>>
      <label for="vehicleColor">Color</label>
      <input type="text" name="vehicleColor" id="vehicleColor">

      <input type="submit" name="submit" value="Update Vehicle" class="inputBtn">
      <input type="hidden" name="action" value="updateVehicle">
    </form>
  </main>
  <footer>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>