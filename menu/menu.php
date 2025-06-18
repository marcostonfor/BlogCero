<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu con php</title>
    
</head>

<body>
    <aside>
        <nav>
            <ul>
                <li><a href="../public/lenguajesHome.php">Home</a></li>
                <li><a href="usePreviewer.php?md=README.md">Central de Lenguajes</a></li>
                <li>
                    <hr>
                </li>
                <li class="submenu">
                    &#x1F4C1;../ &#x21a9; Javascript
                    <ul class="hidemenu">
                        <li><a href="usePreviewer.php?md=Javascript/README.md">Inicio</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    &#x1F4C1;../ &#x21a9; PHP
                    <ul class="hidemenu">
                        <li><a href="usePreviewer.php?md=PHP/README.md">Inicio</a></li>
                        <li><a href="usePreviewer.php?md=PHP/variables.md">variables</a></li>
                        <li><a href="usePreviewer.php?md=PHP/variables_variables.md">Variables variables</a></li>
                        <li class="sub-menu">
                           &#x1F4C1;../ &#x21a9; <a href="usePreviewer.php?md=PHP/tipos_de_datos.md">Tipo de datos</a>
                           <ul class="hide-menu">
                            <li><a href="usePreviewer.php?md=PHP/tiposDatos/entero.md">Tipo entero</a></li>
                           </ul> 
                        </li>
                    </ul>
                </li>
                <li class="submenu">
                    &#x1F4C1;../ &#x21a9; Java
                    <ul class="hidemenu">
                        <li><a href="usePreviewer.php?md=Java/README.md">Inicio</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
</body>

</html>