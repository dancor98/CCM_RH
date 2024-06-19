<div class="row">
    <div class="col-sm-4 card-inicio">
        <div class="card-indicador card-indicador__fecha">
            <a href="">
                <div class="card-body">
                    <p class="card-numero">
                        <?php echo date('d-m-y'); ?>
                        </h5>
                    <h2 class="card-title2">Fecha Actual</h2>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-4 card-inicio">
        <div class="card-indicador card-indicador__activos">
            <a href="/admin/colaboradores">
                <div class="card-body">
                    <p class="card-numero">
                        <?php echo $colaboradoresTotal; ?>
                        </h5>
                    <h2 class="card-title2">Colaboradores Activos</h2>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-4 card-inicio">
        <div class=" card-indicador card-indicador__vacaciones">
            <a href="/admin/vacaciones">
                <div class="card-body">
                    <p class="card-numero">
                        <?php echo $solicitudvacacionesN; ?>
                        </h5>
                    <h2 class="card-title2">Solicitud de Vacaciones Nuevas</h2>
                </div>
            </a>
        </div>
    </div>


</div>

<h2 class="dashboard__heading"><?php echo $titulo; ?></h2>

<div class="row">
    <div class="col-sm-4 card-inicio">
        <div class="card-admin">
            <a href="/admin/incapacidades">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-hospital-user icono-opcion"></i>Boletas de Incapacidad
                    </h5>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-4 card-inicio">
        <div class="card-admin">
            <a href="/admin/vacaciones">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-plane-departure icono-opcion"></i>Vacaciones
                        Solicitadas</h5>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-4 card-inicio">
        <div class="card-admin">
            <a href="/admin/colaboradores">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-users-line icono-opcion"></i>Colaboradores</h5>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-4 card-inicio">
        <div class="card-admin">
            <a href="/admin/boletaspagos">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-money-check-dollar icono-opcion"></i>Salarios</h5>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-4 card-inicio">
        <div class="card-admin">
            <a href="/admin/departamentos">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-building-user icono-opcion"></i>Departamentos</h5>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-4 card-inicio">
        <div class="card-admin">
            <a href="/admin/empresas">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-building icono-opcion"></i>Empresas</h5>
                </div>
            </a>
        </div>
    </div>
</div>