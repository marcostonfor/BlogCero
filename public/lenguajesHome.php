<?php
session_start();
require_once __DIR__ . '/../components/header.php';
require_once __DIR__ . '/../components/css/headerStyles.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>marcosweb!Lenguajes HOME</title>
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <?php echo HeaderStyles::styles(); ?>
    <link rel="stylesheet" href="../components/css/menuStyles.css">
    <link rel="stylesheet" href="../login/css/style.css">
    <link rel="stylesheet" href="../login/scripts/partials/css/login_control.css">
    <style>
        
    </style>
</head>

<body>
    
    <?php
    require_once __DIR__ . '/../partials/navigationSite.php';
    echo (new Header())->headerSite;
    ?>
    <main>
        <section style="position: relative; width: 85%; margin: auto auto; border: 0.2rem solid black;">


        </section>
    </main>
</body>

</html>