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
  <title><?php echo $classificationName; ?> vehicles | PHP Motors, Inc.</title>
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
      <?php echo $classificationName; ?> 
      vehicles
    </h1>
    <?php 
      if(isset($message)){
        echo $message; 
      }
    ?>
    <?php 
      if(isset($vehicleDisplay)){
        echo $vehicleDisplay; 
      } 
    ?>
  </main>
  <footer>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>