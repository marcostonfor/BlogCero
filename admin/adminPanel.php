<?php
require_once __DIR__ . '/parser/Parsedown.php';
require_once __DIR__ . '/explorer/file_explorer.php';
require_once __DIR__ . '/calendario/classCalendar.php';
require_once __DIR__ . '/calendario/classForStyles.php';

$side_bar = new File_explorer();

$parser = new Parsedown();
$request = "";
$markdown = [];
$html = "";

$request = $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['preview']);
$markdown = $_POST['markdown'];
if ($request) {
    $html = $parser->text($markdown);
    header('Content-Type: application/json');
    echo json_encode(['html' => $html]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz de Administracíon</title>

    <link rel="stylesheet" href="style/adminPanel.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.8.1/github-markdown.min.css">
    <?php
    echo CalendarStyles::calendarStyle(); ?>
</head>

<body>
    <section id="pre_header">
        <?php require_once __DIR__ . '/../partials/navigationSite.php'; ?>
        <div class="linkPreview">
            <a href="../login/scripts/logout.php">Cerrar Sesion</a>
            <a href="factory/view_post.php" target="_blank">Página de posts</a>
        </div>
    </section>
    <section id="main">
        <section id="navigation_admin">
            <nav>
                <div class="dropdown">
                    <button onclick="dropsdown()" class="dropbtn">Dropdown</button>
                    <div id="alterDropdown" class="dropdown-content">
                        <a href="editor.php" target="_blank">Editor para posts</a>
                        <a href="socialMedia/brand_icons.php" target="_blank">publicar icono social-media</a>
                        <a href="subirArchivos/subirArchivo.php" target="_blank" title="Subir archivos markdown">Subir
                            archivos</a>
                    </div>
                </div>
                <hr>
            </nav>
        </section>
        <section id="page_body">
            <h1>Administracíon rápida de todo.</h1>
            <hr>
            <div id="page_body_display">
                <aside id="calendar">
                    <?php
                    $calendario = new Calendar();
                    echo $calendario->calendar();
                    ?>
                </aside>
                <aside id="mdEditor">
                    <h3>Editor para borradores rápidos
                        <hr>marckdown
                    </h3>
                    <section id="mdEditor-interface">
                        <form method="POST">
                            <fieldset>
                                <legend><small>Borrador markdown rápido</small></legend>
                                <button type="submit" class="guardarbtn">
                                    boton guardar
                                </button>
                            </fieldset>
                            <textarea id="markdown" name="markdown" rows="10"
                                cols="30"> <?php htmlspecialchars($markdown) ?> </textarea>
                            <button type="reset" class="limpiarbtn"><small>Limpiar borrador</small></button>
                        </form>
                        <div id="preview_box">
                            <div id="preview" class="markdown-body">
                                <?php $html ?>
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
        </section>
    </section>
    <script>
        const textarea = document.getElementById('markdown');
        const preview = document.getElementById('preview');

        textarea.addEventListener('input', () => {
            fetch(window.location.href, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                // body: 'markdown=' + encodeURIComponent(textarea.value)
                body: 'markdown=' + encodeURIComponent(textarea.value) + '&preview=1'
            })
                .then(res => res.json())
                .then(data => {
                    preview.innerHTML = data.html;
                })
                .catch(err => {
                    preview.innerHTML = '<p style="color:red">Error en la vista previa</p>';
                    console.error(err);
                });
        });

        /////////////////////////////////////////////////////////////////////////////////////////////
        function dropsdown() {
            document.getElementById("alterDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        console.log("✅ JavaScript cargado");
    </script>
</body>

</html>