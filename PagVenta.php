<html  lang="en">
    <head>
        <title>Nueva Venta</title>
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
                    <h1>Nueva Venta</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <form id="frmSearch">
                                <div class="form-group row">

                                    <label  class="col-sm-3 col-form-label">Buscar Producto</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="search_data" placeholder="" autocomplete="off" class="form-control input-lg" />
                                    </div>

                                </div>
                            </form>
                            <hr>
                            <form id="frmAgregar" method="post" >
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label  class="col-sm-3 col-form-label">Producto</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nombre_act" id="nombre_act" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label  class="col-sm-3 col-form-label">Stock</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cantidad_act" id="cantidad_act" class="form-control" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label  class="col-sm-3 col-form-label" id="texto_venta_act">Precio Venta</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="precio_venta_act" id="precio_venta_act" class="form-control" readonly> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label  class="col-sm-3 col-form-label">Cantidad</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Ingrese Cantidad" min="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAgregarOferta">
                                            <label class="form-check-label" for="checkAgregarOferta" id="nombreOferta">
                                                Agregar Precio Oferta
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-row mt-2">
                                    <div class="col">
                                        <input type="hidden" name="accion" value="agregar">
                                        <input type="hidden" name="codigo_act" id="codigo_act">
                                        <input type="hidden" name="aux_precio_oferta" id="aux_precio_oferta">
                                        <input type="hidden" name="precio_compra_act" id="precio_compra_act">
                                        <input type="hidden" name="aux_precio_venta" id="aux_precio_venta">
                                        <button class="btn btn-success" type="button" id="btnAgregar" onclick="AgregarCarrito()">Agregar</button>
                                    </div>
                                </div>
                            </form>
                            <div id="resultado">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include_once './layout/RecursoJs.php'; ?>

    </body>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#checkAgregarOferta").attr('disabled', 'disabled');
            $("#btnAgregar").attr('disabled', 'disabled');
            ListarCarrito();
        });

        function Mensaje(titulo, mensaje, opcion) {
            alertify.alert(titulo, mensaje);
        }

        function ProcesarVenta() {
            alertify.prompt('Procesar Venta', 'Ingrese nombre del cliente', '', function (evt, value) {
                $.ajax({
                    type: "GET",
                    data: {
                        accion: "procesar_compra",
                        cliente: value
                    },
                    url: "./controlador/ControlCarrito.php",
                    success: function (data) {
                        if (parseInt(data) > 0) {
                            alertify.success("Venta Procesada correctamente.!!");
                            setTimeout(function () {
                                $(location).attr("href", "./PagMisVentas.php");
                            }, 2000);

                        } else {
                            alertify.error('La venta no se ha podido procesar');
                        }
                    }
                });
            }
            , function () {
                alertify.error('Cancelo :(');
            });

        }

        function CalcularVuelto(valor, total) {
            var vuelto = valor - total;
            $("#deVuelto").val(vuelto.toFixed(2));
        }

        function ListarCarrito() {
            $.ajax({
                type: "GET",
                data: {},
                url: "./controlador/ControlCarrito.php?accion=listar",
                beforeSend: function (xhr) {
                    $("#resultado").html("Cargando...");
                },
                success: function (data) {
                    $("#resultado").html(data);
                }
            });
        }

        function AnularCarrito(indice) {
            $.ajax({
                type: "GET",
                data: {
                    accion: "anular",
                    key: indice
                },
                url: "./controlador/ControlCarrito.php",
                success: function (data) {
                    alertify.success("eliminado correctamente!!");
                    ListarCarrito();
                }
            });
        }

        $(document).ready(function () {
            $("#search_data").autocomplete({
                select: function (event, ui) {
                    //$("#frmSearch")[0].reset();
                    var id = ui.item.value;
                    CargarProducto(id);
                    ui.item.value = "";
                },
                source: function (request, response) {
                    $.ajax({
                        url: './controlador/ControlProducto.php',
                        dataType: "json",
                        data: {
                            search: $("#search_data").val(),
                            accion: "filtroListaJson2"
                        },
                        success: function (data) {
                            response($.map(data, function (item) {
                                // $("#search_data").remove();
                                return {label: item.nombre_prod, value: item.id_prod};
                            }));
                        },
                        error: function (xhr, status, error) {
                            alertify.error("Error al momento de cargar la data");
                        }
                    });
                }
            });
        });

        $("#checkAgregarOferta").click(function () {
            if ($(this).is(':checked')) {
                var oferta = $("#aux_precio_oferta").val();
                $("#precio_venta_act").val(oferta);
                $("#nombreOferta").html("Quitar precio oferta");
                $("#texto_venta_act").html("Precio Oferta");

            } else {
                var oferta = $("#aux_precio_venta").val();
                $("#precio_venta_act").val(oferta);
                $("#nombreOferta").html("Agregar precio oferta");
                $("#texto_venta_act").html("Precio Venta");
            }
        });

        function AgregarCarrito() {
            var form = $("#frmAgregar").serialize();
            var stockActual = $("#cantidad_act").val();
            var cantidad = $("#cantidad").val();

            if (cantidad === "" || parseFloat(cantidad) <= 0) {
                alertify.alert("Incorrecto", "Ingrese una cantidad valida.");
            } else if (parseFloat(cantidad) > stockActual) {
                alertify.alert("Incorrecto", "Stock no disponible.");
            } else {
                var form = $("#frmAgregar").serialize();

                $.ajax({
                    type: "GET",
                    data: form,
                    url: "./controlador/ControlCarrito.php",
                    success: function (data) {
                        if (data === "OK") {
                            alertify.success("Agregado correctamente!!");
                            // Resetear Formulario
                            $("#frmAgregar")[0].reset();
                            $("#checkAgregarOferta").attr('disabled', 'disabled');
                            $("#btnAgregar").attr('disabled', 'disabled');
                            $("#texto_venta_act").html("Precio Venta");
                            ListarCarrito();
                        } else {
                            alertify.alert("Incorrecto", data);
                            //   alertify.error(data);
                        }
                    }
                });

            }
        }

        function CargarProducto(id) {

            $.ajax({
                type: "GET",
                dataType: 'json',
                data: "id=" + id,
                url: "./controlador/ControlProducto.php?accion=buscarPorId",
                success: function (data) {
                    var precioOferta = data[0].precio_oferta;
                    $("#nombre_act").val(data[0].nombre_prod);
                    $("#precio_compra_act").val(data[0].precio_compra);
                    $("#precio_venta_act").val(data[0].precio_venta);
                    $("#precio_oferta_act").val(data[0].precio_oferta);
                    $("#fecha_vencimiento_act").val(data[0].fecha_vencimiento);
                    $("#cantidad_act").val(data[0].cantidad);
                    $("#codigo_act").val(data[0].id_prod);

                    if (precioOferta !== null && precioOferta !== "null" && parseFloat(precioOferta) > 0.00) {
                        $("#aux_precio_oferta").val(precioOferta);
                        $("#aux_precio_venta").val(data[0].precio_venta);
                        $("#checkAgregarOferta").removeAttr("disabled");
                    } else {
                        $("#checkAgregarOferta").attr('disabled', 'disabled');
                    }

                    $("#nombreOferta").html("Agregar precio oferta");
                    $("#checkAgregarOferta").prop("checked", false);

                    if (parseFloat(data[0].cantidad) <= 0) {
                        $("#btnAgregar").attr('disabled', 'disabled');
                        $("#checkAgregarOferta").attr('disabled', 'disabled');
                        alertify.error("No se encontro suficiente stock disponible para vender.");
                    } else {
                        $("#btnAgregar").removeAttr("disabled");
                    }
                }
            });
        }
    </script>
</html>