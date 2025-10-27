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
        <?php // include "partials/page-header.php"; ?>

        <section class="container">
          <h2>Pengaturan</h2>

          <tab-group id="settings-tab-group">
            <tab-page label="Akun" id="settings-tab-group__account">
              <h3>Akun</h3>

              <?php if ($auth->isLoggedIn()): ?>
              <div>
                <img src="images/default-pfp.png" alt="Profile" class="profile-pic" id="profileBtn">

                <div>
                  <h4><?= $auth->getUser()["username"] ?><?= $auth->getUser()["id"] == 1 ? " (Admin)" : "" ?></h4>
                  <div><?= $auth->getUser()["email"] ?></div>
                  <div>ID: 41679693</div><br>
                  <div><?= $auth->getUser()["smapes_coins"] ?> SMAPES Coin(s)</div>
                  <div>Dibuat saat: <?= $auth->getUser()["created_at"] ?></div>
                  <br>
                  <button>Ubah akun</button><br>
                  <button>Setel ulang password</button><br><br>
                  <button class="danger">Keluar</button><br>
                  <button class="danger">Hapus Akun</button>
                </div>
              </div>
              <?php else: ?>
              <p>   
                Kamu harus masuk dahulu untuk mengakses pengaturan akun. <a href="./login.php">Masuk</a>
              </p>
              <?php endif; ?>
            </tab-page>

            <tab-page label="Riwayat Belanja" id="settings-tab-group__shopping-history">
              <h3>Riwayat Belanja</h3>
              
              <?php if ($auth->isLoggedIn()): ?>
              <p>
                Halo <strong><?= $auth->getUser()["username"] ?></strong>! Ini adalah riwayat belanja dengan penggunaan
                SMAPES Coinsmu.
              </p>

              <table id="shopping-history-table" class="styled style--1">
                <tbody>
                  <tr>
                    <td>
                      <div>
                        <img src="images/catalog/2.jpg" alt="" srcset="" class="catalog-product-image">
                        <div>
                          Bingkai Foto ×2<br>
                          09/11/2025<br>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div>
                        <img src="images/catalog/4.jpg" alt="" srcset="" class="catalog-product-image">
                        <div>
                          Buku ×1<br>
                          07/14/2025<br>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <div>
                        <img src="images/catalog/1.jpg" alt="" srcset="" class="catalog-product-image">
                        <div>
                          Kertas ×5<br>
                          04/30/2025<br>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <?php else: ?>
              <p>   
                Kamu harus masuk dahulu untuk mengakses riwayat belanja. <a href="./login.php">Masuk</a>
              </p>
              <?php endif; ?>
            </tab-page>
          </tab-group>
        </section>
      </div>

      <?php include "partials/page-footer.php"; ?>
    </div>
    
    <?php include "partials/chatbot.php"; ?>

    <script src="https://alif.prdn.net/common-script.js"></script>
    <script src="scripts/script-main.js"></script>
    <script src="scripts/script-.js"></script>
  </body>
</html>
