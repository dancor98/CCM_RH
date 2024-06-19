<fieldset class="formulario__fieldset">

    <div class="formulario__campo">
        <label for="cantidad" class="formulario__label">Cantidad de dias:</label>
        <input type="number" class="formulario__input" name="cantidad" id="cantidad" placeholder="Cantidad de dias a disfrutar" value="<?php echo $vacacion->cantidad; ?>">
    </div>

    <div class="formulario__campo">
        <label for="detalle" class="formulario__label">Detalle:</label>
        <input type="text" class="formulario__input" name="detalle" id="detalle" placeholder="Detalle las fechas a disfrutar" value="<?php echo $vacacion->detalle; ?>">
    </div>