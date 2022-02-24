<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="style.css"> -->
  <title>Home</title>
  <style>
    <?php include 'style.css';
    ?>
  </style>
</head>

<body>
  <nav>
    <ul>
      <?php
      if (isset($_SESSION["usersId"])) {
        echo "<li><a href='./profile/profile.php'>Log out</a></li>";
        echo "<li><a href='./includes/logout.inc.php'>Profile</a></li>";
      } else {
        echo "<li><a href='./user/main/login.php'>Login</a></li>";
        echo "<li><a href='./register/register.php'>Register</a></li>";
      }
      ?>
      <li><a href="./faq/faq.php">Contact</a></li>
      <li><a href="./support/support.php">Services</a></li>
      <div id="logo">
        <a href="index.php">
          <img src="tecsup-logo.png" width="280px">
        </a>
    </ul>
  </nav>
  <div class="main">
    <?php
    if (isset($_SESSION["userId"])) {
      echo "<h1>Hello " . $_SESSION["userName"] . "!</h1>";
    } else {
      echo "<h1>Hello User!</h1>";
    }
    ?>
    <h2>Welcome to TECSUP</h2></br>
    <p>Here we provide to customers with a service that solves hardware and software difficulties utilizing an internet platform, saving them time and money.</p>
    <p>We have the knowledge and experience to assist and resolve issues, and users will receive accurate solutions.</p>
    <?php
    if (isset($_SESSION["usersId"])) {
      echo "<button><a href='./support/supportticket.php'>Support ticket</a></button>";
    } else {
      echo "<button><a href='./login/login.php'>Support ticket</a></button>";
    }
    ?>
    <?php
    if (isset($_SESSION["usersId"])) {
      echo "<button><a href='./support/supportticket.php'>Support ticket</a></button>";
    } else {
      echo "<button><a href='./login/login.php'>Support ticket</a></button>";
    }
    ?>
  </div>
</body>

</html>