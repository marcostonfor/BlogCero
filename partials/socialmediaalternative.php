<?php

$redes = [
    'facebook' => "<i style='font-size:24px' class='fa'>&#xf082;</i>",
    'twitter' => "<i style='font-size:24px' class='fa'>&#xf099;</i>"
];
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<aside class="social-media">
    <ul>
        <?php foreach ($redes as $nombre => $icono): ?>
            <li>
                <a href="#">
                    <?php echo $icono;
                    ucfirst($nombre) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</aside>