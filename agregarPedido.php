<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacer pedido</title>
    <link rel="stylesheet" href="EstiloForm.css">
</head>
<body>

<?php
    if(isset($_POST['enviar'])){
        $nombre_cliente=$_POST['nombre_cliente'];
        $direccion=$_POST['direccion'];
        $telefono=$_POST['telefono'];
        $pizza_seleccionada=$_POST['pizza_seleccionada'];
        $cantidad=$_POST['cantidad'];
        $fecha_pedido=$_POST['fecha_pedido'];

        include("conexion.php");
        $sql= "INSERT into pedidos (nombre_cliente,direccion,telefono,pizza_seleccionada,cantidad,fecha_pedido) 
        VALUES ('".$nombre_cliente."', '".$direccion."', '".$telefono."','".$pizza_seleccionada."', '".$cantidad."', '".$fecha_pedido."')";

        $resultado= mysqli_query($conexion,$sql);

        if($resultado){
            echo '<script>
                    alert("El pedido fue enviado con exito");
                    window.location= "pedidos.php";
                </script> ';
        }else{
            echo '<script>
                    alert("ERROR: NO se pudo completar el pedido");
                    window.location= "pedidos.php";
                 </script> ';
        }
        mysqli_close($conexion);
    }else{

?>
    <h1>Agregar nuevo pedido</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <label>Nombre: </label>
        <input type="text" name="nombre_cliente"> <br>
        <label>Direccion: </label>
        <input type="text" name="direccion"><br>
        <label>Telefono: </label>
        <input type="text" name="telefono"><br>
        <label>Pedido: </label>
        <input type="text" name="pizza_seleccionada"><br>
        <label>Cantidad: </label>
        <input type="number" name="cantidad"><br>
        <label>Fecha: </label>
        <input type="date" name="fecha_pedido"><br>

        <input type="submit" name="enviar" value="AGREGAR">
        <a href="pedidos.php">Regresar</a>

    </form>
<?php
    }
?>
    
</body>
</html>