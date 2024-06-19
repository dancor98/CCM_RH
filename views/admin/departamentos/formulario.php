<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Departamento</legend>

    <div class="formulario__campo">
        <label for="nombre" class="formulario__label">Nombre:</label>
        <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Nombre del Departamento" value="<?php echo $departamento->nombre ?? ''; ?>">
    </div>

</fieldset>