<?php 
  if (isset($_SESSION['message'])) {
      $message = $_SESSION['message'];
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
  <title>Image Management</title>
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
    <h1>Image Management</h1>
    <h2>Add New Vehicle Image</h2>
    <?php
      if (isset($message)) {
        echo $message;
      } 
    ?>

    <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
      <label for="invItem">Vehicle</label>
        <?php echo $prodSelect; ?>
        <fieldset>
          <label>Is this the main image for the vehicle?</label>
          <label for="priYes" class="pImage">Yes</label>
          <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
          <label for="priNo" class="pImage">No</label>
          <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
        </fieldset>
      <label>Upload Image:</label>
      <input type="file" name="file1">
      <input type="submit" class="regbtn" value="Upload">
      <input type="hidden" name="action" value="upload">
    </form>
    <hr>
    <h2>Existing Images</h2>
    <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
    <?php
      if (isset($imageDisplay)) {
        echo $imageDisplay;
      } 
    ?>
  </main>
  <footer>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>
<?php unset($_SESSION['message']); ?>