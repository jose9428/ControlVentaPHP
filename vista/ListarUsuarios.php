<?php
session_start();
include_once './../modelo/UsuarioDAO.php';
$obj = new UsuarioDAO();
$data = $obj->getListado();
?>

<style>
    .margin{
        margin-bottom: 5px;
    }

    .disabled {
        pointer-events: none;
        cursor: default;
    }

</style>
<div class="table-responsive" >
    <table id="example" class="table table-stripped table-bordered table-hover" width="100%" >
        <thead style="background-color: #1A66D3 ;color: #ffffff;" >
            <tr class="text-center">
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Accion</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($data as $key => $row) :
                $estado = $row[5] == "1" ? "ACTIVO" : "INACTIVO";
                $clase = $row[5] == "1" ? "success" : "danger";
                ?>
                <tr class="text-center">
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[4]; ?></td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                    <td>
                        <span class="badge badge-<?= $clase ?>">
                            <?php echo $estado; ?>
                        </span>
                    </td>
                    <td>
                        <?php
                        if ($_SESSION["usuario"][0][3] == "ADMINISTRADOR" && $row[3] == "ADMINISTRADOR"):
                            ?>
                            <a href="javascript:void(0)" onclick="CargarDatos(<?= $row[0] ?>)" class="btn btn-info disabled">
                                <i class="fa fa-edit"> Modificar</i>
                            </a>
                            <?php
                        else:
                            ?>
                            <a href="javascript:void(0)" onclick="CargarDatos(<?= $row[0] ?>)" class="btn btn-info">
                                <i class="fa fa-edit"> Modificar</i>
                            </a>    
                        <?php
                        endif;
                        ?>




                        <?php
                        if ($_SESSION["usuario"][0][3] == "ADMINISTRADOR" && $row[3] == "ADMINISTRADOR"):
                            ?>
                            <a href="javascript:void(0)" onclick="Eliminar(<?= $row[0] ?>)" class="btn btn-danger disabled" >
                                <i class="fa fa-trash"> Eliminar</i>
                            </a>
                            <?php
                        else:
                            ?>
                            <a href="javascript:void(0)" onclick="Eliminar(<?= $row[0] ?>)" class="btn btn-danger" >
                                <i class="fa fa-trash"> Eliminar</i>
                            </a>       
                        <?php
                        endif;
                        ?>

                    </td>

                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "language": {
                "emptyTable": "<i>No hay datos disponibles en la tabla.</i>",
                "info": "Del _START_ al _END_ de _TOTAL_ ",
                "infoEmpty": "Mostrando 0 registros de un total de 0.",
                "infoFiltered": "(filtrados de un total de _MAX_ registros)",
                "infoPostFix": "(actualizados)",
                "lengthMenu": "Mostrar _MENU_ registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "<span style='font-size:15px;'>Buscar:</span>",
                "searchPlaceholder": "Buscar",
                "zeroRecords": "No se han encontrado coincidencias.",
                "paginate": {
                    "first": "Primera",
                    "last": "Última",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            //dom: 'Bfrtilp',
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i> ',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn btn-success margin',
                    exportOptions: {
                        // columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i> ',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger margin',
                    exportOptions: {
                        // columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> ',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-info margin',
                    exportOptions: {
                        // columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fa fa-filter"></i> ',
                    titleAttr: 'Filtrar por columnas',
                    className: 'btn btn-primary margin',
                    exportOptions: {
                        // columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        columns: ':visible'
                    }
                }
            ]
        });

    });
</script>