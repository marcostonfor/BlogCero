<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorador de archivos</title>
</head>

<body>
    <?php
    require_once __DIR__ . '/file_explorer.php';
    $viewExplorer = new File_explorer();
    echo $viewExplorer->explorer_body($viewExplorer->currentDir, $viewExplorer->items);
    ?>
</body>

</html>