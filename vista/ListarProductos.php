<?php
include_once './../modelo/ProductoDAO.php';
$obj = new ProductoDAO();
$data = $obj->getListado();
?>

<style>
    .margin{
        margin-bottom: 5px;
    }

    input[type = "search"]{

    }
</style>
<div class="table-responsive" >
    <table id="example" class="table table-stripped table-bordered table-hover" width="100%" >
        <thead style="background-color: #1A66D3 ;color: #ffffff;" >
            <tr class="text-center">
                <th>Codigo</th>
                <th>Producto</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Precio Oferta</th>
                <th>Cantidad</th>
                <th>Fecha Venc.</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($data as $key => $row) :
                ?>
                <tr class="text-center">
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                    <td><?php echo $row[4]; ?></td>
                    <td><?php echo $row[5]; ?></td>
                    <td><?php echo $row[6]; ?></td>
                    <td>
                        <a href="javascript:void(0)" onclick="CargarDatos(<?= $row[0] ?>)" class="btn btn-info btn-sm">
                            <i class="fa fa-edit"> Modificar</i></a>
                        <a href="javascript:void(0)" onclick="Eliminar(<?= $row[0] ?>)" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"> Eliminar</i>
                        </a>

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