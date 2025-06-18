<?php


?>
<link rel="stylesheet" href="../css/menuStyles.css">
<section class="navigation_site">
    <div id="menu--site">
        <?php
        require_once __DIR__ . '/../components/menu.php';
        ?>
    </div>
    <div id="login">
        <?php
        require_once __DIR__ . '/../login/viewSystem.php';
        ?>
    </div>
</section>