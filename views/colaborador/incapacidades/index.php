<!-- admin/incapacidades/index.php -->

<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

<div class="dashboard__contenedor">
    <div class="dashboard__contenedor-boton">
        <a href="/colaborador/incapacidades/crear" class="dashboard__boton">
            <i class="fa-solid fa-circle-plus"></i>
            Registrar Incapacidad
        </a>
    </div>
    <?php if (!empty($incapacidades)) { ?>
    <table class="table">
        <thead class="table__thead">
            <tr>
                <th class="table__th" scope="col">Colaborador</th>
                <th class="table__th" scope="col">Cedula</th>
                <th class="table__th" scope="col">Fecha Ingreso</th>
                <th class="table__th" scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody class="table__tbody">
            <?php foreach ($incapacidades as $incapacidad) { ?>
            <tr class="table__tr">
                <td class="table__td">
                    <?php echo $incapacidad->colaborador->nombre . ' ' . $incapacidad->colaborador->apellido_paterno; ?>
                </td>
                <td class="table__td">
                    <?php echo $incapacidad->colaborador->cedula; ?>
                </td>
                <td class="table__td">
                    <?php echo $incapacidad->fecha; ?>
                </td>
                <td class="table__td--acciones">
                    <a class="table__accion table__accion--editar" href="/../<?php echo $incapacidad->boleta; ?>"
                        download="Boleta Incapacidad <?php echo $incapacidad->colaborador->nombre . ' ' . $incapacidad->colaborador->apellido_paterno; ?>">
                        <i class="fa-solid fa-download"></i>
                        Descargar
                    </a>
                </td>
            </tr>
            <?php }; ?>
        </tbody>
    </table>
    <?php } else { ?>
    <p class="text-center">No hay Incapacidades Registradas</p>
    <?php } ?>
</div>

<?php echo $paginacion; ?>