<h2 class="dashboard__heading"> <?php echo $titulo; ?> </h2>

<div class="dashboard__formulario">

    <div class="dashboard__contenedor-boton">
        <a href="/admin/colaboradores" class="dashboard__boton">
            <i class="fa-solid fa-circle-arrow-left"></i>
            Volver
        </a>
    </div>

    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>

    <form class="formulario">

        <!-- Informacion Colaborador -->
        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Informacion Personal</legend>

            <div class="formulario__campo">
                <label for="nombre" class="formulario__label">Nombre:</label>
                <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Nombre Colaborador"
                    value="<?php echo $colaborador->nombre ?? ''; ?>" readonly>
            </div>

            <div class="formulario__campo">
                <label for="apellido_paterno" class="formulario__label">Apellido Paterno:</label>
                <input type="text" class="formulario__input" name="apellido_paterno" id="apellido_paterno"
                    placeholder="Apellido paterno" value="<?php echo $colaborador->apellido_paterno ?? ''; ?>" readonly>
            </div>

            <div class="formulario__campo">
                <label for="apellido_materno" class="formulario__label">Apellido Materno:</label>
                <input type="text" class="formulario__input" name="apellido_materno" id="apellido_materno"
                    placeholder="Apellido materno" value="<?php echo $colaborador->apellido_materno ?? ''; ?>" readonly>
            </div>

            <div class="formulario__campo">
                <label for="cedula" class="formulario__label">Cedula:</label>
                <input type="text" class="formulario__input" name="cedula" id="cedula" placeholder="cedula colaborador"
                    value="<?php echo $colaborador->cedula ?? ''; ?>" readonly>
            </div>

            <div class="formulario__campo">
                <label for="fecha_nacimiento" class="formulario__label">Fecha Nacimiento:</label>
                <input type="text" class="formulario__input" name="fecha_nacimiento" id="fecha_nacimiento"
                    placeholder="" value="<?php echo $colaborador->fecha_nacimiento ?? ''; ?>" readonly>
            </div>

            <div class="formulario__campo">
                <label for="correo_electronico" class="formulario__label">Correo Electronico:</label>
                <input type="text" class="formulario__input" name="correo_electronico" id="correo_electronico"
                    placeholder="Correo Electronico" value="<?php echo $colaborador->correo_electronico ?? ''; ?>"
                    readonly>
            </div>

            <div class="formulario__campo">
                <label for="telefono" class="formulario__label">Telefono:</label>
                <input type="text" class="formulario__input" name="telefono" id="telefono" placeholder=""
                    value="<?php echo $colaborador->telefono ?? ''; ?>" readonly>
            </div>
        </fieldset>

        <!-- Informacion contacto Emergencia -->
        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Contacto de Emergencia</legend>
            <div class="formulario__campo">
                <label for="nombre_emergencia" class="formulario__label">Nombre:</label>
                <input type="text" class="formulario__input" name="nombre_emergencia" id="nombre_emergencia"
                    value="<?php echo $colaborador->nombre_emergencia ?? ''; ?>" readonly>
            </div>
            <div class="formulario__campo">
                <label for="telefono_emergencia" class="formulario__label">Telefono:</label>
                <input type="text" class="formulario__input" name="telefono_emergencia" id="telefono_emergencia"
                    value="<?php echo $colaborador->telefono_emergencia ?? ''; ?>" readonly>
            </div>
            </legend>
        </fieldset>

        <!-- Informacion de empresa -->
        <fieldset class="formulario__fieldset">
            <legend class="formulario__legend">Informacion Trabajo</legend>

            <div class="formulario__campo">
                <label for="departamento" class="formulario__label">Departamento:</label>
                <input type="text" class="formulario__input" name="departamento" id="departamento" placeholder=""
                    value="<?php echo $colaborador->departamento->nombre ?? ''; ?>" readonly>
            </div>

            <div class="formulario__campo">
                <label for="puesto" class="formulario__label">Puesto:</label>
                <input type="text" class="formulario__input" name="puesto" id="puesto" placeholder=""
                    value="<?php echo $colaborador->puesto ?? ''; ?>" readonly>
            </div>

            <div class="formulario__campo">
                <label for="empresa" class="formulario__label">Empresa:</label>
                <input type="text" class="formulario__input" name="empresa" id="empresa" placeholder=""
                    value="<?php echo $colaborador->empresa->nombre ?? ''; ?>" readonly>
            </div>

            <div class="formulario__campo">
                <label for="salario" class="formulario__label">Salario:</label>
                <input type="text" class="formulario__input" name="salario" id="salario" placeholder=""
                    value="<?php echo $colaborador->salario ?? ''; ?>" readonly>
            </div>

            <div class="formulario__campo">
                <label for="fecha_ingreso" class="formulario__label">Fecha Ingreso:</label>
                <input type="text" class="formulario__input" name="fecha_ingreso" id="fecha_ingreso" placeholder=""
                    value="<?php echo $colaborador->fecha_ingreso ?? ''; ?>" readonly>
            </div>


        </fieldset>
    </form>

</div>