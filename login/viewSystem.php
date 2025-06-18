<?php
session_start();
require_once __DIR__ . '/scripts/partials/login_control.php';

$login_control = new Login_control();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../login/css/style.css">
    <link rel="stylesheet" href="../login/scripts/partials/css/login_control.css">
    <link rel="stylesheet" href="../login/css/normalize.css">
</head>

<body>
    <aside id="system__login">

        <?php
        // var_dump($_SESSION);
        if (!empty($_SESSION['nombre__usuario']) || !empty($_SESSION['email'])): ?>
            <?php            
            $nombre__usuario = htmlspecialchars($_SESSION['nombre__usuario']);
            echo "<div id='login_control'>";
            echo "<h3>Bienvenido usuario $nombre__usuario </h3>" . $login_control->control();
            echo "</div>";
            ?>           
        <?php else: ?>
            <h6 class="caja_inicio_de_sesion">Por favor, <a href="../login/scripts/viewRegisterForm.php">Registrese</a> o <a href="../login/scripts/viewLoginForm.php">acceda</a></h6>
         <?php endif; ?>
    </aside>
</body>

</html>