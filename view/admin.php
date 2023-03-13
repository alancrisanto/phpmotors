<?php 
  if (!$_SESSION['loggedin']){
      header('Location: /index.php');
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
  <h1>
    <?php echo $_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname']; ?>
  </h1>
  <?php
      if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
      }
  ?>
  <br>
  <p>You are logged in.</p>
  <br>
  <ul class="client-info">
      <li><?php echo "First Name: ".$_SESSION['clientData']['clientFirstname']; ?></li>
      <li><?php echo "Last Name: ".$_SESSION['clientData']['clientLastname'] ?></li>
      <li><?php echo "Email: ".$_SESSION['clientData']['clientEmail']; ?></li>
  </ul>

  <?php
  if (intval($_SESSION['clientData']['clientLevel']) > 1){
      echo "<br>";
      echo "<h2 class>Inventory Management</h2>";
      echo "<p>Use this link to manage the inventory</p>";
      echo "<a href = '/phpmotors/vehicles/'>Vehicle Management</a>";
  }
  ?>
  <h2>Account Management</h2>
  <p>Use this link to update account information</p>
  <p><a href = "../accounts/?action=updateAccountInfo">Update Account Information</a></p>
  </main>
  <footer>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>