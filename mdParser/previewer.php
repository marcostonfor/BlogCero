<?php
/**
 * Clase Previewer para procesar y mostrar archivos Markdown.
 *
 * Esta clase utiliza la biblioteca Parsedown para convertir contenido Markdown
 * a HTML. Además, ofrece funcionalidades para cargar archivos Markdown,
 * y modificar los enlaces internos para una navegación fluida dentro
 * de un sistema de previsualización basado en el script `usePreviewer.php`.
 *
 * @package     BlogCero
 * @subpackage  MarkdownParser
 * @since       1.0.0
 */
require_once __DIR__ . '/Parsedown.php';

class Previewer
{
    /**
     * Instancia de la clase Parsedown utilizada para convertir Markdown a HTML.
     * @var Parsedown|null
     */
    private $Parsedown = null;
    /**
     * Contenido Markdown en formato de cadena de texto.
     * Puede ser utilizado para procesar Markdown directamente sin un archivo.
     * @var string
     */
    private string $markdown = "";
    /**
     * Nombre del archivo Markdown que se está procesando o se va a procesar.
     * Se almacena solo el nombre base del archivo por seguridad.
     * @var string
     */
    private string $archivo;

    /**
     * Constructor de la clase Previewer.
     *
     * @param Parsedown $Parsedown Instancia de la clase Parsedown.
     * @param string    $markdown  Contenido Markdown inicial (opcional).
     */

    public function __construct($Parsedown, $markdown)
    {
        $this->Parsedown = $Parsedown;
        $this->markdown = $markdown;
    }

    /**
     * Método mágico para obtener el valor de las propiedades privadas.
     *
     * @param string $name Nombre de la propiedad a la que se accede.
     * @return mixed El valor de la propiedad solicitada.
     * @throws Exception Si la propiedad no está definida.
     */
    public function __get($name)
    {
        if ($name === 'Parsedown') {
            return $this->Parsedown;
        } elseif ($name === 'markdown') {
            return $this->markdown;
        } elseif ($name === 'archivo') {
            return $this->archivo;
        }
        throw new Exception("Propiedad '$name' no definida");
    }

    /**
     * Método mágico para establecer el valor de las propiedades privadas.
     *
     * @param string $name  Nombre de la propiedad a establecer.
     * @param mixed  $value El valor a asignar a la propiedad.
     * @return void
     * @throws Exception Si la propiedad no está definida.
     */

    public function __set($name, $value)
    {
        if ($name === 'Parsedown') {
            $this->Parsedown = $value;
        } elseif ($name === 'markdown') {
            $this->markdown = $value;
        } elseif ($name === 'archivo') {
            $this->archivo = $value;
        } else {
            throw new Exception("Propiedad '$name' no definida");
        }
    }

    /**
     * Establece el nombre del archivo Markdown a procesar.
     *
     * Por seguridad, solo se almacena el nombre base del archivo
     * utilizando `basename()` para prevenir ataques de tipo Path Traversal.
     *
     * @param string $archivo La ruta o nombre del archivo Markdown.
     * @return void
     */


    public function setArchivo(string $archivo): void
    {
        $this->archivo = basename($archivo); // Seguridad: evitar rutas arbitrarias
    }

    /**
     * Renderiza un archivo Markdown a HTML.
     *
     * Lee el contenido del archivo Markdown especificado, lo convierte a HTML
     * utilizando la instancia de Parsedown, y luego reescribe los enlaces
     * internos (aquellos que apuntan a otros archivos .md) para que
     * dirijan al script `usePreviewer.php` con el parámetro `md` adecuado.
     *
     * @param string $file El nombre del archivo Markdown (relativo al directorio MD).
     * @return string El contenido HTML renderizado.
     * @throws Exception Si el archivo Markdown no existe.
     */

    public function rendermd($file): string
    {
        $file = __DIR__ . '/../MD/' . $file;
        $this->Parsedown = new Parsedown();

        if (!file_exists($file)) {
            throw new Exception("El archivo Markdown no existe: $file");
        }

        $mdFile = file_get_contents($file);

        $view = $this->Parsedown->text($mdFile);
        // Reescribe enlaces que apunten a archivos .md para redirigir al mismo script PHP
        $view = preg_replace_callback('/<a href="([^"]+\.md)">/', function ($match) {
            $archivo = urlencode($match[1]);
            return '<a href="usePreviewer.php?md=' . $archivo . '">';
        }, $view);

        return $view;

    }

}
