<fieldset class="formulario__fieldset">

    <div class="formulario__campo">
        <input type="text" class="formulario__input" name="colaborador_id" id="colaborador_id"
            placeholder="ID del Colaborador" value="<?php echo $_SESSION['id']; ?>" hidden>
    </div>

    <div class="formulario__campo">
        <label for="boleta" class="formulario__label">boleta:</label>
        <input type="file" class="formulario__input" name="boleta" id="boleta" placeholder="boleta de la Empresa"
            accept="application/pdf">
    </div>

    <div class="formulario__campo">
        <label for="fecha" class="formulario__label">fecha:</label>
        <input type="text" class="formulario__input" name="fecha" id="fecha" placeholder="fecha de la Empresa"
            value="<?php echo date('Y-m-d'); ?>" readonly>
    </div>