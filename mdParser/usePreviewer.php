<?php
/**
 * Script para visualizar archivos Markdown utilizando la clase Previewer.
 *
 * Este archivo se encarga de:
 * - Incluir las clases necesarias (Parsedown, Previewer).
 * - Instanciar Parsedown y Previewer.
 * - Determinar qué archivo Markdown mostrar, ya sea a través de un parámetro GET 'md'
 *   o utilizando 'README.md' como valor predeterminado.
 * - Renderizar el archivo Markdown a HTML utilizando la clase Previewer.
 * - Mostrar el HTML resultante dentro de una estructura de página web,
 *   incluyendo navegación del sitio, un menú lateral y estilos para el contenido Markdown
 *   y resaltado de sintaxis con Prism.js.
 * - Manejar excepciones que puedan ocurrir durante el proceso de renderizado.
 *
 * @package     BlogCero
 * @subpackage  MarkdownParser
 * @since       1.0.0
 *
 * @uses Parsedown Para la conversión básica de Markdown a HTML.
 * @uses Previewer Para la lógica de carga y renderizado de archivos Markdown, incluyendo la reescritura de enlaces.
 */
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
    /**
     * Inclusión de la barra de navegación principal del sitio.
     */
    require_once __DIR__ . '/../partials/navigationSite.php';
    ?>
    <div id="content">
        <?php
        /**
         * Inclusión del menú lateral específico para la sección de previsualización.
         * Probablemente contiene enlaces a diferentes archivos Markdown.
         */
        require_once __DIR__ . '/../core/menuLink.php'; ?>
        <section class="previewermd markdown-body">
            <?php
             /**
             * Lógica para determinar el archivo Markdown a renderizar.
             * Intenta obtener el nombre del archivo del parámetro GET 'md'.
             * Si no se proporciona, utiliza 'README.md' como valor predeterminado.
             * Llama al método rendermd() de la instancia de Previewer y muestra el resultado.
             * Captura y muestra cualquier excepción que ocurra durante el proceso.
             */
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