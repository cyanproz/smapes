<?php
require "site-config.php";
require "backend/init.php";
?>
<!DOCTYPE html>
<html lang="en" class="theme--light">
  <head>
    <?php include "partials/html-head.php"; ?>
    <link rel="stylesheet" href="styles/style-page-catalog.css"/>
  </head>
  
  <body>
    <div id='page-header-contents-footer-layout'>
      <?php include "partials/page-navbar.php"; ?>
      
      <div id="page-contents">
        <!-- Hero -->
        <?php include "partials/page-header.php"; ?>

        <!-- Catalog -->
        <section class="container">
          <h2>Katalog</h2>

          <p>
            <?= $auth->isLoggedIn() ? "Hi, <strong>" . $auth->getUser()["username"] . "</strong>" : "Hi" ?>! Kamu bisa
            menukarkan SMAPES Coinsmu dengan berbelanja di sini! Caranya mudah, kamu tinggal tunjukkan pada SMAPES
            Warrior di SMAPES Corner berapa banyak SMAPES Coins yang kamu punya dan ingin kamu tukarkan dengan item-item
            di katalog ini! Kamu bisa menukarkannya dengan berbelanja di SMAPES Corner langsung ya!
          </p>

          <div id="shopping-item-list">
            <?php foreach ($pdo->query("SELECT * FROM store_items") as $item): ?>
            <a class="button-link shopping-item" href="catalog-item-details.php?item=<?= $item["slug"] ?>">
              <img src="images/catalog/<?= $item["id"] ?>.jpg" alt="" srcset="" class="catalog-product-image">
              <div>
                <h6 class="title"><?= $item["name"] ?></h4>
                <h5 class="price">
                  <?= $item["price_cash"] == 0 ? "Gratis" : "Rp. " . $item["price_cash"] ?> +
                  <?= $item["price_coins"] ?> S. Coins
                </h3>
              </div>
            </a>
            <?php endforeach; ?>
          </div>
        </section>
      </div>

      <?php include "partials/page-footer.php"; ?>
    </div>

    <?php include "partials/chatbot.php"; ?>

    <script src="https://alif.prdn.net/common-script.js"></script>
    <script src="scripts/script-main.js"></script>
  </body>
</html>
