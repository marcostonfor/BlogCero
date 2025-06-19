<?php
/**
 * Muestra los iconos de redes sociales en la cabecera.
 *
 * Este script incluye y utiliza la clase PublishIconSocialMedia para generar
 * y mostrar la lista de iconos de redes sociales configurados en el sistema.
 * También enlaza la hoja de estilos de Font Awesome para la visualización de los iconos.
 *
 * @package     BlogCero
 * @subpackage  Partials
 * @since       1.0.0
 */
require_once __DIR__ . '/../admin/socialMedia/publishIconSocialMedia.php';
$iconList = new PublishIconSocialMedia();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<aside class="social-media">
<?php echo $iconList->publish(); ?>
</aside> 