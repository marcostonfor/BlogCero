<?php


?>
<link rel="stylesheet" href="../css/menuStyles.css">
<link rel="stylesheet" href="../css/socialmedia.css">
<section class="navigation_site">
    <div id="menu-site">
        <?php
        require_once __DIR__ . '/../components/menu.php';
        ?>
    </div>
    <span id="social-media">
        <?php
        require_once __DIR__ . '/socialMediaInHeader.php';
        ?>
    </span>
    <div id="login">
        <?php
        require_once __DIR__ . '/../login/viewSystem.php';
        ?>
    </div>
</section>