<!-- admin/incapacidades/index.php -->

<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

<div class="dashboard__contenedor">

    <?php if (!empty($incapacidades)) { ?>
        <div class="container">
            <div class="row">
                <?php foreach ($incapacidades as $incapacidad) { ?>
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
                        <div class="card-col">
                            <a href="/admin/incapacidades/observar?id=<?php echo $incapacidad->id; ?>">
                                <i class="fa-regular fa-eye icon-eye"></i> Ver Incapacidad
                            </a>
                            <?php if ($incapacidad->colaborador->foto === "null") { ?>
                                <picture class="colaborador-picture">
                                    <source srcset="/../img/colaboradores/default.png" type="image/png">
                                    <img class="colaborador-picture--imagen-carta" loading="lazy" width="200" height="300" src="/../img/colaboradores/default.png" alt="Imagen Ponente">
                                </picture>
                            <?php } else { ?>
                                <picture class="colaborador-picture">
                                    <source srcset="/../<?php echo $incapacidad->colaborador->foto; ?>.webp" type="image/webp">
                                    <source srcset="/../<?php echo $incapacidad->colaborador->foto; ?>.png" type="image/png">
                                    <img class="colaborador-picture--imagen-carta" loading="lazy" width="200" height="300" src="/../<?php echo $incapacidad->colaborador->foto; ?>.webp" alt="Imagen Ponente">
                                </picture>
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title carta-titulo">
                                    <?php echo $incapacidad->colaborador->nombre . " " . $incapacidad->colaborador->apellido_paterno; ?>
                                </h5>
                                <p class="card-text carta-descripcion">Cedula: <?php echo $incapacidad->colaborador->cedula; ?>
                                </p>
                                <p class="card-text carta-descripcion">Fecha Ingreso Boleta: <?php echo $incapacidad->fecha; ?>
                                </p>

                                <a href="/../<?php echo $incapacidad->boleta; ?>" class="btn boton-carta btn-primary mb-2" download="Boleta Incapacidad <?php echo $incapacidad->colaborador->nombre . ' ' . $incapacidad->colaborador->apellido_paterno . '-' . $incapacidad->fecha; ?>">
                                    <i class="fa-solid fa-download"></i>
                                    Descargar
                                </a>
                            </div>
                        </div>
                    </div>
                <?php }; ?>
            </div>
        </div>

    <?php } else { ?>
        <p class="text-center">No hay Incapacidades Registradas</p>
    <?php } ?>
</div>

<?php echo $paginacion; ?>