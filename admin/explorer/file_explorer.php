<?php
require_once __DIR__ . '/../style/linkEditormd.php';
class File_explorer
{
    private string $baseDir = "";
    private string $currentDir = "";
    private array $items = [];
    // private LinkEditormd $linkStyle = new LinkEditormd();
    public function __construct()
    {
        // Obtener ruta solicitada
        $this->currentDir = $_GET['dir'] ?? $this->baseDir;
        // Resolver la ruta absoluta
        /* $resolvedPath = realpath($requestedDir);

        // Validar que esté dentro del baseDir
        if ($resolvedPath === false || strpos($resolvedPath, $this->baseDir) !== 0 || !is_dir($resolvedPath)) {
            die("Directorio no permitido.");
        }

        $this->currentDir = $resolvedPath;
        $this->items = scandir($this->currentDir); */
        // $this->baseDir = realpath(__DIR__); // Obtiene la ruta real del script
        $this->baseDir = realpath(__DIR__ . '/../../');
        // Obtener el directorio actual
        $this->currentDir = isset($_GET['dir']) ? realpath($_GET['dir']) : getcwd();

        if (!$this->currentDir || !is_dir($this->currentDir)) {
            die("Directorio no válido.");
        }

        $this->items = scandir($this->currentDir);  // Escanea solo dentro del directorio permitido
    }

    public function __get($name)
    {
        if ($name === 'currentDir') {
            return $this->currentDir;
        } elseif ($name === 'items') {
            return $this->items;
        }
    }

    public function __set($name, $value)
    {
        if ($name === 'currentDir') {
            $this->currentDir = $value;
        } elseif ($name === 'items') {
            $this->items = $value;
        }
    }

    public function explorer_body($currentDir, $items)
    {
        $currentDir = $this->currentDir;
        $items = $this->items;


        ?>

        <style>
            #master_explorer_body {
                width: 100%;
                padding: 1rem 2rem;
                background-color: cadetblue;
                overflow: scroll;
            }

            #master_explorer_body h4 {
                width: fit-content;
                color: bisque;
                padding: 0.5vh 0.5vw;
            }

            #lateral_left {
                padding: 1vh 1vw;
            }

            #file_list {
                list-style-type: none;

                /* display: grid;
                                        grid-template-columns: repeat(2, 1fr);
                                        gap: 2vw; */
            }
        </style>

        <div id="master_explorer_body">
            <h4>
                <mark>Explorando: &#x1f440;</mark> <?php echo basename($currentDir); ?>
            </h4>
            <small>
                <?php
                // Enlace para volver al directorio padre
                $parentDir = dirname($currentDir);
                if ($parentDir && $parentDir !== $currentDir) {
                    echo "<a class='back-link' href='?dir=" . urlencode($parentDir) . "'>&#x1f4c2;.. &#x21a9;</a>";
                }
                ?>
            </small>
            <div id="bloc_interface"></div>
            <aside id="lateral_left">
                <ul id="file_list">
                    <?php
                    foreach ($items as $item) {
                        $path = realpath($currentDir . DIRECTORY_SEPARATOR . $item);
                        if ($item === '.' || ($item === '..' && realpath($currentDir) === $baseDir))
                            continue;

                        echo "<li data-path=\"" . htmlspecialchars($path) . "\">";
                        if (is_dir($path)) {
                            ?>
                            <a href="?dir=<?= urlencode($path); ?>" class="folder" style="<?= LinkEditormd::linkFilesStyle(); ?>">
                                <small>&#128194;</small> <?= htmlspecialchars($item); ?>
                            </a>
                            <?php
                            // echo "<a href='?dir=" . urlencode($path) . "' class='folder' ><small>📂</small> $item</a>";
                        } else {
                            ?>
                            <a href="?dir=<?= urlencode($path); ?>" class="folder" style="<?= LinkEditormd::linkFilesStyle(); ?>">
                                <small style="background-color: blanchedalmond;">&#128450;</small> <?= htmlspecialchars($item); ?>
                            </a>
                            <?php
                            // echo "📄 $item";
                        }
                        echo "</li>";
                    }
                    ?>
                </ul>
            </aside>
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const fileList = document.querySelectorAll("#file_list li");

                    fileList.forEach(item => {
                        item.addEventListener("contextmenu", (e) => {
                            e.preventDefault();
                            showContextMenu(e.pageX, e.pageY, item.dataset.path);
                        });
                    });

                    const menu = document.createElement("div");
                    menu.id = "context-menu";
                    menu.style.position = "absolute";
                    menu.style.display = "none";
                    menu.style.background = "#fff";
                    menu.style.border = "1px solid #ccc";
                    menu.style.zIndex = 1000;
                    document.body.appendChild(menu);

                    function showContextMenu(x, y, path) {
                        menu.innerHTML = `
            <div onclick="handleAction('create_file', '${path}')">➕ Nuevo archivo</div>
            <div onclick="handleAction('create_folder', '${path}')">📁 Nueva carpeta</div>
            <div onclick="handleAction('rename', '${path}')">✏️ Renombrar</div>
            <div onclick="handleAction('delete', '${path}')">🗑️ Eliminar</div>
        `;
                        menu.style.left = `${x}px`;
                        menu.style.top = `${y}px`;
                        menu.style.display = "block";
                    }

                    document.addEventListener("click", () => {
                        menu.style.display = "none";
                    });
                });

                function handleAction(action, path) {
                    const newName = (action === 'rename') ? prompt("Nuevo nombre:") : null;

                    fetch('explorer/file_actions.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ action, path, newName })
                    })
                        .then(response => response.text())
                        .then(data => {
                            alert(data);
                            location.reload();
                        });
                }
            </script>
        </div>
        <?php

    }
}