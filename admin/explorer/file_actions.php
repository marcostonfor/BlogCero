<?php
$data = json_decode(file_get_contents("php://input"), true);
$action = $data['action'];
$path = $data['path'];
$newName = $data['newName'] ?? null;

switch ($action) {
    case 'create_file':
        $newFile = $path . DIRECTORY_SEPARATOR . 'nuevo_archivo.txt';
        if (!file_exists($newFile)) {
            file_put_contents($newFile, '');
            echo "Archivo creado.";
        } else {
            echo "Ya existe.";
        }
        break;

    case 'create_folder':
        $newFolder = $path . DIRECTORY_SEPARATOR . 'nueva_carpeta';
        if (!file_exists($newFolder)) {
            mkdir($newFolder);
            echo "Carpeta creada.";
        } else {
            echo "Ya existe.";
        }
        break;

    case 'rename':
        if ($newName) {
            $newPath = dirname($path) . DIRECTORY_SEPARATOR . $newName;
            if (rename($path, $newPath)) {
                echo "Renombrado correctamente.";
            } else {
                echo "Error al renombrar.";
            }
        }
        break;

    case 'delete':
        if (is_dir($path)) {
            if (rmdir($path)) {
                echo "Carpeta eliminada.";
            } else {
                echo "No se pudo eliminar carpeta (¿vacía?).";
            }
        } else {
            if (unlink($path)) {
                echo "Archivo eliminado.";
            } else {
                echo "No se pudo eliminar archivo.";
            }
        }
        break;

    default:
        echo "Acción no válida.";
}
