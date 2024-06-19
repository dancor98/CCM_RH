<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<?php include_once __DIR__ . '/../../templates/alertas.php'; ?>


<div class="dashboard__contenedor">
    <div class="dashboard__contenedor-boton">
        <a href="/admin/empresas/crear" class="dashboard__boton">
            <i class="fa-solid fa-circle-plus"></i>
            Crear Empresa
        </a>
    </div>
    <?php if (!empty($empresas)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr>
                    <th class="table__th" scope="col">ID</th>
                    <th class="table__th" scope="col">Empresa</th>
                    <th class="table__th" scope="col">Cedula</th>
                    <th class="table__th" scope="col"></th>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach ($empresas as $empresa) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $empresa->id; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $empresa->nombre; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $empresa->cedula; ?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/empresas/editar?id=<?php echo $empresa->id; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>

                            <form class="table__formulario" method="POST" action="/admin/empresas/eliminar">
                                <input type="hidden" name="id" value="<?php echo $empresa->id; ?>">
                                <button class="table__accion table__accion--eliminar" type="submit">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php }; ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No hay Empresas Activos</p>
    <?php } ?>
</div>

<?php
echo $paginacion;
?>