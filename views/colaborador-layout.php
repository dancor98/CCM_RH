<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCM Colaborador</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body class="dashboard">
    <?php
    include_once __DIR__ . '/templates/colaborador-header.php';
    ?>
    <div class="contenedor-colaborador">
        <div class="contenedor-colaborador__left">
            <?php
            include_once __DIR__ . '/templates/admin-sidebar.php';
            ?>

        </div>
        <div class="contenedor-colaborador__right">
            <?php
            echo $contenido;
            ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="/build/js/main.min.js" defer></script>



    <script>
    document.addEventListener("DOMContentLoaded", function() {
        function getQueryParams() {
            let params = {};
            window.location.search.substring(1).split('&').forEach(function(param) {
                let parts = param.split('=');
                params[parts[0]] = decodeURIComponent(parts[1]);
            });
            return params;
        }

        let params = getQueryParams();
        if (params.estado === 'exito') {
            var myModal = new bootstrap.Modal(document.getElementById('exito'));
            myModal.show();
        } else if (params.estado === 'error') {
            var myModal = new bootstrap.Modal(document.getElementById('error'));
            myModal.show();
        }
    });
    </script>

</body>

</html>