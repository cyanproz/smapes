<?php
require "site-config.php";
require "backend/init.php";
?>
<!DOCTYPE html>
<html lang="en" class="theme--light">
  <head>
    <?php include "partials/html-head.php"; ?>
    <link rel="stylesheet" href="styles/style-page-catalog-item-details.css"/>
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
        <!-- Hero -->
        <?php include "partials/page-header.php"; ?>
        
        <section class="container">
          <div style="margin-bottom: 1em;">
            <!-- <a href="catalog.php" class="button-link">
              <span class='icon material-symbols-outlined'>
                arrow_back
              </span>
            </a> -->
            <a href="catalog.php" class="button-link" style="display: inline-flex; align-items: center;">
              <span class="icon icon--left material-symbols-outlined">
                arrow_back_ios_new
              </span>
              Kembali
            </a>
          </div>

          <?php
            $itemSlug = $_GET["item"] ?? '';

            $stmt = $pdo->prepare("SELECT * FROM store_items WHERE slug = ?");
            $stmt->execute([$itemSlug]);
            $item = $stmt->fetch(PDO::FETCH_ASSOC);
          ?>

          <?php if (isset($_GET["item"])): ?>
          <div id="catalog-item-details">
            <img src="images/catalog/<?= $item["id"] ?>.jpg" alt="" srcset="" class="catalog-product-image">
            <div class="catalog-product-details">
              <h2><?= $item["name"] ?></h2>
              <p>
                <?= $item["description"] ?>
              </p>
              <h3 class="price">
                <?= $item["price_cash"] == 0 ? "Gratis" : "Rp. " . $item["price_cash"] ?> +
                <?= $item["price_coins"] ?> S. Coins
              </h3>
            </div>
          </div>
          <?php endif; ?>
        </section>
      </div>

      <?php include "partials/page-footer.php"; ?>
    </div>

    <?php include "partials/chatbot.php"; ?>

    <script src="https://alif.prdn.net/common-script.js"></script>
    <script src="scripts/script-main.js"></script>
  </body>
</html>