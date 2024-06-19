<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>


<div class="dashboard__contenedor">

    <div class="dashboard__contenedor-boton">
        <a href="/colaborador/vacaciones/crear" class="dashboard__boton">
            <i class="fa-solid fa-circle-plus"></i>
            Solicitar Vacaciones
        </a>
    </div>
    <?php if (!empty($vacaciones)) { ?>

        <div class="table-responsive">
            <table class="table">
                <thead class="table__thead">
                    <tr>
                        <th class="table__th" scope="col">Colaborador</th>
                        <th class="table__th" scope="col">Cedula</th>
                        <th class="table__th" scope="col">Fecha Solicitud</th>
                        <th class="table__th" scope="col">Cantidad</th>
                        <th class="table__th" scope="col">detalle</th>
                        <th class="table__th" scope="col">Estado</th>
                        <th class="table__th" scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table__tbody">
                    <?php foreach ($vacaciones as $vacacion) { ?>
                        <tr class="table__tr">
                            <td class="table__td">
                                <?php echo $vacacion->colaborador->nombre . ' ' . $vacacion->colaborador->apellido_paterno; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $vacacion->colaborador->cedula; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $vacacion->fecha; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $vacacion->cantidad; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $vacacion->detalle; ?>
                            </td>
                            <td class="table__td">
                                <?php echo $vacacion->estado; ?>
                            </td>

                            <td class="table__td--acciones">
                                <?php if (strpos($vacacion->estado, 'Pendiente') === 0) : ?>
                                    <a class="table__accion table__accion--editar" href="/colaborador/vacaciones/editar?id=<?php echo $vacacion->id; ?>">
                                        <i class="fa-solid fa-user-pen"></i>
                                        Editar
                                    </a>
                                <?php else : ?>
                                    <span>No es posible editar</span>
                                <?php endif; ?>
                            </td>



                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="text-center">No hay Vacaciones Registradas</p>
        <?php } ?>
        </div>
</div>

<?php
echo $paginacion;
?>