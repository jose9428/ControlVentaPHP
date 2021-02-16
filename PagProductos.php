<html  lang="en">
    <head>
        <title>Productos</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link  rel="icon"   href="./librerias/img//icono.png" type="image/png" />
    </head>
    <body class="app sidebar-mini">
        <?php
        session_start();
        if (!isset($_SESSION["usuario"])) :
            header("location: ./index.php");
        endif;


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
                    <h1>Mis Productos</h1>
                    <button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#guardarModal">
                        <i class="fa fa-plus"> Nuevo</i>
                    </button>
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

        <div class="modal  fade" id="guardarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1A66D3 ;color: #ffffff;">
                        <h5 class="modal-title" id="lbTitulo">Nuevo Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="frmGuardar" method="post" >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Nombre del Producto</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nombre" id="nombre" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Precio Compra</label>
                                <div class="col-sm-9">
                                    <input type="text" name="precio_compra" id="precio_compra" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Precio Venta</label>
                                <div class="col-sm-9">
                                    <input type="text" name="precio_venta" id="precio_venta" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Precio Oferta</label>
                                <div class="col-sm-9">
                                    <input type="text" name="precio_oferta" id="precio_oferta" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Cantidad</label>
                                <div class="col-sm-9">
                                    <input type="text" name="cantidad" id="cantidad" class="form-control" onkeypress="solonumeros(event);">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Fecha Vencimiento</label>
                                <div class="col-sm-9">
                                    <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control">
                                </div>
                            </div>

                        </div>     

                        <div class="modal-footer">
                            <input type="hidden" name="accion" value="guardar">
                            <button type="reset" class="btn btn-danger" title="Limpiar Casillas" onclick="Limpiar()">Nuevo</button>
                            <button type="button" class="btn btn-info" onclick="ProcesarGuardar()">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal  fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #1A66D3 ;color: #ffffff;">
                        <h5 class="modal-title" id="lbTitulo">Actualizar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="frmActualizar" method="post" >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Nombre del Producto</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nombre" id="nombre_act" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Precio Compra</label>
                                <div class="col-sm-9">
                                    <input type="text" name="precio_compra" id="precio_compra_act" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Precio Venta</label>
                                <div class="col-sm-9">
                                    <input type="text" name="precio_venta" id="precio_venta_act" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Precio Oferta</label>
                                <div class="col-sm-9">
                                    <input type="text" name="precio_oferta" id="precio_oferta_act" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Cantidad</label>
                                <div class="col-sm-9">
                                    <input type="text" name="cantidad" id="cantidad_act" class="form-control" onkeypress="solonumeros(event);">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Fecha Vencimiento</label>
                                <div class="col-sm-9">
                                    <input type="date" name="fecha_vencimiento" id="fecha_vencimiento_act" class="form-control">
                                </div>
                            </div>

                        </div>     

                        <div class="modal-footer">
                            <input type="hidden" name="accion" value="actualizar">
                            <input type="hidden" name="codigo" id="codigo_act">
                            <button type="reset" id="resetear" class="btn btn-danger" title="Limpiar Casillas" onclick="Limpiar()">Nuevo</button>
                            <button type="button" class="btn btn-info" onclick="ProcesarActualizar()">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include_once './layout/RecursoJs.php'; ?>

    </body>

    <script type="text/javascript">
        $(function () {
            formValidator("#frmGuardar");
            formValidator("#frmActualizar");
            Listar();
        });

        $("#actualizarModal").on("hide.bs.modal", function () {
            $('#frmActualizar').data("bootstrapValidator").destroy();
            $('#frmActualizar').data("bootstrapValidator", null);
            formValidator("#frmActualizar");
        });

        $("#guardarModal").on("hide.bs.modal", function () {
            $('#frmGuardar').data("bootstrapValidator").destroy();
            $('#frmGuardar').data("bootstrapValidator", null);
            formValidator("#frmGuardar");
        });


        function Limpiar() {
            $('#frmGuardar').bootstrapValidator('resetForm', true);
            $('#frmActualizar').bootstrapValidator('resetForm', true);
        }

        function CargarDatos(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                data: "id=" + id,
                url: "./controlador/ControlProducto.php?accion=buscarPorId",
                success: function (data) {

                    $("#nombre_act").val(data[0].nombre_prod);
                    $("#precio_compra_act").val(data[0].precio_compra);
                    $("#precio_venta_act").val(data[0].precio_venta);
                    $("#precio_oferta_act").val(data[0].precio_oferta);
                    $("#fecha_vencimiento_act").val(data[0].fecha_vencimiento);
                    $("#cantidad_act").val(data[0].cantidad);
                    $("#codigo_act").val(data[0].id_prod);
                    $("#actualizarModal").modal("show");
                }
            });
        }

        function Listar() {
            $.ajax({
                type: "GET",
                data: {},
                url: "./controlador/ControlProducto.php?accion=listar",
                beforeSend: function (xhr) {
                    $("#resultado").html("Cargando...");
                },
                success: function (data) {
                    $("#resultado").html(data);
                }
            });
        }

        function ProcesarGuardar() {
            var bootstrapValidator = $("#frmGuardar").data('bootstrapValidator');
            bootstrapValidator.validate();

            if (bootstrapValidator.isValid()) {

                var form = $("#frmGuardar").serialize();
                $.ajax({
                    type: "POST",
                    data: form,
                    url: "./controlador/ControlProducto.php",
                    success: function (data) {
                        if (data === "OK") {
                            $("#guardarModal").modal("hide");
                            alertify.success("Registro realizado con exito!!");
                            $("#frmGuardar")[0].reset();
                            Listar();
                        } else {
                            alertify.alert("Incorrecto", data);
                            //alertify.error(data);
                        }
                    }
                });
            }
        }

        function ProcesarActualizar() {
            var bootstrapValidator = $("#frmActualizar").data('bootstrapValidator');
            bootstrapValidator.validate();

            if (bootstrapValidator.isValid()) {
                var form = $("#frmActualizar").serialize();

                $.ajax({
                    type: "POST",
                    data: form,
                    url: "./controlador/ControlProducto.php",
                    success: function (data) {
                        if (data === "OK") {
                            $("#actualizarModal").modal("hide");
                            alertify.success("Datos actualizados con exito!!");
                            $("#frmActualizar")[0].reset();
                            Listar();
                        } else {
                            alertify.alert("Incorrecto", data);
                           // alertify.error(data);
                        }
                    }
                });
            }
        }

        function Eliminar(id) {
            alertify.confirm('Confirmacion', '¿Esta seguro que desea eliminar el registro con el id ' + id + '?', function () {
                $.ajax({
                    type: "GET",
                    data: "id=" + id,
                    url: "./controlador/ControlProducto.php?accion=eliminar",
                    success: function (data) {
                        if (parseInt(data) > 0) {
                            alertify.success("Eliminado con exito!!");
                            Listar();
                        } else {
                            alertify.error('No se puede eliminar por una dependencia de llave foranea !');
                        }
                    }
                });
            }, function () {
                alertify.error('Cancelo !');
            });

        }

    </script>
    <script type = "text/javascript" >
        function formValidator(form) {
            $(form).bootstrapValidator({
                message: 'Este valor no es valido',
                live: 'enabled',
                feedbackIcons: {
                    //valid: 'fa fa-check',
                    invalid: 'fa fa-remove',
                    validating: 'fa fa-refresh'
                },
                fields: {
                    nombre: {
                        validators: {
                            notEmpty: {
                                message: 'El nombre es un campo obligatorio'
                            }
                        }
                    },
                    fecha_vencimiento: {
                        validators: {
                            notEmpty: {
                                message: 'La fecha de vencimiento es un campo obligatorio'
                            }
                        }
                    },
                    precio_compra: {
                        validators: {
                            notEmpty: {
                                message: 'El precio compra es un campo obligatorio'
                            },
                            regexp: {
                                regexp: /^[0-9]+(\.[0-9]+)?$/,
                                message: 'Formato no valido'

                            }
                        }
                    },
                    precio_venta: {
                        validators: {
                            notEmpty: {
                                message: 'El precio venta es un campo obligatorio'
                            },
                            regexp: {
                                regexp: /^[0-9]+(\.[0-9]+)?$/,
                                message: 'Formato no valido'

                            }
                        }
                    },
                    precio_oferta: {
                        validators: {
                            regexp: {
                                regexp: /^[0-9]+(\.[0-9]+)?$/,
                                message: 'Formato no valido'

                            }
                        }
                    },
                    cantidad: {
                        validators: {
                            notEmpty: {
                                message: 'La cantidad es un campo obligatorio'
                            },
                            regexp: {
                                regexp: /^[0-9]+/,
                                message: 'Formato no valido'

                            }
                        }
                    }
                }
            });
        }

        function solonumeros(e) {
            var key = window.event ? e.which : e.keyCode;
            if (key < 48 || key > 57)
                e.preventDefault();
        }
    </script>

</html>