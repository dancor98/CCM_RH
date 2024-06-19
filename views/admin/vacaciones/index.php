<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>


<div class="dashboard__contenedor">
    <?php if (!empty($vacaciones)) { ?>



    <div class="container">
        <div class="row">
            <?php foreach ($vacaciones as $vacacion) { ?>
            <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
                <div class="card-col">
                    <?php if ($colaborador->foto === "null") { ?>
                    <picture class="colaborador-picture">
                        <source srcset="/../img/colaboradores/default.png" type="image/png">
                        <img class="colaborador-picture--imagen-carta" loading="lazy" width="200" height="300"
                            src="/../img/colaboradores/default.png" alt="Imagen Ponente">
                    </picture>
                    <?php } else { ?>
                    <picture class="colaborador-picture">
                        <source srcset="/../<?php echo $vacacion->colaborador->foto; ?>.webp" type="image/webp">
                        <source srcset="/../<?php echo $vacacion->colaborador->foto; ?>.png" type="image/png">
                        <img class="colaborador-picture--imagen-carta" loading="lazy" width="200" height="300"
                            src="/../<?php echo $vacacion->colaborador->foto; ?>.webp" alt="Imagen Ponente">
                    </picture>
                    <?php } ?>
                    <div class="card-body">
                        <h5 class="card-title carta-titulo">
                            <?php echo $vacacion->colaborador->nombre . " " . $vacacion->colaborador->apellido_paterno; ?>
                        </h5>
                        <p class="card-text carta-descripcion">Fecha Solicitud:
                            <?php echo $vacacion->fecha; ?>
                        </p>
                        <p class="card-text carta-descripcion">Cantidad dias solicitados:
                            <?php echo $vacacion->cantidad; ?>
                        </p>
                        <p class="card-text carta-descripcion">Dias Disponibles:
                            <?php echo $vacacion->colaborador->meses_trabajados - $vacacion->colaborador->dias_utilizados; ?>
                        </p>
                        <p class="card-text carta-descripcion">Estado: <?php echo $vacacion->estado; ?></p>

                        <a href="/admin/vacaciones/editar?id=<?php echo $vacacion->id; ?>"
                            class="btn boton-carta btn-secondary mb-2">
                            <i class="fa-solid fa-user-pen"></i>
                            Ver y Editar
                        </a>
                    </div>
                </div>
            </div>
            <?php }; ?>
        </div>
    </div>


    <?php } else { ?>
    <p class="text-center">No hay Vacaciones Registradas</p>
    <?php } ?>
</div>

<?php
echo $paginacion;
?>