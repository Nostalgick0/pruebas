<?php
//agrego la clase producto
include('../clases/producto.php');
$producto = New Producto();

//recibo los datos del formulario previo
$fkproducto = $_POST['fkproducto'];
$cantidad = $_POST["cantidad"];

//incluyo la clase venta
include('../clases/venta.php');
$venta = New Venta();

//busco si el usuario tiene un carrito activo
$carritoActivo=$venta->verCarrito(1); //le envio 1 porque deje un usuario estatico, pero deberia ser el usuario logueado usando por ejemplo $_SESSION['idusuario];
if(mysqli_num_rows($carritoActivo)>0){
    $carrito=mysqli_fetch_assoc($carritoActivo);
    $fkventa=$carrito['idventa'];
}else{
    //creo una venta
    $fkventa = $venta->insertar(null, 0, 1, 0);
}

//obtengo los datos del producto
$datosProducto=mysqli_fetch_assoc($producto->mostrarPorId($fkproducto));

//identifico el dato del precio
$precio=$datosProducto['precio'];

//calculamos el subtotal
$subtotal=$precio*$cantidad;

//enviamos los datos que obtuvimos de diferentes formas arriba
$respuesta = $producto->agregarCarrito($fkventa, $fkproducto, $cantidad, 0);
if($respuesta){
    echo"<div style='backgorund-color:green; font-size:30px; color:green; padding:20px'>Agregado a carrito</div>";
}
else{
    echo"No se pudo agregar al carrito";
}
?>