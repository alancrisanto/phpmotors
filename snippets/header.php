  <picture class="header-img">
    <img src="/phpmotors/images/site/logo.png" alt="Php Motor logo">
  </picture>
  <?php
    if(isset($_SESSION['loggedin'])){
      echo "<a href ='accounts/?action=none' class='name-label'>
              Welcome ".$_SESSION['clientData']['clientFirstname'].
            "</a>";
    } else {
      echo "";
    }
  ?>
  <div>
    <!-- <a href="accounts/?action=login">My Account</a> -->
    <?php 
      if(isset($_SESSION['loggedin'])){
          echo "<a href ='accounts/?action=Logout'>Log Out</a>";
      } else {
          echo "<a href ='accounts/?action=login'>My Account</a>";
      }
      ?>
  </div>