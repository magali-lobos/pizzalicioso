<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de pizzas</title>
    <link rel="stylesheet" href="listaPizzasEstilo.css">
    <script type="text/javascript">
        function confirmar(){
            return('¿Estas seguro/a? se eliminaran los datos');
        }
    </script>
</head>
<body>
<?php
include("conexion.php");
$sql ="select * from pizzas";
$resultado=mysqli_query($conexion,$sql);
?>

    <h1>Lista de pizzas</h1>
    <a href="agregar.php">Nueva pizza</a><br><br>

    <table>
        <thead>
            <tr>
            <th>Id</th>
            <th>Nombre de pizza</th>
            <th>Tamaño pizza</th>
            <th>Vegetariana</th>
            <th>Detalle</th>
            <th>No. control</th>
            <th>Acciones</th>
            </tr>
        </thead>
    
    <tbody>
        <?php
        while($filas=mysqli_fetch_assoc($resultado)){
        ?>
        <tr>
            <td><?php echo $filas['id_pizzas']?></td>
            <td><?php echo $filas['nombre_pizza'] ?></td>
            <td><?php echo $filas['tamaño_pizza'] ?></td>
            <td><?php echo $filas['vegetariana'] ?></td>
            <td><?php echo $filas['detalle'] ?></td>
            <td><?php echo $filas['nocontrol'] ?></td>
            <td>
                <?php echo "<a href='editar.php?id_pizzas=".$filas['id_pizzas']."'>EDITAR</a>; " ?>
                <?php echo "<a href='eliminar.php?id_pizzas=".$filas['id_pizzas']."' onclick='return confirmar()'>ELIMINAR </a>;" ?>
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
    <a href="listaPizzas.php">Regresar</a>
</body>
</html>