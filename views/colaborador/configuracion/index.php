<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="row">
    <div class="col-sm-6 card-inicio">
        <div class="card-admin">
            <a href="/colaborador/configuracion/cambiocontrasena?id=<?php echo $_SESSION['id']; ?>">
                <div class="card-body">
                    <h5 class="card-title">Cambio Contrasena</h5>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 card-inicio">
        <div class="card-admin">
            <a href="/colaborador/configuracion/editarinfo?id=<?php echo $_SESSION['id']; ?>">
                <div class="card-body">
                    <h5 class="card-title">Cambio Informacion Contacto</h5>
                </div>
            </a>
        </div>
    </div>

</div>

<div class="modal" id="exito" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa-solid fa-bell" id="icono-exito"></i>
                <h5 class="modal-title titulo-modal">Mensaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="modal-mensaje">Accion Realizada con Exito</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="error" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa-solid fa-triangle-exclamation" id="icono-error"></i>
                <h5 class="modal-title titulo-modal">Mensaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="modal-mensaje">Hubo un error, intentelo mas tarde.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-modal" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>