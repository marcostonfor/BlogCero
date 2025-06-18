<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_icon_html = [];
    if (isset($_POST['selecciones']) && is_array($_POST['selecciones'])) {
        foreach ($_POST['selecciones'] as $contenido) {
            if (!empty($contenido)) {
                $selected_icon_html[] = $contenido;
            }
        }
    }

    if (!empty($selected_icon_html)) {
        echo "<h3>Iconos seleccionados:</h3>";
        foreach ($selected_icon_html as $icon_html) {
            echo $icon_html . "<br>";
        }
    } else {
        echo "No se seleccionaron iconos.";
    }
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<form method="post" action="">
    <label><input type="checkbox" name="opciones_control[]" value="facebook" onchange="updateIconForSubmission(this);">
        <i style="font-size:24px" class="fa">&#xf082;</i></label>
    <input type="hidden" name="selecciones[]" id="facebook_hidden" value=""><br>

    <!-- Ejemplo con otro icono (Twitter) -->
    <label><input type="checkbox" name="opciones_control[]" value="twitter" onchange="updateIconForSubmission(this);">
        <i style="font-size:24px" class="fa">&#xf099;</i></label>
    <input type="hidden" name="selecciones[]" id="twitter_hidden" value=""><br>

    <label><input type="checkbox" name="opciones_control[]" value="banana"> Banana (sin icono para enviar)</label><br>
    <label><input type="checkbox" name="opciones_control[]" value="naranja"> Naranja (sin icono para enviar)</label><br>
    <button type="submit">Enviar</button>
    <button type="reset">Eliminar</button>
</form>

<script>
    function updateIconForSubmission(checkboxElement) {
        // El ID del campo oculto se deriva del valor del checkbox (ej: value="facebook" -> id="facebook_hidden")
        const hiddenInputId = checkboxElement.value + "_hidden";
        const hiddenInput = document.getElementById(hiddenInputId);

        if (!hiddenInput) {
            // Si no hay un campo oculto correspondiente, este checkbox no está configurado para enviar un icono.
            return;
        }

        // Asegurarse de que el campo oculto esté destinado al array 'selecciones[]'
        if (hiddenInput.name !== 'selecciones[]') {
            console.warn('El campo oculto', hiddenInputId, 'no tiene name="selecciones[]"');
            return;
        }

        const label = checkboxElement.closest('label');
        if (!label) {
            // No debería ocurrir con HTML válido
            return;
        }

        const iconElement = label.querySelector('i.fa'); // Asumimos que los iconos tienen la clase 'fa'

        if (checkboxElement.checked && iconElement) {
            hiddenInput.value = iconElement.outerHTML; // Envía el HTML completo del icono
        } else {
            hiddenInput.value = ""; // Limpia el valor si no está marcado o no se encuentra el icono
        }
    }
</script>