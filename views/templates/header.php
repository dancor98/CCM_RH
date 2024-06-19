<nav class="navbar navbar-expand-lg  navbar-principal">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/build/img/logoCCM.png" alt="Logo CCM" class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars icon-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo pagina_actual('') ? 'dashboard__enlace--actual' : ''; ?>" aria-current="page" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo pagina_actual('/login') ? 'dashboard__enlace--actual' : ''; ?>" href="/login">Iniciar Sesion</a>
                </li>

            </ul>
        </div>
    </div>
</nav>