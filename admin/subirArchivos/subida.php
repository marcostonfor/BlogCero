<?php
// Carpeta de destino segura con ruta absoluta
$dir_subida = realpath(__DIR__ . '/../../MD/Subidasmd');

if (!$dir_subida || !is_dir($dir_subida)) {
    die("❌ Carpeta de subida no válida.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichero_usuario'])) {
    $archivos = $_FILES['fichero_usuario'];
    $archivos_subidos_exitosamente = 0;
    if (empty($archivos['name'][0]) && $archivos['error'][0] == UPLOAD_ERR_NO_FILE) {
        die("⚠️ No se seleccionó ningún archivo para subir. Por favor, seleccione al menos un archivo .md.");
    }
    

        $num_archivos_seleccionados = count($archivos['name']);

        for ($i = 0; $i < $num_archivos_seleccionados; $i++) {
            // Saltar si este slot de archivo específico no tiene un archivo (error UPLOAD_ERR_NO_FILE)
            if ($archivos['error'][$i] === UPLOAD_ERR_NO_FILE) {
                continue;
            }

            // Comprobar errores de subida para el archivo actual
            if ($archivos['error'][$i] !== UPLOAD_ERR_OK) {
                die("❌ Error al subir el archivo '" . htmlspecialchars($archivos['name'][$i]) . "'. Código de error: " . $archivos['error'][$i]);
            }

            $nombre_archivo_original = $archivos['name'][$i];
            $tmp_nombre_archivo = $archivos['tmp_name'][$i];

            // Solo permitir archivos .md
            $extension = strtolower(pathinfo($nombre_archivo_original, PATHINFO_EXTENSION));
            if ($extension !== 'md') {
                die("❌ Solo se permiten archivos .md. El archivo '" . htmlspecialchars($nombre_archivo_original) . "' no es válido.");
            }

            // Limpiar el nombre del archivo
            $nombreLimpio = basename($nombre_archivo_original);
            if (empty($nombreLimpio) || $nombreLimpio === '.' || $nombreLimpio === '..') {
                die("❌ Nombre de archivo inválido después de la limpieza: '" . htmlspecialchars($nombre_archivo_original) . "'.");
            }
            $destino = $dir_subida . DIRECTORY_SEPARATOR . $nombreLimpio;

            // Mover el archivo subido
            if (move_uploaded_file($tmp_nombre_archivo, $destino)) {
                $archivos_subidos_exitosamente++;
            } else {
                die("⚠️ No se procesó ningún archivo válido. Asegúrese de que los archivos son .md y no hubo errores durante la subida.");
            }
        }
    }

    // Redirigir si se subieron archivos exitosamente
    if ($archivos_subidos_exitosamente > 0) {
        header("Location: subirArchivo.php?ok=" . $archivos_subidos_exitosamente);
        exit;
    } else {
        die("❌ No se pudo mover el archivo.");
    }

