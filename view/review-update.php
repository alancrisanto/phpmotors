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
    <h1>Edit Review</h1>
    <p>
        Please edit your review.
    </p>
    <p> Reviewed on <?php echo date('d M Y', strtotime($review['reviewDate'])); ?> </p>

    <?php
      if (isset($message)) {
          echo $message;
      } 
    ?>

    <form action="/phpmotors/reviews/index.php" method="POST">
        <label for="review">Review</label>
        <textarea id="review" name="editReview" rows="8" required><?php echo $review['reviewText'];  ?></textarea>
        <input type="submit" name="submit" id="regbtn" value="Update Review">

        <input type="hidden" name="action" value="editReview">
        <input type="hidden" name="review" <?php echo 'value="'.$reviewId.'"' ?>>
        <input type="hidden" name="date" id="date" value="<?php echo date('Y-m-d H:i:s'); ?>">

    </form>
  </main>
  <footer>
  <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>