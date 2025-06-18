<?php
class PublishIconSocialMedia
{
    public function publish()
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=php_login_database;charset=utf8', 'root', 'asdfg2');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->query("SELECT class, unicode FROM social_media WHERE publicado = 1");
            $iconos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $output_html = "<ul id='lista-iconos-publicada' style='list-style:none;padding:0;display:flex;gap:10px;'>";

            foreach ($iconos as $icono) {
                $class = htmlspecialchars($icono['class'], ENT_QUOTES, 'UTF-8');
                $unicode = ltrim($icono['unicode'], '&#x'); // limpiamos posibles entradas erróneas
                $unicode = $icono['unicode']; // Asumimos que se almacena el hexadecimal limpio, ej: "f082"

                // Aseguramos que el unicode sea hexadecimal válido
                if (ctype_xdigit($unicode)) {
                    if (!empty($unicode) && ctype_xdigit(str_replace(['&#x', ';'], '', $unicode))) { // Verificación robusta
                        $output_html .= "<li><a href='#'><i class='{$class}' style='font-size:24px'>&#x{$unicode};</i></a></li>";
                    }
                }
            }

            $output_html .= "</ul>";
            return $output_html;

        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
