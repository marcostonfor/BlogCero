<?php
require_once __DIR__ . '/css/headerStyles.php';

class Header
{
    private string $headerSite = "";

    public function __construct()
    {
        $this->headerSite = <<<HTML
<header>
<h1 id="titulweb">
                <span class="letra-titulweb l">L</span>
                <span class="letra-titulweb e">E</span>
                <span class="letra-titulweb n">N</span>
                <span class="letra-titulweb g">G</span>
                <span class="letra-titulweb u">U</span>
                <span class="letra-titulweb a">A</span>
                <span class="letra-titulweb j">J</span>
                <span class="letra-titulweb e">E</span>
                <span class="letra-titulweb s">S</span>
            </h1>
            <hr class="dividerY">
            <hr class="dividerX">
            <div class="image-container">
                <h2 id="sub-titulweb" class="text">Sitio web para consulta de lenguajes de programacion.</h2>
    </div>
    </header>    
HTML;

    }

    public function __get($name)
    {
        if ($name === 'headerSite') {
            return $this->headerSite;
        }
    }

    public function __set($name, $value)
    {
        if ($name === 'headerSite') {
            $this->headerSite = $value;
        }
    }


}