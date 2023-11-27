<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>
    <link rel="stylesheet" href="EstiloForm.css">

    <script type="text/javascript">
        function confirmar(){
            return('¿Estas seguro/a? se eliminaran los datos');
        }
    </script>
</head>
<body>
<?php  //este codigo se encarga de mostrar todos los pedidos realizados por el usuario
include("conexion.php");
$sql ="select * from pedidos";
$resultado=mysqli_query($conexion,$sql);
?>
    <table>
            <tr>
                <th colspan="10"><h1>Pedido</h1></th>
            </tr>
            <tr>
            <td>
            <a href="pedidos.php">Mostrar todo el pedido</a>
            </td>
            <td>
            <a href="agregarPedido.php">Agregar otro pedido</a>
            </td>
            <td>
            <a href="index.html">Volver a la página principal</a>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
            <th>Id</th>
            <th>Nombre:</th>
            <th>Direccion:</th>
            <th>Telefono</th>
            <th>Pedido</th>
            <th>Cantidad</th>
            <th>Fecha de pedido</th>
            <th>Acciones</th>
            </tr>
        </thead>
    
    <tbody>
        <?php
        while($filas=mysqli_fetch_assoc($resultado)){
        ?>
        <tr>
            <td><?php echo $filas['id_pedidos']?></td>
            <td><?php echo $filas['nombre_cliente'] ?></td>
            <td><?php echo $filas['direccion'] ?></td>
            <td><?php echo $filas['telefono'] ?></td>
            <td><?php echo $filas['pizza_seleccionada'] ?></td>
            <td><?php echo $filas['cantidad'] ?></td>
            <td><?php echo $filas['fecha_pedido'] ?></td>
            <td>
                <?php echo "<a href='editarPedido.php?id_pedidos=".$filas['id_pedidos']."'>EDITAR</a>; " ?>
                <?php echo "<a href='eliminarPedido.php?id_pedidos=".$filas['id_pedidos']."' onclick='return confirmar()'>ELIMINAR </a>;" ?>
            </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    </table>
    <?php
    mysqli_close($conexion);
    ?>
</body>
</html>