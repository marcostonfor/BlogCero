<?php
// Ruta base: carpeta MD fuera del directorio actual
$raiz = realpath(__DIR__ . '/../MD');

if (!$raiz || !is_dir($raiz)) {
    die("La carpeta raíz MD no existe o no es accesible.");
}

// Limpia la ruta relativa para evitar inyecciones tipo ../
function limpiarRuta($ruta)
{
    return preg_replace('/\.+[\/\\\\]/', '', $ruta);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $path = limpiarRuta($_POST['path'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $tipo = $_POST['tipo'] ?? '';

    if ($nombre === '' || !in_array($tipo, ['archivo', 'carpeta'])) {
        die("Parámetros inválidos.");
    }

    // Ruta destino sin usar realpath porque puede no existir aún
    $rutaDestino = rtrim($raiz . '/' . $path, '/') . '/' . $nombre;

    // Seguridad: verificar que la carpeta destino está dentro de MD
    $directorioDestino = dirname($rutaDestino);
    $directorioReal = realpath($directorioDestino) ?: $directorioDestino;

    if (strpos($directorioReal, $raiz) !== 0) {
        die("Ruta fuera del directorio permitido.");
    }

    if ($tipo === 'carpeta') {
        if (!is_dir($rutaDestino)) {
            echo "<pre>Intentando crear carpeta en:\n$rutaDestino</pre>";

            if (mkdir($rutaDestino, 0775, true)) {
                echo "✅ Carpeta creada: $nombre";
            } else {
                echo "❌ Error al crear la carpeta. Verifica permisos y ruta.";
            }
        } else {
            echo "⚠️ La carpeta ya existe.";
        }


    } elseif ($tipo === 'archivo') {
        if (!str_ends_with($nombre, '.md')) {
            $nombre .= '.md';
            $rutaDestino .= '.md';
        }

        if (!file_exists($rutaDestino)) {
            if (file_put_contents($rutaDestino, "# Nuevo archivo Markdown\n\n")) {
                echo "✅ Archivo creado: $nombre";
            } else {
                echo "❌ Error al crear el archivo.";
            }
        } else {
            echo "⚠️ El archivo ya existe.";
        }
    }
    exit;
}
/* echo 'Usuario actual: ' . get_current_user();
echo '<br>Ruta base: ' . $raiz; */

?>

<!-- Formulario HTML -->
<form method="post">
    <label>Ruta relativa (dentro de MD/):<br>
        <input type="text" name="path" placeholder="ejemplo/subcarpeta" required>
    </label><br><br>

    <label>Nombre:<br>
        <input type="text" name="nombre" required>
    </label><br><br>

    <label>Tipo:<br>
        <select name="tipo" required>
            <option value="archivo">Archivo .md</option>
            <option value="carpeta">Carpeta</option>
        </select>
    </label><br><br>

    <button type="submit">Crear</button>
</form>