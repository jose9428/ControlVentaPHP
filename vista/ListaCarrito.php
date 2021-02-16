<?php
session_start();

if (!isset($_SESSION["canasta"])) {
    $carrito = null;
} else {
    $carrito = $_SESSION["canasta"];
}

?>

<div class="table-responsive">
    <form>
        <table id="example" class="table table-stripped table-bordered table-hover" width="100%">
            <thead style="background-color: #1A66D3 ;color: #ffffff;" >
                <tr class="text-center">
                    <th>#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unidad</th>
                    <th>Precio Final</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!isset($_SESSION["canasta"]) || empty($_SESSION["canasta"])) {
                    echo "<tr><td class='text-center' colspan='6'>No se encontraron datos</td></tr>";
                } else {
                    $impTotal = 0.00;
                    $iterador = 0;
                    foreach ($carrito as $indice => $row) {
                        $total = $row[2] * $row[3];
                        $impTotal+= $total;
                        $iterador++;
                        ?>
                        <tr class="text-center">
                            <td><?= $row[0]  ?></td>
                            <td><?= $row[1] ?></td>
                            <td><?= $row[2] ?></td>
                            <td><?= number_format($row[3], 2) ?></td>
                            <td><?= number_format($total, 2) ?></td>
                            <td>
                                <a  href="javascript:AnularCarrito(<?= $indice ?>)"  class="btn btn-danger" title="Quitar de la lista">
                                    <i class="fa fa-trash"> Quitar</i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                    <tr class="text-center">
                        <td colspan='3'>
                            <a href="javascript:ProcesarVenta()" class="btn btn-success btn-lg btn-block" >Procesar venta</a>
                        </td>
                        <td><b>Total a Pagar</b></td>
                        <td><b style="font-size: 18px;"><?= number_format($impTotal, 2) ?></b></td>
                        <td></td>
                    </tr>
                    <tr class="text-center">
                        <td colspan='3'></td>
                        <td><b>Monto a Pagar</b></td>
                        <td>
                            <input type="text" name="montoPagar" onchange="CalcularVuelto(this.value, <?= $impTotal ?>)" id="montoPagar" class="form-control" placeholder="S/." style="text-align:center;">
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr class="text-center">
                        <td colspan='3'>
                        </td>
                        <td><b>De Vuelto</b></td>
                        <td>
                            <input type="text" name="deVuelto" id="deVuelto" class="form-control" placeholder="Monto Vuelto" readonly="" style="text-align:center;">
                        </td>
                        <td></td>
                    </tr>

                    <?php
                }
                ?>

            </tbody>
        </table>
    </form>
</div>
