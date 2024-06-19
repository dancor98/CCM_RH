<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Informacion de la Empresa</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre:</label>
        <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Nombre de la empresa" value="<?php echo $empresa->nombre ?? ''; ?>">
    </div>
    <div class="formulario__campo">
        <label for="cedula" class="formulario__label">cedula:</label>
        <input type="number" class="formulario__input" name="cedula" id="cedula" placeholder="Cedula de la Empresa" value="<?php echo $empresa->cedula ?? null; ?>">
    </div>

</fieldset>