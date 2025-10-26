<?php
require "site-config.php";
require "backend/init.php";

// // Handle Logout
// if (isset($_POST['logout'])) {
//   $auth->logout();

//   // Destroy session
//   session_unset();
//   session_destroy();
// }

// // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// //   // Process your form
// //   // e.g., login, save to DB, etc.
  
// //   // Then redirect
// //   header("Location: " . $_SERVER['PHP_SELF']);
// //   exit;
// // }

// $invalidLogin = true;

// // Handle login
// if ($_POST && isset($_POST['username'], $_POST['password'])) {
//   if ($auth->login($_POST['username'], $_POST['password'])) {
//     // echo "Welcome, ";
//     header("Location: .");
//     exit;
//   } else {
//     echo "Invalid login!";
//   }
// }
?>
<!DOCTYPE html>
<html lang="en" class="theme--light">
  <head>
    <?php include "partials/html-head.php"; ?>
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
      
      <div id="page-contents">
        <form id="auth-form" class="container-box-template-1" action="" method="POST">
          <h2>Masuk</h2>

          <div id="auth-form-error-message"></div>
          
          <div class="input-box">
            <span class="input-box-icon">
              <span class="icon icon--1-5rem material-symbols-outlined">person</span>
            </span>

            <input type="text" tabindex="1" name="username" placeholder="Username" required>
          </div>
          
          <div class="input-box">
            <button type="button" tabindex="3" title="Tampilkan Password" id="show-password-button" class="success input-box-icon">
              <span class="icon icon--1-5rem material-symbols-outlined">lock</span>
            </button>

            <input type="password" tabindex="2" name="password" id="password-input" placeholder="Password" required>
            <!-- <label id="show-password-label">
              <input type="checkbox" name="" id="show-password-checkbox">
              Tampilkan password
            </label> -->
          </div>
          
          <button type="submit" name="login" tabindex="4" id="submit-button" class="success">Masuk</button>

          <div style="margin-top">Belum punya akun? <a href="register.php">Daftar</a></div>
        </form>
      </div>

      <?php include "partials/page-footer.php"; ?>
    </div>

    <script src="https://alif.prdn.net/common-script.js"></script>
    <script src="scripts/script-main.js"></script>
    <script src="scripts/script-auth.js"></script>
  </body>
</html>
