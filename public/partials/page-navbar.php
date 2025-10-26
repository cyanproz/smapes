      <header id='page-header'>
        <nav style='display: inline-flex; white-space: nowrap;'>
          <!-- <button id="hamburger-menu-button" class="page-header-button" style="display: flex;" onclick="collapseExpandMainSidebar();" onmouseenter="CommonLib.showTooltip(event, 'Menu');">
            <span class="icon material-symbols-outlined" style="display: flex; align-items: center; user-select: none;" onclick="event.preventDefault();">
              menu
            </span>
          </button> -->

          <label id='hamburger-menu-button' class="page-header-button" onmouseenter="CommonLib.showTooltip(event, 'Menu');">
            <input style='display: none;' type='checkbox'/>
            <span class='icon material-symbols-outlined'>
              menu
            </span>
          </label>

          <!-- <span class="page-header-item" onmouseenter="CommonLib.showTooltip(event, 'Smart Paper Waste');">
            <span class="text">
              SMAPES
            </span>
          </span> -->
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

          <div style="display: none;">
            <!-- <button class='page-header-button' id='cyanproz-button'><a expr:href='data:blog.homepageUrl' style='text-decoration: none;'></a></button> -->
            <!-- <div style="user-select: none; display: inline; padding: 12px;">CyanProz's Blog</div> -->
            <button id='skip-navigation-button' tabindex='0'>Skip Navigation</button>
            <!-- <div style="display: inline; padding: 10px;"></div> -->
            <div class='page-header-dropdown'>
              <button class='page-header-button page-header-dropdown-button'>
                <span>Home</span>
                <!-- <div class="page-header-dropdown-menu">
                  <a class="page-header-dropdown-item" tabindex="0" href="Downloads">Apps & Downloads</a>
                  <*!__ <hr class="Separator"> __*>
                  <a class="page-header-dropdown-item" tabindex="0" href="CSharp.html">About</a>
                </div> -->
                <div class='page-header-dropdown-menu'>
                  <ul>
                    <li class='page-header-dropdown-item'><a href='?indexpage=blog' tabindex='0'>Blog</a></li>
                    <li class='page-header-dropdown-item'><a href='/p/products.html' tabindex='0'>Products</a></li>
                    <li class='page-header-dropdown-item'><a href='CSharp_Documentation/' tabindex='0'>About</a></li>
                  </ul>
                </div>
              </button>
            </div>
            <div class='page-header-dropdown'>
              <button class='page-header-button page-header-dropdown-button'>
                <span>Coding</span>
                <div class='page-header-dropdown-menu'>
                  <ul>
                    <li class='page-header-dropdown-item'><a href='CSharp_Documentation/' tabindex='0'>C#</a></li>
                    <li class='page-header-dropdown-item'><a href='Products/Idk.txt' tabindex='0'>Web Development</a></li>
                    <li class='page-header-dropdown-item'><a href='' tabindex='0'>Assembly</a></li>
                    <li class='page-header-dropdown-item'><a href='' tabindex='0'>Hello</a></li>
                  </ul>
                </div>
              </button>
            </div>
            <div class='page-header-dropdown'>
              <button class='page-header-button page-header-dropdown-button'>
                <span>Tools</span>
                <div class='page-header-dropdown-menu'>
                  <ul>
                    <li class='page-header-dropdown-item'><a href='?page=website_lab' tabindex='0'>Website Lab</a></li>
                  </ul>
                </div>
              </button>
            </div>
            <div class='page-header-dropdown'>
              <button class='page-header-button page-header-dropdown-button'>
                <span>Games</span>
                <div class='page-header-dropdown-menu'>
                  <ul>
                    <li class='page-header-dropdown-item'><a>brhfiofdjiof</a></li>
                  </ul>
                </div>
              </button>
            </div>
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
                <!-- <button id="openProfilePopup">Change Profile Picture</button>
                <button id="openPasswordPopup">Change Password</button> -->
                <a href="./settings.php" class="button-link">
                  <span class="icon icon--left material-symbols-outlined">settings</span>
                  Pengaturan
                </a>
                <!-- <a href="./settings.php" class="button-link">
                  <span class="icon icon--left material-symbols-outlined">person</span>
                  Akun
                </a> -->
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

          <!-- <div style="display: inline-grid; position: relative; ">
            <input id="Header_Search_Box" type="text" placeholder="Search">
          </div> -->
          <!-- <button class='page-header-button dropdown-button under-construction-button' title='This blog is currently under construction. It may take a while to complete. Press Shift+R or Ctrl+Shift+F5 to see changes based on styles &amp; scripts for this site'><span>&#9888;&#65039; Under Construction &#9888;&#65039;</span></button> -->
        </nav>
      </header>
