<?php
$baseDir = '../MD'; // carpeta raíz donde están los .md

function generarMenuRecursivo($directorio, $rutaRelativa = '')
{
    $html = "<ul>";
    $items = scandir($directorio);

    foreach ($items as $item) {
        if ($item === '.' || $item === '..' || ($item === 'Subidasmd' && $directorio === $GLOBALS['baseDir'])) {
            continue;
        }
        $rutaAbsoluta = $directorio . '/' . $item;
        $rutaRelativaCompleta = ltrim($rutaRelativa . '/' . $item, '/');

        if (is_dir($rutaAbsoluta)) {
            $html .= "<li><strong>$item</strong>";
            $html .= generarMenuRecursivo($rutaAbsoluta, $rutaRelativaCompleta);
            $html .= "</li>";
        } elseif (is_file($rutaAbsoluta)) {
            // Si es .md, enviar a usePreviewer.php
            if (preg_match('/\.md$/i', $item)) {
                $url = 'usePreviewer.php?md=' . urlencode($rutaRelativaCompleta);
            } else {
                // Para otros archivos podrías usar ruta directa o dejarlo vacío
                $url = '?ruta=' . urlencode($rutaRelativaCompleta);
            }
            $html .= "<li><a href=\"$url\">$item</a></li>";
        }
    }

    $html .= "</ul>";
    return $html;
}

echo generarMenuRecursivo($baseDir);
