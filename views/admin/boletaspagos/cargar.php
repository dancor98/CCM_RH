<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>


<div class="dashboard__formulario">
    <div class="dashboard__contenedor-boton">
        <a href="/admin/boletaspagos" class="dashboard__boton">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
        </a>
    </div>

    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <form method="POST" action="/admin/boletaspagos/cargar" enctype="multipart/form-data" class="formulario">

        <fieldset class="formulario__fieldset">
            <div class="formulario__campo">
                <label for="csv_file" class="formulario__label">Cargar CSV de boletas de pago:</label>
                <input type="file" class="formulario__input" name="csv_file" id="csv_file" placeholder="boleta de la Empresa" accept=".csv">
                <div id="passwordHelpBlock" class="form-text">
                    Aqui debe cargar su su archivo csv.
                </div>
            </div>


            <input class="formulario__submit formulario__submit--registrar" type="submit" value="Cargar CSV">
    </form>

</div>