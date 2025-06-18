<?php
require_once __DIR__ . '/parser/Parsedown.php';
require_once __DIR__ . '/explorer/file_explorer.php';
require_once __DIR__ . '/calendario/classCalendar.php';

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
    <!-- <link rel="stylesheet" href="style/adminPanel.css"> -->
    <style>
        body {
            width: 100%;
            height: 200vh;
            box-sizing: border-box;
            background-color: #444;
        }

        #master_body {
            width: 100%;
            height: 100%;
            margin: 0 auto;
            display: flex;
            justify-content: stretch;
            border: 0.5vw double black;
            background-color: #444;
        }

        #navigation_admin {
            width: 15vw;
            border-left: 0.5vw double black;
        }

        #navigation_admin nav {
            width: 24vw;
        }

        #page_body {
            border-left: 1vw double black;
        }

        #page_body_display {
            display: flex;
            justify-content: space-evenly;
            align-items: baseline;
            gap: 10rem;
        }

        #mdEditor {
            width: auto;
            margin: 5vh auto;
            padding: 2vh 1vw;
            border: 0.2vw double darkslategray;
            border-radius: 1vw;
            background-color: burlywood;
            transform: scale(0.8, 0.8);
            transform-origin: center top;
        }

        #mdEditor::after {
            content: "¡Editor markdown rápido!";
            display: block;
            width: 100%;
            text-align: right;
            margin-top: 1em;
            color: darkslategray;
            font-weight: bold;
        }

        #mdEditor h3 {
            width: 20vw;
            text-align: center;
        }

        #mdEditor #mdEditor-interface {
            width: auto;
            display: flex;
            align-items: center;
        }

        #mdEditor #preview {
            width: 23vw;
            height: 30vh;
            border: 0.1vw ridge beige;
            border-left: 0.4vw solid #444;
            overflow-y: scroll;
        }

        #mdEditor fieldset {
            position: relative;
            padding: 1.1vh 0.3vw;
            border: none;
            background-color: dodgerblue;
            /* background-image: url('./images/mdAmbaricono.png');
    background-repeat: no-repeat; */
            background-position: center center;
            background-size: cover;
            border-top-left-radius: 1vw;
            border-top-right-radius: 1vw;
            border-bottom-left-radius: 0.5vw;
            border-bottom-right-radius: 0.5vw;
            /* filter: invert(100%); */
        }

        #mdEditor fieldset legend {
            position: absolute;
            bottom: 0em;
            right: 0em;
            color: black;
            background-color: hsla(0, 0%, 100%, 0.486);
            /* mix-blend-mode: screen; */
        }

        #mdEditor .guardarbtn {
            cursor: pointer;
            margin-bottom: 0.8vw;
        }

        #mdEditor .limpiarbtn {
            cursor: pointer;
            display: block;
            margin: 0.6vw auto;
        }

        #mdEditor #preview_box {
            position: relative;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        #mdEditor #preview_box #file_explorer {
            width: 35vw;
            height: auto;
            overflow: scroll;
        }

        /* Style the buttons that are used to open and close the accordion panel */
        .accordion {
            background-color: #eee;
            color: #444;
            cursor: pointer;
            padding: 18px;
            width: 55%;
            margin: 0.3rem auto;
            margin-left: 1rem;
            text-align: center;
            border: none;
            transition: 0.4s;
        }

        /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
        .active,
        .accordion:hover {
            background-color: #ccc;
            outline: 0.2rem solid dodgerblue;
        }

        /* Style the accordion panel. Note: hidden by default */
        .panel {
            width: 55%;
            padding: 0 18px;
            background-color: white;
            text-align: center;
            display: none;
            overflow: hidden;
        }

        #calendar {
            width: 30%;
            height: fit-content;
            padding: 0 1rem;
        }

        .linkPreview {
            width: fit-content;
            padding: 0.5rem 1rem;
            margin: 0.5rem 0;
        }

        .linkPreview a {
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: green;
            background-color: yellow;
            border-radius: 0.3rem;
        }
    </style>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.8.1/github-markdown.min.css">
</head>

<body>
    <?php require_once __DIR__ . '/../partials/navigationSite.php'; ?>
    <div class="linkPreview">
        <a href="../login/scripts/logout.php">Cerrar Sesion</a>
        <a href="factory/view_post.php" target="_blank">Página de posts</a>
    </div>
    <div id="master_body">

        <section id="navigation_admin">
            <nav>
                <button class="accordion"><small>TEXT EDITORS</small></button>
                <div class="panel">
                    <a href="editor.php" target="_blank">Editor para posts</a>
                </div>

                <button class="accordion"><small>FILE EXPLORER</small></button>
                <div class="panel">
                    <a href="explorer/view_files.php" target="_blank">Explorador de ficheros</a>
                </div>

                <button class="accordion">Section 3</button>
                <div class="panel">
                    <p>Lorem ipsum...</p>
                </div>
            </nav>
        </section>
        <section id="page_body">
            <h1>Administracíon rápida de todo.</h1>
            <hr>
            <div id="page_body_display">
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
                <section id="side_bar">
                    <?php echo $side_bar->explorer_body($side_bar->currentDir, $side_bar->items); ?>
                </section>
            </div>
            <aside id="calendar">
                <?php
                $calendario = new Calendar();
                echo $calendario->calendar();
                ?>
            </aside>
        </section>
    </div>
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

        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function () {
                /* Toggle between adding and removing the "active" class,
                to highlight the button that controls the panel */
                this.classList.toggle("active");

                /* Toggle between hiding and showing the active panel */
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
        console.log("✅ JavaScript cargado");
    </script>
</body>

</html>