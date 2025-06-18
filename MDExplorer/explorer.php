<?php
$directorioRaíz = realpath(__DIR__ . '/../MD/Subidasmd');
$directorioDestinoBase = realpath(__DIR__ . '/../MD');

if (!$directorioRaíz || !is_dir($directorioRaíz)) {
    die("❌ Carpeta de origen no válida no válida.");
}

if (!$directorioDestinoBase || !is_dir($directorioDestinoBase)) {
    die("❌ Carpeta de destino base no válida.");
}
function limpiarRuta($ruta)
{
    // Elimina barras iniciales/finales y sanitiza componentes
    $ruta = trim($ruta, '/\\');
    if ($ruta === '') {
        return ''; // Retorna cadena vacía si solo había barras
    }

    $partes = explode('/', $ruta);
    $partesLimpias = [];
    foreach ($partes as $parte) {
        // Omite partes vacías (de barras múltiples) y '.' o '..'
        if ($parte === '' || $parte === '.' || $parte === '..') {
            continue;
        }
        // Opcional: Añadir validación más estricta para caracteres permitidos
        // if (!preg_match('/^[a-zA-Z0-9_-]+$/', $parte)) {
        //     continue; // Omite partes con caracteres inválidos
        // }
        $partesLimpias[] = $parte;
    }
    return implode('/', $partesLimpias);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $path = limpiarRuta($_POST['path'] ?? ''); // Subdirectorio de destino dentro de MD/
    $nombre = trim($_POST['nombre'] ?? ''); // Nombre del archivo a mover desde Subidasmd/
    $tipo = $_POST['tipo'] ?? '';

    if ($nombre === '' || !in_array($tipo, ['archivo'])) {
        die("Parámetros inválidos.");
    }

    $rutaOrigen = $directorioRaíz . '/' . $nombre;
    $rutaOrigenReal = realpath($rutaOrigen);
    if ($rutaOrigenReal === false || dirname($rutaOrigenReal) !== $directorioRaíz || !is_file($rutaOrigenReal)) {
        die("Archivo de origen no válido o no encontrado.");
    }

    // Construir la ruta completa del directorio de destino prevista
    $intendedDestDir = $directorioDestinoBase;
    if ($path !== '') {
        $intendedDestDir .= '/' . $path;
    }

    // Seguridad: Verificar que el directorio de destino previsto está dentro del directorio base de destino
    // Obtener la ruta real del directorio de destino previsto
    $realDestDir = realpath($intendedDestDir);

    // Verificar si realpath tuvo éxito y si la ruta real comienza con la ruta base de destino
    // Esto previene mover archivos fuera del directorio MD permitido.
    if ($realDestDir === false || strpos($realDestDir, $directorioDestinoBase) !== 0) {
        die("Ruta de destino inválida o fuera de la carpeta permitida.");
    }

    // Asegurarse de que el directorio de destino existe (crearlo si es necesario)
    if (!is_dir($realDestDir)) {
        // Usar creación recursiva y establecer permisos apropiadamente
        if (!mkdir($intendedDestDir, 0755, true)) {
            die("Error al crear la carpeta de destino.");
        }
        // Después de la creación, verificar nuevamente realpath en caso de condiciones de carrera o ataques de symlink durante mkdir
        $realDestDir = realpath($intendedDestDir);
        if ($realDestDir === false || strpos($realDestDir, $directorioDestinoBase) !== 0) {
            die("Error de seguridad post-creación de carpeta.");
        }
    }

    // Construir la ruta de destino final usando el directorio de destino real validado
    $rutaDestino = $realDestDir . '/' . $nombre;

    // Realizar la operación de movimiento
    // Opcional: Verificar si el archivo de destino ya existe
    // if (file_exists($rutaDestino)) {
    //     die("El archivo de destino ya existe.");
    // }

    if (rename($rutaOrigenReal, $rutaDestino)) {
        echo "<a href='../admin/subirArchivos/subirArchivo.php'></a>";
        $mensaje = "✅ Archivo movido con éxito a: " . htmlspecialchars($rutaDestino);
    } else {
        // Verificar errores específicos si es posible (ej. permisos)
        $mensaje = "❌ Error al mover el archivo. Verifique permisos o si el archivo ya existe.";
    }
    // Mostrar mensaje y enlace de regreso
    echo $mensaje;
    echo '<br><br><a href="../admin/subirArchivos/subirArchivo.php">Volver a la página de subir y mover archivos</a>';
    exit; // Terminar el script después de procesar el POST
}
