<?php
  include "config.php";
  if (!isset($_SESSION['sid'])) {
    header("Location: signup.php");
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jacquard+12&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/index.css">
    <title>Enroll.</title>
  </head>
  <body>
    <header>
      <div class="banner-container">
        <div class="banner">
          <div class="circle"></div>
          <div class="sm-square"></div>
          <div class="lg-square"></div>
        </div>
        Enroll
      </div>
      <div class="user-buttons">
        <a href="./courses.php">Courses</a>
        <div x-data="{ open: false }" class="user-div">
          <div @click="open = !open" class="user-dropdown-button"></div>
          <div 
            x-show="open"
            @click.outside="open = false" 
            x-transition
            x-on:click.outside="open = false"
            class="user-dropdown"
            :class="open ? 'open' : 'closing'"
            >
            <div class="dropdown-item">
              <img src="./assets/user.png" alt="user icon">
              <p><?php echo htmlspecialchars($_SESSION['sname']);?></p>
            </div>
            <div class="dropdown-item">
              <img src="./assets/logout.png" alt="logout icon">
              <a href="logout.php" style="all:unset; width:100%;">Logout</a>            
            </div>
          </div>
        </div>
      </div>
    </header>
    <main class="my-course-main">
      
    </main>
    <script type="module" src="./scripts/app.js"></script>
  </body>
</html>