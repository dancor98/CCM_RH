<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>


<div class="dashboard__formulario">
    <div class="dashboard__contenedor-boton">
        <a href="/admin/colaboradores" class="dashboard__boton">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
        </a>
    </div>

    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <form method="POST" action="/admin/colaboradores/crear" enctype="multipart/form-data" class="formulario">

        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Informacion Personal</legend>

            <div class="formulario__campo">
                <label for="nombre" class="formulario__label">Nombre:</label>
                <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Nombre Colaborador"
                    value="<?php echo $colaborador->nombre ?? ''; ?>">
            </div>

            <div class="formulario__campo">
                <label for="apellido_paterno" class="formulario__label">Apellido Paterno:</label>
                <input type="text" class="formulario__input" name="apellido_paterno" id="apellido_paterno"
                    placeholder="Apellido paterno" value="<?php echo $colaborador->apellido_paterno ?? ''; ?>">
            </div>

            <div class="formulario__campo">
                <label for="apellido_materno" class="formulario__label">Apellido Materno:</label>
                <input type="text" class="formulario__input" name="apellido_materno" id="apellido_materno"
                    placeholder="Apellido materno" value="<?php echo $colaborador->apellido_materno ?? ''; ?>">
            </div>

            <div class="formulario__campo">
                <label for="cedula" class="formulario__label">Cédula:</label>
                <input type="text" class="formulario__input" name="cedula" id="cedula" placeholder="Cédula colaborador"
                    value="<?php echo $colaborador->cedula ?? ''; ?>">
            </div>

            <div class="formulario__campo">
                <label for="fecha_nacimiento" class="formulario__label">Fecha Nacimiento:</label>
                <input type="date" class="formulario__input" name="fecha_nacimiento" id="fecha_nacimiento"
                    placeholder="" value="<?php echo $colaborador->fecha_nacimiento ?? ''; ?>">
            </div>

            <div class="formulario__campo">
                <label for="correo_electronico" class="formulario__label">Correo Electronico:</label>
                <input type="email" class="formulario__input" name="correo_electronico" id="correo_electronico"
                    placeholder="Correo Electronico" value="<?php echo $colaborador->correo_electronico ?? ''; ?>">
            </div>

            <div class="formulario__campo">
                <label for="telefono" class="formulario__label">Telefono:</label>
                <input type="tel" class="formulario__input" name="telefono" id="telefono" placeholder=""
                    value="<?php echo $colaborador->telefono ?? ''; ?>">
            </div>
        </fieldset>

        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Contacto Emergencia</legend>

            <div class="formulario__campo">
                <label for="nombre_emergencia" class="formulario__label">Nombre:</label>
                <input type="text" class="formulario__input" name="nombre_emergencia" id="nombre_emergencia"
                    placeholder="Nombre Contacto de Emergencia"
                    value="<?php echo $colaborador->nombre_emergencia ?? ''; ?>">
            </div>

            <div class="formulario__campo">
                <label for="telefono_emergencia" class="formulario__label">Telefono:</label>
                <input type="tel" class="formulario__input" name="telefono_emergencia" id="telefono_emergencia"
                    placeholder="Telefono Contacto Emergencia"
                    value="<?php echo $colaborador->telefono_emergencia ?? ''; ?>">
            </div>
        </fieldset>


        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Informacion Trabajo</legend>

            <div class="formulario__campo">
                <label for="departamento" class="formulario__label">Departamento:</label>
                <select class="formulario__select" id="departamento" name="departamento_id">
                    <option value="">- Seleccionar -</option>
                    <?php foreach ($departamentos as $departamento) { ?>
                    <option <?php echo ($colaborador->departamento_id === $departamento->id) ? 'selected' : '' ?>
                        value="<?php echo $departamento->id; ?>"><?php echo $departamento->nombre; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="formulario__campo">
                <label for="puesto" class="formulario__label">Puesto:</label>
                <input type="text" class="formulario__input" name="puesto" id="puesto" placeholder=""
                    value="<?php echo $colaborador->puesto ?? ''; ?>">
            </div>

            <div class="formulario__campo">
                <label for="empresa" class="formulario__label">Empresa:</label>
                <select class="formulario__select" id="empresa" name="empresa_id">
                    <option value="">- Seleccionar -</option>
                    <?php foreach ($empresas as $empresa) { ?>
                    <option <?php echo ($colaborador->empresa_id === $empresa->id) ? 'selected' : '' ?>
                        value="<?php echo $empresa->id; ?>"><?php echo $empresa->nombre; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="formulario__campo">
                <label for="salario" class="formulario__label">Salario:</label>
                <input type="number" class="formulario__input" name="salario" id="salario" placeholder=""
                    value="<?php echo $colaborador->salario ?? ''; ?>">
            </div>

            <div class="formulario__campo">
                <label for="fecha_ingreso" class="formulario__label">Fecha Ingreso:</label>
                <input type="date" class="formulario__input" name="fecha_ingreso" id="fecha_ingreso" placeholder=""
                    value="<?php echo $colaborador->fecha_ingreso ?? ''; ?>">
            </div>

            <div class="formulario__campo">
                <input type="hidden" class="formulario__input" name="contrasena" id="contrasena" placeholder=""
                    value="1234567CCM" readonly>
            </div>


        </fieldset>

        <input class="formulario__submit formulario__submit--registrar" type="submit" value="Registrar Colaborador">
    </form>

</div>