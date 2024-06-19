<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/colaborador/dashboard">
            <img src="/build/img/logoCCM.png" alt="Logo CCM" class="dashboard__logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list icono-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : ''; ?>"
                        aria-current="page" href="/colaborador/dashboard">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pagina_actual('/boletapago') ? 'dashboard__enlace--actual' : ''; ?>"
                        href="/colaborador/boletapago">Boletas de Pago</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pagina_actual('/incapacidades') ? 'dashboard__enlace--actual' : ''; ?>"
                        href="/colaborador/incapacidades">Incapacidades</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo pagina_actual('/vacaciones') ? 'dashboard__enlace--actual' : ''; ?>"
                        href="/colaborador/vacaciones">Vacaciones</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="/logout" class="dashboard__form d-flex">
                        <input type="submit" value="Cerrar Sesion" class="nav-link">
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>