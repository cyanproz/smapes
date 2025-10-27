<?php
require "site-config.php";
require "backend/init.php";
?>
<!DOCTYPE html>
<html lang="en" class="theme--light">
  <head>
    <?php include "partials/html-head.php"; ?>
  </head>
  
  <body>
    <div id='page-header-contents-footer-layout'>
      <?php include "partials/page-navbar.php"; ?>
      
      <div id="page-contents">
        <form id="auth-form" class="container-box-template-1" action="" method="POST">
          <h2>Daftar</h2>

          <div id="auth-form-error-message"></div>
          
          <div class="input-box">
            <span class="input-box-icon">
              <span class="icon icon--1-5rem material-symbols-outlined">person</span>
            </span>

            <input type="text" tabindex="1" name="username" id="input-username" placeholder="Username" required>
            
            <div id="username-verification-message" class="input-box-message error"></div>
          </div>
          
          <div class="input-box">
            <span class="input-box-icon">
              <span class="icon icon--1-5rem material-symbols-outlined">article_person</span>
            </span>

            <input type="text" tabindex="2" name="fullname" id="input-fullname" placeholder="Nama Lengkap" required>
            
            <div id="username-verification-message" class="input-box-message error"></div>
          </div>
          
          <div class="input-box">
            <span class="input-box-icon">
              <span class="icon icon--1-5rem material-symbols-outlined">mail</span>
            </span>
            
            <input type="email" tabindex="3" name="email" id="input-email" placeholder="Email" required>
            
            <div id="username-verification-message" class="input-box-message error"></div>
          </div>
          
          <div class="input-box">
            <button type="button" tabindex="5" title="Tampilkan Password" id="show-password-button" class="success input-box-icon">
              <span class="icon icon--1-5rem material-symbols-outlined">lock</span>
            </button>

            <input type="password" tabindex="4" name="password" id="password-input" placeholder="Password" required>
          </div>
          
          <button type="submit" name="register" tabindex="4" id="submit-button" class="success">Daftar</button>

          <div style="margin-top">Sudah punya akun? <a href="login.php">Masuk</a></div>
        </form>
      </div>

      <?php include "partials/page-footer.php"; ?>
    </div>

    <script src="https://alif.prdn.net/common-script.js"></script>
    <script src="scripts/script-main.js"></script>
    <script src="scripts/script-auth.js"></script>
  </body>
</html>
