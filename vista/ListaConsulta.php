<?php
$fechaInicio = $_REQUEST["fechaInicio"];
$fechaFin = $_REQUEST["fechaFin"];

include_once './../modelo/FacturaDAO.php';
$obj = new FacturaDAO();
$data = $obj->BuscarPorFechas($fechaInicio, $fechaFin);

date_default_timezone_set('America/Lima');

$fechaActual = date("Y-m-d H:i:s");
?>

<div class="table-responsive">
    <table id="example" class="table table-stripped table-bordered table-hover" width="100%">
        <thead style="background-color: #1A66D3 ;color: #ffffff;" >
            <tr class="text-center">
                <th>Fecha</th>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Compra x Cant.</th>
                <th>Precio Venta x Cant.</th>
                <th>Ganancia</th>
                <th>Cliente</th>
                <th>Vendedor</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($data as $key => $row) :
                ?>
                <tr class="text-center">
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[7]; ?></td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                    <td><?php echo $row[4]; ?></td>
                    <td><?php echo $row[5]; ?></td>
                    <td><?php echo $row[6]; ?></td>
                    <td><?php echo $row[8]; ?></td>
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
                    title: "Reporte de Ventas  <?= $fechaActual ?>",
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
                    title: "Reporte de Ventas  <?= $fechaActual ?>",
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
                    title: "Reporte de Ventas  <?= $fechaActual ?>",
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