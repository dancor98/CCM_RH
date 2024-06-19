<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>


<div class="dashboard__contenedor">


    <div class="container-opcion">
        <div class="row justify-content-end">
            <div class="col-12 col-md-auto mb-2 mb-md-0">
                <div class="dashboard__contenedor-boton">
                    <a href="/admin/colaboradores/crear" class="dashboard__boton">
                        <i class="fa-solid fa-circle-plus"></i>
                        Crear Colaborador
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-auto">
                <div class="dashboard__contenedor-boton">
                    <a href="/admin/colaboradores/descargar-tabla-csv" class="dashboard__boton">
                        <i class="fa-solid fa-download icono-opcion"></i>
                        Descargar Info
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($colaboradores)) { ?>

    <div class="container">
        <div class="row">
            <?php foreach ($colaboradores as $colaborador) { ?>
            <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
                <div class="card-col">
                    <a href="/admin/colaboradores/observar?id=<?php echo $colaborador->id; ?>">
                        <i class="fa-regular fa-eye icon-eye"></i>
                    </a>
                    <?php if ($colaborador->foto === "null") { ?>
                    <picture class="colaborador-picture">
                        <source srcset="/../img/colaboradores/default.png" type="image/png">
                        <img class="colaborador-picture--imagen-carta" loading="lazy" width="200" height="300"
                            src="/../img/colaboradores/default.png" alt="Imagen Ponente">
                    </picture>
                    <?php } else { ?>
                    <picture class="colaborador-picture">
                        <source srcset="/../<?php echo $colaborador->foto; ?>.webp" type="image/webp">
                        <source srcset="/../<?php echo $colaborador->foto; ?>.png" type="image/png">
                        <img class="colaborador-picture--imagen-carta" loading="lazy" width="200" height="300"
                            src="/../<?php echo $colaborador->foto; ?>.webp" alt="Imagen Ponente">
                    </picture>
                    <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title carta-titulo">
                            <?php echo $colaborador->nombre . " " . $colaborador->apellido_paterno; ?></h5>
                        <p class="card-text carta-descripcion">Cedula: <?php echo $colaborador->cedula; ?></p>
                        <p class="card-text carta-descripcion">Puesto Actual: <?php echo $colaborador->puesto; ?></p>
                        <p class="card-text carta-descripcion">Salario Actual: ₡<?php echo $colaborador->salario; ?></p>
                        <a href="/admin/boletaspagos/crear?id=<?php echo $colaborador->id; ?>"
                            class="btn boton-carta btn-primary mb-2">
                            <i class="fa-solid fa-money-check-dollar"></i>
                            Crear Boleta Pago
                        </a>
                        <a href="/admin/colaboradores/editar?id=<?php echo $colaborador->id; ?>"
                            class="btn boton-carta btn-secondary mb-2">
                            <i class="fa-solid fa-user-pen"></i>
                            Editar
                        </a>
                        <form method="POST" action="/admin/colaboradores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $colaborador->id; ?>">
                            <button class="btn boton-carta btn-danger mb-2" type="submit">
                                <i class="fa-solid fa-circle-xmark"></i>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php }; ?>
        </div>
    </div>

    <?php } else { ?>
    <p class="text-center">No hay Colaboradores Activos</p>
    <?php } ?>
</div>

<?php
echo $paginacion;
?>