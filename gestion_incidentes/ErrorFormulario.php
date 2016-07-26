<html>
    <head>
        <meta http-equiv="Refresh" content="5;URL=http://duotronic/incidentes/index.php">
        <title>Pagina para registrar monitor nuevo</title>
        <script type="text/javascript" src="/incidentes/js/jquery-1.11.1.js"></script>
        <link rel="stylesheet" type="text/css" href="/incidentes/css/estilo.css" />
    </head>
    <script>
        $(document).ready(function () {
            stop(2000);
            history.back(2);
        });
    </script>
    <body id="top">
        <?php include_once '../../master.php'; ?>
        <div id="site">
            <div class="center-wrapper">
                <?php include_once '../../menu.php'; ?>
                <div class="main">
                    <div class="post">
                        <li class="no_lista"><h2>Error en el formulario. Redireccionando...</h2></li>
                    </div>
                </div>
                <?php include_once '../../foot.php'; ?>
            </div>
        </div>
    </body>
</html>