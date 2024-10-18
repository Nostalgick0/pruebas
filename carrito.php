<?php

include('clases/venta.php');
$venta=new Venta();

//busco la venta, puse el 1 porque es el usuario con el id=1 pero deberia ser el id del usuario logueado. 
//El 0 es el estatus, ya que busco las ventas que son de carrito (estatus 0)
$datos=$venta->mostrarVenta(1,0);

?>

<h2>Carrito de compras</h2>
<table>
    <tr>
        <!-- Colspan define el numero de columnas combinadas -->
        <th colspan="2">Producto</th>
        <th>Cantidad</th>
        <th>Importe</th>
    </tr>
    <?php
        foreach ($datos as $fila) {
            $total+=$fila['subtotal'];
    ?>
        <tr>
            <td><?=$fila['nombre']?></td>
            <td><?=$fila['cantidad']?></td>
        <td><?=$fila['subtotal']?></td>
        </tr>
    <?php
        }
    ?>
    <tr>
        <th colaspan="3">Total:</th>
        <th><?=$total?></th>
    </tr>
</table>