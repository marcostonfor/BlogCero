<?php
/**
 * Barra de navegación principal del sitio.
 *
 * Este archivo se encarga de construir y mostrar la barra de navegación
 * completa del sitio. Incluye el menú de navegación principal,
 * los iconos de redes sociales y el panel de inicio de sesión o
 * información del usuario.
 *
 * @package     BlogCero
 * @subpackage  Partials
 * @since       1.0.0
 */

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