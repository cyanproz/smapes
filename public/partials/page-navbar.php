      <header id="page-header">
        <nav style="display: inline-flex; white-space: nowrap;">
          <label id="hamburger-menu-button" class="page-header-button" onmouseenter="CommonLib.showTooltip(event, 'Menu');">
            <input style="display: none;" type="checkbox"/>
            <span class="icon material-symbols-outlined">
              menu
            </span>
          </label>

          <a href="." id="page-header-page-title" class="page-header-item" onmouseenter="CommonLib.showTooltip(event, 'Smart Paper Waste');">
            <span class="text">
              SMAPES
            </span>
          </a>

          <?php
            $pages = ["", "about.php", "drop-it.php", "catalog.php"];
            $uri = $_SERVER['REQUEST_URI'];
            $selectedSidebarButton = [];

            foreach ($pages as $page) {
              $selectedSidebarButton[] = $uri === "$indexPage/$page" ? " selected" : "";
            }
          ?>

          <div class="menu">
            <a href="./about.php" class="page-header-item<?= $selectedSidebarButton[1] ? " page--active" : "" ?>" onmouseenter="CommonLib.showTooltip(event, 'Tentang');">
              <span class="text">
                Tentang
              </span>
            </a>
            
            <a href="./drop-it.php" class="page-header-item<?= $selectedSidebarButton[2] ? " page--active" : "" ?>" onmouseenter="CommonLib.showTooltip(event, /*'Drop Your Papers'*/'Timbang Sampahmu');">
              <span class="text">
                <!-- Drop It -->
                Timbang
              </span>
            </a>
            
            <a href="./catalog.php" class="page-header-item<?= $selectedSidebarButton[3] ? " page--active" : "" ?>" onmouseenter="CommonLib.showTooltip(event, 'Katalog');">
              <span class="text">
                Katalog
              </span>
            </a>
          </div>
        </nav>

        <nav style='display: inline-flex; white-space: nowrap;'>
          <div class="page-header-item" id="page-header-user-info" style="<?= $auth->isLoggedIn() ? "" : "display: none;" ?>">
            <span class="text"><?= $auth->isLoggedIn() ? $auth->getUser()["username"] : $auth->isLoggedIn() ?></span>
            <img src="images/default-pfp.png" alt="Profile" class="profile-pic" id="profileBtn">

            <div class="profile-wrapper">

              <div class="floating-bar container-box-template-1 hidden" id="floatingBar">
                <div class="profile-brief">
                  <img src="images/default-pfp.png" alt="Profile" class="profile-pic">
                  <div>
                    <div><strong><?= $auth->isLoggedIn() ? $auth->getUser()["username"] : "N/A" ?></strong></div>
                    <div><?= $auth->isLoggedIn() ? $auth->getUser()["smapes_coins"] : "N/A" ?> Coin(s)</div>
                  </div>
                </div>
                
                <a href="./settings.php" class="button-link">
                  <span class="icon icon--left material-symbols-outlined">settings</span>
                  Pengaturan
                </a>
                
                <button onclick="logoutUser(false);" class="danger">
                  <span class="icon icon--left material-symbols-outlined">logout</span>
                  Keluar
                </button>
              </div>
            </div>
          </div>
          
          <?php if (!$auth->isLoggedIn()): ?>
          <a href="./login.php" class="page-header-item" onmouseenter="CommonLib.showTooltip(event, 'Masuk');">
            <span class="text">
              Masuk
            </span>
          </a>
          <?php endif; ?>
        </nav>
      </header>
