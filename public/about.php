<?php
require "site-config.php";
require "backend/init.php";
?>
<!DOCTYPE html>
<html lang="en" class="theme--light">
  <head>
    <?php include "partials/html-head.php"; ?>
    <link rel="stylesheet" href="styles/style-page-about.css"/>
  </head>
  
  <body>
    <div id='page-header-contents-footer-layout'>
      <?php include "partials/page-navbar.php"; ?>
      
      <div id="page-contents">
        <!-- Hero -->
        <?php include "partials/page-header.php"; ?>

        <section>
          <div id="about-page-carousel" class="carousel carousel--card owl-carousel">
            <section id="sect--about" class="item container container-box-template-1d">
              <img src="images/logo-transparent.png" alt="" srcset="">

              <div>
                <h2>Tentang</h2>
                <p>
                  SMAPES adalah sebuah solusi cerdas dalam memanfaatkan limbah kertas, yaitu dengan cara mengumpulkan
                  limbah-limbah kertas dari berbagai tempat seperti rumah tangga, kantor, sekolah, rumah sakit, mall,
                  atau berbagai tempat lainnya. Sampah dikumpulkan di tiap <strong>SMAPES Corner</strong>, kemudian
                  dipilah dan ditimbang oleh <strong>SMAPES Warrior</strong>. Beratnya limbah kertas akan menentukan
                  banyaknya <strong>SMAPES Coins</strong> yang akan kamu dapatkan.
                </p>
              </div>
            </section>

            <section id="sect--smapes-corner" class="item container container-box-template-1d">
              <img src="images/about/smapes-corner.jpg" alt="" srcset="">

              <div>
                <h2>Apa Itu <em>SMAPES Corner</em>?</h2>
                <p>
                  <strong>SMAPES Corner</strong> adalah tempat dimana limbah sampah dikumpulkan, dipilah, dan ditimbang.
                  Limbah kertas juga dapat didaur ulang di <strong>SMAPES Corner</strong>. Selain itu juga ada etalase
                  barang-barang yang sudah didaur ulang dari limbah kertas yang dikumpulkan yang dapat ditukarkan dan
                  dibeli dengan menggunakan <strong>SMAPES Coins</strong>.
                </p>
                <p>
                  Kamu bisa menemukan <strong>SMAPES Corner</strong> di tempat-tempat berikut ini:
                  <ul>
                    <li>AEON Mall Bandung</li>
                    <li>Gedung Sate</li>
                    <li>Kampus ITB Tamansari Bandung</li>
                    <li>Taman Lansia Bandung</li>
                    <li>SMP Hijau Bandung</li>
                  </ul>
                </p>
              </div>
            </section>

            <section id="sect--smapes-coins" class="item container container-box-template-1d">
              <img src="images/about/smapes-coin.png" alt="" srcset="">

              <div>
                <h2>Apa Itu <em>SMAPES Coins</em>?</h2>
                <p>
                  <strong>SMAPES Coins</strong> adalah koin digital yang didapatkan oleh <strong>SMAPES Buddy</strong>
                  setiap menukarkan limbah kertas yang dapat didaur ulang dalam jumlah tertentu.
                  <strong>SMAPES Coins</strong> dapat ditukar dan dibelanjakan di <strong>SMAPES Shop</strong>.
                </p>
                <p>
                  Tiap <strong>2000 gr</strong> limbah kertas yang layak didaur ulang dapat ditukarkan dengan
                  <strong>50 SMAPS Coins</strong> dan berlaku kelipatannya.
                </p>
              </div>
            </section>

            <section id="sect--smapes-warrior" class="item container container-box-template-1d">
              <img src="images/about/smapes-warrior.jpg" alt="" srcset="">

              <div>
                <h2>Siapa Itu <em>SMAPES Warrior</em>?</h2>
                <p>
                  <strong>SMAPES Warrior</strong> adalah sebutan untuk orang-orang yang membantu mengelola limbah kertas
                  dan mendaur ulangnya di <strong>SMAPES Corner</strong>.
                </p>
                <p>
                  <strong>SMAPES Warrior</strong> juga akan membantumu memilah limbah, menimbangnya, memberikan
                  <strong>SMAPES Coins</strong> dan memasukkannya ke dalam data akunmu, sekaligus membantumu dalam
                  menukarkan <strong>SMAPES Coins</strong>-mu dan membelanjakannya dengan barang-barang di Katalog.
                </p>
              </div>
            </section>

            <section id="sect--smapes-buddy" class="item container container-box-template-1d">
              <img src="images/about/smapes-buddies.jpg" alt="" srcset="">

              <div>
                <h2>Siapa Itu <em>SMAPES Buddy</em>?</h2>
                <p>
                  <strong>SMAPES Buddy</strong> adalah kamu! Ya, kamu! Kamu yang peduli dengan lingkunganmu serta mau
                  mengolah limbah kertasmu dengan baik bersama kami. 😃
                </p>
              </div>
            </section>

            <section id="sect--why-smapes" class="item container container-box-template-1d">
              <div>
                <h2>Kenapa SMAPES?</h2>
                <p>
                  <strong>SMAPES</strong> dibuat sebagai wujud kepedulian terhadap kebersihan lingkungan di sekitar
                  kita. Limbah kertas merupakan salah satu limbah terbanyak selain limbah plastik dan limbah makanan.
                  Kami menawarkan solusi pintar agar semua orang dapat berkontribusi untuk mengurangi limbah kertas.
                  Harapan kami dengan mengurangi perputaran kertas yang ada, juga dapat mengurangi aktifitas penebangan
                  hutan yang biasanya juga berdampak terhadap pencemaran lingkungan.
                </p>
              </div>
            </section>
          </div>
        </section>

        <section class="container">
          <video width="auto" class="tips-video" autoplay muted>
            <source src="videos/5-langkah-mudah-olah-limbah-kertas.mp4" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </section>
      </div>

      <?php include "partials/page-footer.php"; ?>
    </div>
    
    <?php include "partials/chatbot.php"; ?>
    
    <script src="https://alif.prdn.net/common-script.js"></script>
    <script src="scripts/script-main.js"></script>
  </body>
</html>
