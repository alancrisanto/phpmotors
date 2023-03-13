<?php 
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1){
    header('Location: /index.php/');
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
	      echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	    elseif(isset($invMake) && isset($invModel)) { 
	      echo "Modify $invMake $invModel"; }
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
	        echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
        elseif(isset($invMake) && isset($invModel)) { 
	        echo "Modify$invMake $invModel"; }
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
      <?php
        echo $classifList;
      ?>
      <!-- <select id="carClass" name="carClass"> -->

      <label for="vehicleMake">Make</label>
      <input type="text" name="vehicleMake" id="vehicleMake" required <?php if(isset($make)){echo "value='$make'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } ?>>
      <label for="vehicleModel">Model</label>
      <input type="text" name="vehicleModel" id="vehicleModel" required <?php if(isset($model)){echo "value='$model'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; } ?>>
      <label for="vehicleDescription">description</label>
      <textarea rows="3" name="vehicleDescription" id="vehicleDescription" required><?php if(isset($description)){echo "$description";} elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; } ?></textarea>
      <label for="vehicleImagePath">Image Path</label>
      <input type="text" name="vehicleImagePath" id="vehicleImagePath" required <?php if(isset($image)){echo "value='$image'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; } ?>>
      <label for="vehicleThumbnail">Thumbnail Path</label>
      <input type="text" name="vehicleThumbnail" id="vehicleThumbnail" required <?php if(isset($thumb)){echo "value='$thumb'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; } ?>>
      <label for="vehiclePrice">Price</label>
      <input type="number" name="vehiclePrice" id="vehiclePrice" required <?php if(isset($price)){echo "value='$price'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; } ?>>
      <label for="vehicleStock">In Stock</label>
      <input type="text" name="vehicleStock" id="vehicleStock" required <?php if(isset($stock)){echo "value='$stock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; } ?>>
      <label for="vehicleColor">Color</label>
      <input type="text" name="vehicleColor" id="vehicleColor" required <?php if(isset($color)){echo "value='$color'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; } ?>>

      <input type="submit" name="submit" value="Update Vehicle" class="inputBtn">
      <input type="hidden" name="action" value="updateVehicle">
      <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
    </form>
  </main>
  <footer>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>