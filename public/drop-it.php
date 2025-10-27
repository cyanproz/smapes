<?php
require "site-config.php";
require "backend/init.php";
?>
<!DOCTYPE html>
<html lang="en" class="theme--light">
  <head>
    <?php include "partials/html-head.php"; ?>
    <link rel="stylesheet" href="styles/style-page-drop-it.css"/>
  </head>
  
  <body>
    <div id='page-header-contents-footer-layout'>
      <?php include "partials/page-navbar.php"; ?>
      
      <div id="page-contents">
        <!-- Hero -->
        <?php include "partials/page-header.php"; ?>

        <!-- Weight Your Paper -->
        <section class="container">
          <!-- Kalkulator -->
          <div class="calculator container-box-template-1">
            <h2>📄 Timbang Kertasmu</h2>
            <p>Masukkan berat limbah kertasmu untuk mengetahui berapa SMAPES Coins yang bisa ditukar:</p>
            <input type="number" id="paper-weight-input" placeholder="Berat kertas (gr)">
            <div class="result" id="smapes-coins-result-text"></div>
          </div>
        </section>
        
        <!-- Paper Exchange History -->
        <section class="container">
          <h2>Riwayat Penukaran Kertas</h2>
          
          <?php if ($auth->isLoggedIn()):?>
          <p>
            <?= $auth->isLoggedIn() ? "Hi, <strong>" . $auth->getUser()["username"] . "</strong>" : "Hi" ?>! Ini adalah
            riwayat pertukaran limbah kertasmu.
          </p>

          <table id="paper-exchange-history-table" class="styled style--1">
            <tbody>
              <tr>
                <td>
                  <div>
                    09/11/2025<br>
                    4000 gr → 100 SMAPES Coins<br>
                    AEON Mall Bandung
                  </div>
                </td>
              </tr>
              
              <tr>
                <td>
                  <div>
                    07/14/2025<br>
                    2000 gr → 50 SMAPES Coins<br>
                    SMP Hijau Bandung
                  </div>
                </td>
              </tr>
              
              <tr>
                <td>
                  <div>
                    04/30/2025<br>
                    3000 gr → 75 SMAPES Coins<br>
                    Gedung Sate
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <?php else: ?>
          <p>
            Kamu harus masuk dahulu untuk melihat riwayat penukaran kertas. <a href="./login.php">Masuk</a>
          </p>
          <?php endif; ?>
        </section>
        
        <!-- SMAPES Corners Locations -->
        <section id="drop" class="container">
          <h2>📍 Temukan SMAPES Corner Terdekatmu</h2>
          <p>Temukan corner terdekatmu untuk menukar limbahmu kertas:</p>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d832.6765166153554!2d107.61832995454884!3d-6.902638612750934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e64c5e8866e5%3A0x37be7ac9d575f7ed!2sGedung%20Sate!5e0!3m2!1sen!2sid!4v1759396659731!5m2!1sen!2sid"
            style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
      </div>

      <?php include "partials/page-footer.php"; ?>
    </div>

    <?php include "partials/chatbot.php"; ?>
    
    <script src="https://alif.prdn.net/common-script.js"></script>
    <script src="scripts/script-main.js"></script>
  </body>
</html>
