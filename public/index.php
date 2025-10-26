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
  Pages
  About SMAPES
  Paper Waste Management System
  Shop
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
          <!-- <video width="100%" height="100%" autoplay muted loop style="border-radius: 10px; aspect-ratio: 1/1; object-fit: cover; opacity: .5; position: relative; width: calc(100% + 40px); height: auto; top: -20px; left: -20px; right: -20px;">
            <source src="videos/arrow-swirling.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video> -->

          <video width="100%" height="100%" autoplay muted loop style="display: block; border-radius: 10px; aspect-ratio: 1/1; object-fit: cover; opacity: .5;">
            <source src="videos/arrow-swirling.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video>

          <!-- <img src="gifs/arrow-swirling.gif" alt="" style="aspect-ratio: 1/1; object-fit: cover; background: transparent; width: 100%;"> -->

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

        <!-- About Us -->
        <!-- <section id="about" class="container fit">
          <h2>🌱 About Us</h2>
          <div class="" style="display: flex; background-color: green;">
            <img src="img1.png" alt="" srcset="" style="width: 400px;">
            <p>SMAPES is blah blah blah</p>
          </div>
        </section> -->

        <div class="container" style="display: none">
          <!-- Kalkulator -->
          <div class="calculator container-box-template-1">
            <h2>📄 Weigh Your Paper</h2>
            <p>Masukkan jumlah botol Anda untuk mengetahui nilai tukarnya:</p>
            <input type="number" id="bottleInput" placeholder="Jumlah botol">
            <button class="button success" onclick="calculateValue()">Hitung</button>
            <div class="result" id="resultText"></div>
          </div>

          <!-- Statistik -->
          <div class="stats">
            <div class="card container-box-template-1">
              <h3>10 Kg</h3>
              <p>Home Papers</p>
            </div>
            <div class="card container-box-template-1">
              <h3>30 Kg</h3>
              <p>School Papers</p>
            </div>
            <div class="card container-box-template-1">
              <h3>50 Kg</h3>
              <p>Office Papers</p>
            </div>
          </div>
        </div>

        <!-- How It Works -->
        <section id="how" class="container" style="display: none">
          <h2>🌱 How It Works</h2>
          <p>3 steps to change your paper waste into economic value & environmentally friendly products:</p>
          <div class="steps">
            <div class="step container-box-template-1">
              <h3>1. Collect</h3>
              <p>Collect papers from home, school, office, or surrounding environment.</p>
            </div>
            <div class="step container-box-template-1">
              <h3>2. Exchange</h3>
              <p>Bring the papers to a nearest drop point to exchange it with recycled papers.</p>
            </div>
            <div class="step container-box-template-1">
              <h3>3. Recycle</h3>
              <p>Your papers will be processed into new recycled papers.</p>
            </div>
          </div>
        </section>

        <!-- Drop Points -->
        <section id="drop" class="container" style="display: none">
          <h2>📍 Drop Points</h2>
          <p>Cari lokasi terdekat untuk menukar botol Anda:</p>
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4896192643466!2d106.82688441532671!3d-6.200000995509408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMDAuMCJTIDEwNsKwNDknMzYuOCJF!5e0!3m2!1sid!2sid!4v1600000000000!5m2!1sid!2sid"
            allowfullscreen="" loading="lazy"></iframe>
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
