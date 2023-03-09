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
      echo $navList;
    ?>
  </nav>
  <main>
    <h1>Add classification</h1>
    <?php
      if (isset($message)){
        echo $message;
      }
      ?>
    <form action="/phpmotors/vehicles/index.php" method="POST">
      <label for="newClassification">Classification Name</label>
      <span class="form-comment">Max characters 30</span>

      <input type="text" name="newClassification" id="newClassification" <?php if(isset($newClassification)){echo "value='$newClassification'";}?> required>
      <br>
      <input type="submit" name="submit" value="Register" class="inputBtn">
      <input type="hidden" name="action" value="addClassification">
    </form>
  </main>
  <footer>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>