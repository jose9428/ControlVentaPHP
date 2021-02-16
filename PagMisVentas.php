<html  lang="en">
    <head>
        <title>Mis Ventas</title>
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
        ?>

        <?php include_once './layout/RecursoCss.php'; ?>
        <?php include_once './layout/Header.php'; ?>
        <?php include_once './layout/Aside.php'; ?>

        <main class="app-content">
            <div class="app-title">
                <div>
                    <h1>Mis Ventas</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <div id="resultado"></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div class="modal fade bd-example-modal-lg" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary" style="color: white;">
                        <h5 class="modal-title" id="lbTitulo">Detalle Venta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped text-center" id="sampleTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="detalleResultado">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <?php include_once './layout/RecursoJs.php'; ?>

    </body>

    <script type="text/javascript">
        $(document).ready(function () {
            Listar();
        });

        function CargarDatos(nroFactura) {
            var cadena = "";
            $.ajax({
                type: "GET",
                dataType: 'JSON',
                data: {
                    nro_factura: nroFactura,
                    accion: "verDetalle"
                },
                url: "./controlador/ControlFactura.php",
                success: function (data) {
                    if (data.length === 0) {
                        cadena += "<tr><td class='text-center' colspan=5>No se encontraron registros</td></tr>";
                    } else {
                        $.each(data, function (i, item) {
                            var venta = parseFloat(item.precio_venta);
                            var total = parseFloat(venta * item.cantidad_adquirida);
                            cadena += "<tr class='text-center' >";
                            cadena += "<td>" + (i + 1) + "</td>";
                            cadena += "<td>" + item.nombre_prod + "</td>";
                            cadena += "<td>" + venta.toFixed(2) + "</td>";
                            cadena += "<td>" + item.cantidad_adquirida + "</td>";
                            cadena += "<td>" + total.toFixed(2) + "</td>";
                            cadena += "</tr>";
                        });
                    }

                    $("#detalleResultado").html(cadena);
                    $("#detalleModal").modal("show");
                }
            });

        }

        function Listar() {
            $.ajax({
                type: "GET",
                data: {},
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
