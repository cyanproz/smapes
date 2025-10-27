<?php
require "site-config.php";
require "backend/init.php";
?>
<!DOCTYPE html>
<html lang="en" class="theme--light">
  <head>
    <?php include "partials/html-head.php"; ?>
    <link rel="stylesheet" href="styles/style-page-home.css"/>
  </head>

  <!-- 
  === Pages ===
  Home (Index)
  About
  Drop It
  Catalog
  Catalog Item Details
  Settings
  Login
  Register
   -->
  
  <body>
    <div id='page-header-contents-footer-layout'>
      <?php include "partials/page-navbar.php"; ?>

      <div id="page-contents" style="background-color: transparent">
        <video width="100%" height="100%" autoplay muted loop style="position: fixed; left: 0; right: 0; top: 0; bottom: 0; z-index: -100; object-fit: cover;">
          <source src="videos/home-background-fhd.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>

        <!-- Hero -->
        <?php include "partials/page-header.php"; ?>

        <!-- Menu Buttons -->
        <section class="container" style="max-width: 720px;">
          <video width="100%" height="100%" autoplay muted loop style="display: block; border-radius: 10px; aspect-ratio: 1/1; object-fit: cover; opacity: .5;">
            <source src="videos/arrow-swirling.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video>

          <div id="menu-buttons">
            <a href="about.php" class="button-link menu-button">
              <img src="images/menu-buttons/about.png" alt="" srcset="">
              <span class="text">Tentang</span>
            </a>
            
            <a href="drop-it.php" class="button-link menu-button">
              <img src="images/menu-buttons/drop-it.png" alt="" srcset="">
              <span class="text">Timbang Kertasmu</span>
            </a>
  
            <a href="catalog.php" class="button-link menu-button">
              <img src="images/menu-buttons/catalog.png" alt="" srcset="">
              <span class="text">Katalog</span>
            </a>
          </div>
        </section>
      </div>

      <?php include "partials/page-footer.php"; ?>
    </div>
    
    <?php include "partials/chatbot.php"; ?>
    
    <script src="https://alif.prdn.net/common-script.css"></script>
    <script src="scripts/script-main.js"></script>
    
    <script>
      const menuButtons = document.getElementById("menu-buttons");

      function resizeFont(width, targetEl) {
        targetEl.style.fontSize = (width / 50) + "px"; // adjust divisor to control scale
      }

      function resizeMenuButtonsText() {
        document.querySelectorAll("#menu-buttons a.menu-button").forEach(element => {
          let elementWidth = element.offsetWidth - 40;
          // element.style.fontSize = (elementWidth / 6) + "px";
          element.style.fontSize = (document.getElementById("menu-buttons").offsetWidth / 25) + "px";
          element.style.padding = (elementWidth / 43) + "px";
        });
      }

      resizeMenuButtonsText();

      // Resize dynamically if container changes
      window.addEventListener("resize", () => resizeMenuButtonsText());
      new ResizeObserver(() => resizeMenuButtonsText()).observe(menuButtons.parentElement);
    </script>
  </body>
</html>
