<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<div class="dashboard__formulario">

    <div class="dashboard__contenedor-boton">
        <a href="/colaborador/configuracion" class="dashboard__boton">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
        </a>
    </div>

    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <form method="POST" enctype="multipart/form-data" class="formulario">

        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Cambio Contrasena</legend>

            <div class="formulario__campo">
                <label for="contrasena" class="formulario__label">Contrasena Nuenva:</label>
                <input type="password" class="formulario__input" name="contrasena" id="contrasena"
                    placeholder="Nueva Contrasena" value="">
            </div>
        </fieldset>


        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Actualizar mi Contrasena">
    </form>

</div>