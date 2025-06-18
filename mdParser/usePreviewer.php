<?php
require_once __DIR__ . '/Parsedown.php';
require_once __DIR__ . '/previewer.php';

// Crear una instancia de Parsedown
$parser = new Parsedown();

// Markdown inicial (puede estar vacío si solo se usa el archivo)
$mdInicial = "";

// Crear una instancia de Previewer
$previewer = new Previewer($parser, $mdInicial);
$previewer->setArchivo('README.md');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central de Lenguajes</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.8.1/github-markdown-dark.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script> -->
    <!-- Prism CSS -->
    <link href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/previewer.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php
    require_once __DIR__ . '/../partials/navigationSite.php';
    ?>
    <div id="content">
        <?php
        require_once __DIR__ . '/../core/menuLink.php'; ?>
        <section class="previewermd markdown-body">
            <?php
            // Renderizar el Markdown del archivo mdExample.md
            try {
                $archivo = $_GET['md'] ?? 'README.md';
                $previewer->setArchivo($archivo);
                $view = $previewer->rendermd($archivo);
                echo $view;
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </section>
    </div>
    <!-- Prism JS + Autoloader -->
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-core.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>
</body>

</html>