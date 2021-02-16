<html  lang="en">
    <head>
        <title>Kardex</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link  rel="icon"   href="./librerias/img//icono.png" type="image/png" />
    </head>
    <body class="app sidebar-mini">
        <?php
        session_start();
        if (!isset($_SESSION["usuario"])) {
            header("location: ./index.php");
        }

        if ($_SESSION["usuario"][0][3] != "ADMINISTRADOR"):
            header("location: ./PagMisVentas.php");
        endif;
        ?>

        <?php include_once './layout/RecursoCss.php'; ?>
        <?php include_once './layout/Header.php'; ?>
        <?php include_once './layout/Aside.php'; ?>

        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1>Kardex</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="tile">
                        <h3 class="tile-title">Reporte por fechas</h3>
                        <div class="tile-body">
                            <form class="row">
                                <div class="form-group col-md-3">
                                    <label class="control-label">Fecha Inicio</label>
                                    <input class="form-control" type="date" name="fechaInicio" id="fechaInicio" >
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label">Fecha Fin</label>
                                    <input class="form-control" type="date" name="fechaFin" id="fechaFin" >
                                </div>
                                <div class="form-group col-md-4 align-self-end">
                                    <button class="btn btn-info" type="button" onclick="Consultar()"><i class="fa fa-fw fa-lg fa-check-circle" ></i>Consultar</button>
                                </div>
                            </form>
                            <hr>
                            <div id="resultado"></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>



        <?php include_once './layout/RecursoJs.php'; ?>

    </body>

    <script type="text/javascript">
        $(document).ready(function () {
            Consultar();
        });

        function Consultar() {
            var fechaInicio = $("#fechaInicio").val();
            var fechaFin = $("#fechaFin").val();

            $.ajax({
                type: "GET",
                data: {
                    accion: "consultarFechas",
                    fechaInicio: fechaInicio,
                    fechaFin: fechaFin
                },
                url: "./controlador/ControlFactura.php?accion=listar",
                beforeSend: function (xhr) {
                    $("#resultado").html("Cargando...");
                },
                success: function (data) {
                    $("#resultado").html(data);
                }
            });
        }
    </script>
</html>
