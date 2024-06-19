<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/admin/dashboard">
            <img src="/build/img/logoCCM.png" alt="Logo CCM" class="dashboard__logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list icon-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : ''; ?>"
                        aria-current="page" href="/admin/dashboard">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pagina_actual('/incapacidades') ? 'dashboard__enlace--actual' : ''; ?>"
                        href="/admin/incapacidades">Incapacidades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pagina_actual('/vacaciones') ? 'dashboard__enlace--actual' : ''; ?>"
                        href="/admin/vacaciones">Vacaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pagina_actual('/colaboradores') ? 'dashboard__enlace--actual' : ''; ?>"
                        href="/admin/colaboradores">Colaboradores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pagina_actual('/salarios') ? 'dashboard__enlace--actual' : ''; ?>"
                        href="/admin/boletaspagos">Salarios</a>
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