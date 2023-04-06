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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <?php 
        if(isset($message)){
          echo $message; 
        }
      ?>
    <?php
      // echo $vehicleDetailThumbnail;
    ?>
    <?php
      echo $vehicleDisplayDetail;
    ?>
    <?php if(isset($vehicleHTML)){
                    echo $vehicleHTML; } 
    ?>
    <div class="form-review">
    <h3>Customer Review</h3>
    <?php
      if (isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])) {
          // el usuario está conectado
      } else {
          echo '<p>You must <a href="/phpmotors/accounts/?action=login">Login</a> to write a review.</p>';
      }
      
    ?>
    <form action="/phpmotors/reviews/index.php" method="POST" <?php if (!isset($_SESSION["loggedin"])) {echo "style='display: none;'";} ?>>
        <label for="review">Add a review</label>
        <textarea id="review" name="newReview" rows="4" cols="50" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required></textarea>
        <input type="submit" name="submit" class="inputBtn" id="regbtn" value="Add Review">

        <input type="hidden" name="action" value="addReview">
        <input type="hidden" name="carId" <?php echo 'value="'.$vehicleId.'"' ?>>
        <input type="hidden" name="userId" <?php echo 'value="'.$_SESSION['clientData']['clientId'].'"' ?>>
    </form>
    </div>
    <?php 
        if (isset($reviewHTML)){
            echo $reviewHTML;
        }
    ?>
  </main>
  <footer>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>