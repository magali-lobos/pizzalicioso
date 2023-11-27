<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica si 'id_pedidos' está presente en $_POST antes de intentar acceder a él
    $id_pedidos = isset($_POST['id_pedidos']) ? $_POST['id_pedidos'] : null;

    if ($id_pedidos !== null) {
        $nombre_cliente = $_POST['nombre_cliente'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $pizza_seleccionada = $_POST['pizza_seleccionada'];
        $cantidad = $_POST['cantidad'];
        $fecha_pedido = $_POST['fecha_pedido'];

       
        $sql = "UPDATE pedidos
        SET nombre_cliente='$nombre_cliente', direccion='$direccion', telefono='$telefono',
            pizza_seleccionada='$pizza_seleccionada', cantidad='$cantidad', fecha_pedido='$fecha_pedido'
        WHERE id_pedidos='$id_pedidos'";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            echo '<script>
            alert("Los datos fueron actualizados correctamente");
            window.location="pedidos.php";
            </script> ';
        } else {
            echo '<script>
            alert("ERROR: Los datos NO fueron actualizados correctamente");
            window.location="pedidos.php";
            </script> ';
        }

        mysqli_close($conexion);
    }
} else {
    // Verifica si 'id_pedidos' está presente en $_GET antes de intentar acceder a él
    $id_pedidos = isset($_GET['id_pedidos']) ? $_GET['id_pedidos'] : null;

    if ($id_pedidos !== null) {
        $sql = "SELECT pedidos.*, pizzas.nombre_pizza
                FROM pedidos
                JOIN pedidos_pizzas ON pedidos.id_pedidos = pedidos_pizzas.id_pedidos
                JOIN pizzas ON pedidos_pizzas.id_pizzas = pizzas.id_pizzas
                WHERE pedidos.id_pedidos='$id_pedidos'";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            $fila = mysqli_fetch_assoc($resultado);
            $nombre_cliente = $fila["nombre_cliente"];
            $direccion = $fila["direccion"];
            $telefono = $fila["telefono"];
            $pizza_seleccionada = $fila["nombre_pizza"];  // Obtenemos el nombre de la pizza directamente desde la tabla pizzas
            $cantidad = $fila["cantidad"];
            $fecha_pedido = $fila["fecha_pedido"];

            mysqli_close($conexion);
        } else {
            // Manejo de error si la consulta no tiene éxito
            echo "Error en la consulta: " . mysqli_error($conexion);
            die(); // Detiene la ejecución del script en caso de error
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pedido</title>
    <link rel="stylesheet" href="EstiloForm.css">
</head>
<body>
    <h1>Editar pizza</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

    <label for="nombre_cliente">Nombre: </label>
    <input type="text" name="nombre_cliente" id="nombre_cliente" value="<?= isset($nombre_cliente) ? $nombre_cliente : '' ?>"><br>

    <label for="direccion">Direccion: </label>
    <input type="text" name="direccion" id="direccion" value="<?= isset($direccion) ? $direccion : '' ?>"><br>

    <label for="telefono">Telefono: </label>
<input type="text" name="telefono" id="telefono" value="<?= isset($telefono) ? $telefono : '' ?>"><br>

<label for="pizza_seleccionada">Pedido: </label>
<input type="text" name="pizza_seleccionada" id="pizza_seleccionada" value="<?= isset($pizza_seleccionada) ? $pizza_seleccionada : '' ?>"><br>

<label for="cantidad">Cantidad: </label>
<input type="number" name="cantidad" id="cantidad" value="<?= isset($cantidad) ? $cantidad : '' ?>"><br>

<label for="fecha_pedido">Fecha de pedido: </label>
<input type="date" name="fecha_pedido" id="fecha_pedido" value="<?= isset($fecha_pedido) ? $fecha_pedido : '' ?>"><br>


    <input type="submit" name="enviar" value="ACTUALIZAR">
    <a href="pedidos.php">Regresar</a>
    </form>
</body>
</html>
