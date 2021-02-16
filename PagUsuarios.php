<html  lang="en">
    <head>
        <title>Usuarios</title>
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
                    <h1>Listado de Usuarios</h1>
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
                        <h5 class="modal-title" id="lbTitulo">Nuevo Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="frmGuardar" method="post" >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Nombre</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nombre" id="nombre" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Usuario</label>
                                <div class="col-sm-9">
                                    <input type="text" name="usuario" id="usuario" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Contraseña</label>
                                <div class="col-sm-9">
                                    <input type="text" name="pass" id="pass" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Rol</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="rol" name="rol">
                                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                        <option value="VENDEDOR">VENDEDOR</option>
                                    </select>
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
                        <h5 class="modal-title" id="lbTitulo">Actualizar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="frmActualizar" method="post" >
                        <div class="modal-body">
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Nombre</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nombre" id="nombre_act" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Usuario</label>
                                <div class="col-sm-9">
                                    <input type="text" name="usuario" id="usuario_act" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Contraseña</label>
                                <div class="col-sm-9">
                                    <input type="text" name="pass" id="pass_act" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Rol</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="rol_act" name="rol">
                                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                        <option value="VENDEDOR">VENDEDOR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-3 col-form-label">Estado</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="estado_act" name="estado">
                                        <option value="1">ACTIVO</option>
                                        <option value="0">INACTIVO</option>
                                    </select>
                                </div>
                            </div>
                        </div>     

                        <div class="modal-footer">
                            <input type="hidden" name="accion" value="actualizar">
                            <input type="hidden" name="codigo" id="id_usuario_act">
                            <button type="reset" class="btn btn-danger" title="Limpiar Casillas" onclick="Limpiar()">Nuevo</button>
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
                url: "./controlador/ControlUsuario.php?accion=buscarPorId",
                success: function (data) {

                    $("#nombre_act").val(data[0].nombre);
                    $("#usuario_act").val(data[0].username);
                    $("#pass_act").val(data[0].pass);
                    $("#id_usuario_act").val(data[0].id_usuario);
                    $("#rol_act").val(data[0].rol);
                    $("#estado_act").val(data[0].estado);
                    $("#actualizarModal").modal("show");
                }
            });
        }

        function Listar() {
            $.ajax({
                type: "GET",
                data: {},
                url: "./controlador/ControlUsuario.php?accion=listar",
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
                    url: "./controlador/ControlUsuario.php",
                    success: function (data) {
                        if (data.trim() === "OK") {
                            $("#guardarModal").modal("hide");
                            alertify.success("Usuario realizado con exito!!");
                            $("#frmGuardar")[0].reset();
                            Listar();
                        } else {
                            alertify.alert("Incorrecto", data);
                            // alertify.error(data);
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
                    url: "./controlador/ControlUsuario.php",
                    success: function (data) {
                        if (data.trim() === "OK") {
                            $("#actualizarModal").modal("hide");
                            alertify.success("Datos actualizados con exito!!");
                            $("#frmActualizar")[0].reset();
                            Listar();
                        } else {
                            alertify.alert("Incorrecto", data);
                        }
                    }
                });
            }
        }

        function Eliminar(id) {
            alertify.confirm('Confirmacion', '¿Esta seguro que desea eliminar el usuario con el id ' + id + '?', function () {
                $.ajax({
                    type: "GET",
                    data: "id=" + id,
                    url: "./controlador/ControlUsuario.php?accion=eliminar",
                    success: function (data) {
                        if (parseInt(data) > 0) {
                            alertify.success("Usuario eliminado con exito!!");
                            Listar();
                        } else {
                            alertify.alert("Incorrecto", "No se puede eliminar usuario!");
                            //  alertify.error('No se puede eliminar usuario!');
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
                    usuario: {
                        validators: {
                            notEmpty: {
                                message: 'La usuario es un campo obligatorio'
                            }
                        }
                    },
                    pass: {
                        validators: {
                            notEmpty: {
                                message: 'La contraseña es un campo obligatorio'
                            }
                        }
                    }
                }
            });
        }
    </script>

</html>