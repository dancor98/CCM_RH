<?php session_start(); ?>
<aside class="Sidebar-colaborador">
    <picture class="sidebar-colaborador--picture">
        <source srcset="/../<?php echo $colaborador->foto; ?>.webp" type="image/webp">
        <source srcset="/../<?php echo $colaborador->foto; ?>.png" type="image/png">
        <img class="sidebar-colaborador--imagen" loading="lazy" width="200" height="300"
            src="/../<?php echo $colaborador->foto; ?>.webp" alt="Imagen Ponente">
    </picture>

    <div class="sidebar-colaborador--contenido">
        <h3 class="colaborador">
            <?php echo $colaborador->nombre . " " . $colaborador->apellido_paterno; ?>
        </h3>
        <h3 class="colaborador-puesto"> <?php echo $colaborador->puesto; ?> </h3>
        <hr>
        <h3 class="colaborador-detalle">Fecha Ingreso: <?php echo $colaborador->fecha_ingreso; ?> </h3>
        <h3 class="colaborador-detalle">Vacaciones Acumuladas:
            <?php echo $colaborador->meses_trabajados - $colaborador->dias_utilizados; ?> </h3>

    </div>

    <a href="/colaborador/configuracion" class="sidebar-colaborador--boton">
        <i class="fa-solid fa-gears"></i>
        Panel Configuracion
    </a>
    <a href="/colaborador/reservaciones" class="sidebar-colaborador--boton">
        <i class="fa-solid fa-calendar"></i>
        Reservar Sala Reunion
    </a>

</aside>