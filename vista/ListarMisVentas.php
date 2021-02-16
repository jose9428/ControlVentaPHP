<?php
include_once './../modelo/FacturaDAO.php';
$obj = new FacturaDAO();
$data = $obj->getListado();
?>

<div class="table-responsive">
    <table id="example" class="table table-stripped table-bordered table-hover" width="100%">
        <thead style="background-color: #1A66D3 ;color: #ffffff;" >
            <tr class="text-center">
                <th># Factura</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Fecha Venta</th>
                <th>Importe Total</th>
                <th>Ver</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($data as $key => $row) :
                ?>
                <tr class="text-center">
                    <td><?php echo $row[0]; ?></td>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[4]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                    <td>
                        <a href="javascript:void(0)" onclick="CargarDatos(<?= $row[0] ?>)" class="btn btn-info">
                            <i class="fa fa-book"> Ver detalle</i>
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
                },
                "aria": {
                    "sortAscending": "Ordenación ascendente",
                    "sortDescending": "Ordenación descendente"
                }
            }
        });
    });

</script>