<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>


<div class="dashboard__contenedor">
    <?php if (!empty($boletaspagos)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th" scope="col">Colaborador</th>
                    <th class="table__th" scope="col">Cedula</th>
                    <th class="table__th" scope="col">Fecha Boleta</th>
                    <th class="table__th" scope="col">Empresa</th>
                    <th class="table__th" scope="col"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($boletaspagos as $boletapago) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $boletapago->colaborador->nombre . ' ' . $boletapago->colaborador->apellido_paterno; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $boletapago->colaborador->cedula; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $boletapago->fecha; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $boletapago->empresa->nombre; ?>
                        </td>

                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/../<?php echo $boletapago->archivo_pdf; ?>" download="Boleta Incapacidad <?php echo $boletapago->colaborador->nombre . ' ' . $boletapago->colaborador->apellido_paterno . '-' . $boletapago->fecha; ?>">
                                <i class="fa-solid fa-download"></i>
                                Descargar
                            </a>
                        </td>
                    </tr>
                <?php }; ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No hay boletas de pago creadas</p>
    <?php } ?>
</div>

<?php
echo $paginacion;
?>