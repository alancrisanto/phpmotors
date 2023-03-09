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
    <h1>Sign In</h1>
    <div class="form-login">
    <?php
      if (isset($message)) {
          echo $message;
      }
      if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
      }
    ?>
      <form action="/phpmotors/accounts/index.php" method="POST">
        <label for="clientEmail">Email</label>
        <input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}?> required>

        <label for="clientPassword">Password</label>
        <span class="form-comment">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
        <input name="clientPassword" id="clientPassword" type="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
        <br>

        <input name="submitBtn" type="submit" class="inputBtn" value="Sign In">
        <input type="hidden" name="action" value="Login">

      </form>
    </div>
    <div>
      <a href="../accounts/?action=registration">Not a member yet?</a>
    </div>
  </main>
  <footer>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>