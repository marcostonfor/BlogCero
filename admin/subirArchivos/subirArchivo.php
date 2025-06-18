<?php
require_once __DIR__ . '/../../MDExplorer/explorer.php';

// Función para mostrar la estructura de directorios de forma recursiva
function mostrarEstructuraDirectorio($directorioRaiz, $subRutaActual = '')
{
    $htmlLista = '';
    $rutaAbsolutaActual = rtrim($directorioRaiz . DIRECTORY_SEPARATOR . $subRutaActual, DIRECTORY_SEPARATOR);

    // @ para suprimir warnings si el directorio no es legible, aunque $directorioRaiz ya está validado
    $elementos = @scandir($rutaAbsolutaActual);

    if ($elementos === false)
        return ''; // No se pudo leer el directorio

    $subdirectoriosEncontrados = false;
    foreach ($elementos as $elemento) {
        if ($elemento === '.' || $elemento === '..')
            continue;

        $rutaAbsolutaElemento = $rutaAbsolutaActual . DIRECTORY_SEPARATOR . $elemento;
        if (is_dir($rutaAbsolutaElemento)) {
            if (!$subdirectoriosEncontrados) {
                $htmlLista .= '<ul>';
                $subdirectoriosEncontrados = true;
            }
            $rutaRelativaParaMostrar = trim($subRutaActual . DIRECTORY_SEPARATOR . $elemento, DIRECTORY_SEPARATOR);
            $htmlLista .= '<li><i class="fa fa-folder"></i> ' . htmlspecialchars($rutaRelativaParaMostrar);
            $htmlLista .= mostrarEstructuraDirectorio($directorioRaiz, $rutaRelativaParaMostrar); // Llamada recursiva
            $htmlLista .= '</li>';
        }
    }
    if ($subdirectoriosEncontrados)
        $htmlLista .= '</ul>';
    return $htmlLista;
}
?>
<!DOCTYPE html>
<html lang="ca-ES, en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Subir Archivos con PHP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">


<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-12 col-md-5 subir">
                <form enctype="multipart/form-data" action="subida.php" method="POST">
                    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
                    <h5><i class="fa fa-file"></i> Seleccione el archivo a subir: </h5>
                    <hr />
                    <input name="fichero_usuario[]" type="file" multiple />
                    <button class="btn btn-success mt-2" type="submit"><i class="fa fa-upload"></i> Subir
                        Archivo</button>
                </form>
            </div>

            <div class="col-sm-12 col-md-6  archivos">
                <h5><i class="fa fa-archive "></i> Archivos cargados al servidor</h5>
                <hr />
                <?php $carpeta = glob('../../MD/Subidasmd/*.md');
                echo "<table class='table-responsive' border='1'>";
                echo "<tr>
				<th>
				<h6>Nombre del Archivo</h6>
				</th> 
				<th>
				<h6>Tamaño</h6>
				</th>
				</tr>";
                foreach ($carpeta as $archivo) {
                    $nombre = basename($archivo);
                    echo "<tr><td>$nombre</td><td>" . filesize($archivo) . " bytes</td></tr>";
                }
                echo "</table>";
                ?>
            </div>
        </div>
        <div class="row mt-5">
            <!-- <form action="../../MDExplorer/explorer.php" method="post">
                <div class="form-group">
                    <label for="nombre_archivo_mover">Nombre del archivo (en Subidasmd/):</label>
                    <input type="text" class="form-control" name="nombre" id="nombre_archivo_mover"
                        placeholder="ejemplo.md" required>
                </div>
                <div class="form-group">
                    <label for="ruta_destino">Ruta de destino (dentro de MD/, ej: subcarpeta1/sub2):</label>
                    <input type="text" class="form-control" name="path" id="ruta_destino"
                        placeholder="opcional, ej: docs/privado">
                </div>
                <input type="hidden" name="tipo" value="archivo">
                <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-share-square"></i> Mover
                    Archivo</button>
            </form> -->
            <div class="col-md-6"> <!-- Columna para el formulario de mover archivos -->
                <h5><i class="fa fa-share-square"></i> Mover archivo de Subidasmd/ a MD/</h5>
                <hr />
                <form action="../../MDExplorer/explorer.php" method="post">
                    <div class="form-group">
                        <label for="nombre_archivo_mover">Nombre del archivo (en Subidasmd/):</label>
                        <input type="text" class="form-control" name="nombre" id="nombre_archivo_mover"
                            placeholder="ejemplo.md" required>
                    </div>
                    <div class="form-group">
                        <label for="ruta_destino">Ruta de destino (dentro de MD/, ej: subcarpeta1/sub2):</label>
                        <input type="text" class="form-control" name="path" id="ruta_destino"
                            placeholder="opcional, ej: docs/privado">
                    </div>
                    <input type="hidden" name="tipo" value="archivo">
                    <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-share-square"></i> Mover
                        Archivo</button>
                </form>
            </div>
            <div class="col-md-6"> <!-- Columna para la estructura de directorios -->
                <h5><i class="fa fa-sitemap"></i> Estructura de MD/ (para referencia)</h5>
                <hr />
                <div class="directorio-estructura">
                    <?php
                    // $directorioDestinoBase se define en explorer.php y está disponible aquí
                    if (isset($directorioDestinoBase) && is_dir($directorioDestinoBase)) {
                        echo mostrarEstructuraDirectorio($directorioDestinoBase);
                    } else {
                        echo "<p>No se pudo acceder al directorio base MD/ para mostrar la estructura.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <style type="text/css">
            .subir {
                border: 1px solid #7F9EEE;
                padding: 20px;
                width: auto;
                border-radius: 15px;
                min-height: 240px;
                margin: auto;
                background: #C0E1F9;
                margin-bottom: 5px;
            }

            .archivos {
                border: 1px solid #89EA53;
                padding: 10px;
                width: auto;
                min-height: 240px;
                border-radius: 15px;
                margin: auto;
                background: #CCF8B4;
            }

            #url {
                width: 30vw;
            }

            .directorio-estructura {
                max-height: 300px;
                /* Ajusta según necesidad */
                overflow-y: auto;
                border: 1px solid #ddd;
                padding: 10px;
                border-radius: 5px;
                background-color: #f9f9f9;
            }

            .directorio-estructura ul {
                list-style-type: none;
                padding-left: 1em;
                /* Indentación para subniveles */
            }

            .directorio-estructura>ul {
                /* Sin padding-left para el primer nivel */
                padding-left: 0;
            }

            .directorio-estructura li {
                padding: 2px 0;
            }
        </style>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
            crossorigin="anonymous"></script>

</body>

</html>