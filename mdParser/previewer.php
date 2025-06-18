<?php
require_once __DIR__ . '/Parsedown.php';

class Previewer
{

    private $Parsedown = null;
    private string $markdown = "";
    private string $archivo;

    public function __construct($Parsedown, $markdown)
    {
        $this->Parsedown = $Parsedown;
        $this->markdown = $markdown;
    }

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

    public function setArchivo(string $archivo): void
    {
        $this->archivo = basename($archivo); // Seguridad: evitar rutas arbitrarias
    }

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
