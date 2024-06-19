<?php

if (isset($alertas) && is_array($alertas)) {
    foreach ($alertas as $key => $alerta) {
        foreach ($alerta as $mensaje) { ?>
            <div class="alerta alerta__<?php echo htmlspecialchars($key, ENT_QUOTES, 'UTF-8'); ?>">
                <?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?>
            </div>
<?php
        }
    }
}
?>