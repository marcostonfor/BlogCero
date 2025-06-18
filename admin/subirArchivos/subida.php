<?php
// Carpeta de destino segura con ruta absoluta
$dir_subida = realpath(__DIR__ . '/../../Subidasmd');

if (!$dir_subida || !is_dir($dir_subida)) {
    die("❌ Carpeta de subida no válida.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichero_usuario'])) {
    $archivo = $_FILES['fichero_usuario'];

    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        die("❌ Error al subir archivo: " . $archivo['error']);
    }

    // Solo permitir archivos .md
    $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
    if ($extension !== 'md') {
        die("❌ Solo se permiten archivos .md");
    }

    $nombreLimpio = basename($archivo['name']);
    $destino = $dir_subida . DIRECTORY_SEPARATOR . $nombreLimpio;

    if (move_uploaded_file($archivo['tmp_name'], $destino)) {
        header("Location: subirArchivo.php?ok=1");
        exit;
    } else {
        die("❌ No se pudo mover el archivo.");
    }
} else {
    die("⚠️ No se ha enviado ningún archivo.");
}
