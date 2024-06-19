<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<div class="dashboard__formulario">
    <div class="dashboard__contenedor-boton">
        <a href="/admin/vacaciones" class="dashboard__boton">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
        </a>
    </div>

    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <form method="POST" enctype="multipart/form-data" class="formulario">
        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Editar Estado de Solicitud</legend>

            <div class="row row-campo">
                <div class="col">
                    <label for="desde" class="formulario__label">desde:</label>
                    <input type="date" class="form-control formulario__input" id="desde" name="desde" value="<?php echo $vacacion->desde; ?>" readonly>
                </div>
                <div class="col">
                    <label for="hasta" class="formulario__label">hasta:</label>
                    <input type="date" class="form-control formulario__input" id="hasta" name="hasta" value="<?php echo $vacacion->hasta; ?>" readonly>
                </div>
            </div>

            <div class="formulario__campo">
                <label for="estado" class="formulario__label">Estado:</label>
                <select class="formulario__select" id="estado" name="estado">
                    <?php if (strpos($vacacion->estado, 'Pendiente') !== false) : ?>
                        <option value="" disabled selected><?php echo $vacacion->estado; ?></option>
                        <option value="En Revision">En Revision</option>
                        <option value="Aprobadas">Aprobadas</option>
                        <option value="Rechazadas">Rechazadas</option>
                    <?php elseif (strpos($vacacion->estado, 'En Revision') !== false) : ?>
                        <option value="" disabled selected><?php echo $vacacion->estado; ?></option>
                        <option value="Aprobadas">Aprobadas</option>
                        <option value="Rechazadas">Rechazadas</option>
                    <?php elseif (strpos($vacacion->estado, 'Aprobadas') !== false || strpos($vacacion->estado, 'Rechazadas') !== false) : ?>
                        <option value="" disabled selected><?php echo $vacacion->estado; ?></option>
                        <option value="Rebajadas">Rebajadas</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="formulario__campo">
                <label for="comentario" class="formulario__label">Comentario:</label>
                <textarea name="comentario" id="comentario" class="formulario__textarea"><?php echo $vacacion->comentario; ?></textarea>
            </div>

        </fieldset>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Actualizar Estado">
    </form>

</div>