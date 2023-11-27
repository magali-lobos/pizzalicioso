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

        $sql = "UPDATE pedidos SET nombre_cliente='$nombre_cliente', direccion='$direccion', telefono='$telefono', pizza_seleccionada='$pizza_seleccionada', cantidad='$cantidad', fecha_pedido='$fecha_pedido' WHERE id_pedidos='$id_pedidos'";
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
        $sql = "SELECT * FROM pedidos WHERE id_pedidos='$id_pedidos'";
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            $fila = mysqli_fetch_assoc($resultado);
            $nombre_cliente = $fila["nombre_cliente"];
            $direccion = $fila["direccion"];
            $telefono = $fila["telefono"];
            $pizza_seleccionada = $fila["pizza_seleccionada"];
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

    <label>Nombre: </label>
    <input type="text" name="nombre_cliente" value="<?= isset($nombre_cliente) ? $nombre_cliente : '' ?>"><br>

    <label>Direccion: </label>
    <input type="text" name="direccion" value="<?= isset($direccion) ? $direccion : '' ?>"><br>

    <label>Telefono </label>
    <input type="text" name="telefono" value="<?= isset($telefono) ? $telefono : '' ?>"><br>

    <label>Pedido: </label>
    <input type="text" name="pizza_seleccionada" value="<?= isset($pizza_seleccionada) ? $pizza_seleccionada : '' ?>"><br>

    <label>Cantidad: </label>
    <input type="number" name="cantidad" value="<?= isset($cantidad) ? $cantidad : '' ?>"><br>

    <label>Fecha de pedido: </label>
    <input type="date" name="fecha_pedido" value="<?= isset($fecha_pedido) ? $fecha_pedido : '' ?>"><br>

    <input type="hidden" name="id_pedidos" value="<?= isset($id_pedidos) ? $id_pedidos : '' ?>">

    <input type="submit" name="enviar" value="ACTUALIZAR">
    <a href="pedidos.php">Regresar</a>
    </form>
</body>
</html>
