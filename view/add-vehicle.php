<?php 
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] <= 1){
    header('Location: /index.php/');
}
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
  <title>Document</title>
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
    <h1>Add Vehicle</h1>
    <p>*Note all Fields are Required</p>
    <?php
      if (isset($message)) {
          echo $message;
      }
    ?>

    <form action="/phpmotors/vehicles/index.php" method="POST">
      <label for="carClass">Choose a classification</label>
      <select id="carClass" name="carClass">
      <?php 
        $classifications = getClassifications();
        foreach ($classifications as $classification){
          echo "<option value='".$classification['classificationId']."'>".$classification['classificationName']."</option>";
        };
      ?>
      </select>
      <label for="vehicleMake">Make</label>
      <input type="text" name="vehicleMake" id="vehicleMake" <?php if(isset($vehicleMake)){echo "value='$vehicleMake'";}?> required>
      <label for="vehicleModel">Model</label>
      <input type="text" name="vehicleModel" id="vehicleModel" <?php if(isset($vehicleModel)){echo "value='$vehicleModel'";}?> required>
      <label for="vehicleDescription">description</label>
      <textarea rows="3" name="vehicleDescription" id="vehicleDescription" required><?php if(isset($vehicleDescription)){echo "$vehicleDescription";}?> </textarea>
      <label for="vehicleImagePath">Image Path</label>
      <input type="text" name="vehicleImagePath" id="vehicleImagePath" <?php if(isset($vehicleImagePath)){echo "value='$vehicleImagePath'";}?> required>
      <label for="vehicleThumbnail">Thumbnail Path</label>
      <input type="text" name="vehicleThumbnail" id="vehicleThumbnail" <?php if(isset($vehicleThumbnail)){echo "value='$vehicleThumbnail'";}?> required>
      <label for="vehiclePrice">Price</label>
      <input type="number" name="vehiclePrice" id="vehiclePrice" <?php if(isset($vehiclePrice)){echo "value='$vehiclePrice'";}?> required>
      <label for="vehicleStock">In Stock</label>
      <input type="text" name="vehicleStock" id="vehicleStock" <?php if(isset($vehicleStock)){echo "value='$vehicleStock'";}?> required>
      <label for="vehicleColor">Color</label>
      <input type="text" name="vehicleColor" id="vehicleColor">

      <input type="submit" name="submit" value="Add Vehicle" class="inputBtn">
      <input type="hidden" name="action" value="addVehicle">
    </form>
  </main>
  <footer>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>