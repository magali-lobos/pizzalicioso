<?php
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de pizzas</title>
    <script type="text/javascript">
        function confirmar(){
            return('¿Estas seguro/a? se eliminaran los datos');
        }
    </script>
    <link rel="stylesheet" href="listaPizzasEstilo.css">
</head>
<body>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <table>
            <tr>
                <th colspan="10"><h1>Lista de pizzas</h1></th>
            </tr>
            <tr>
                <td>
                    <label>Nombre: </label>
                    <input type="text" name="nombre_pizza"> <br>
                </td>
                <td>
                   <!-- <label>Tamaño: </label>
                    <input type="text" name="tamaño_pizza"><br>
                </td>
                <td>
                    <label>Vegetariana: </label>
                    <input type="text" name="vegetariana"><br>
                </td>
                <td>
                    <label>Detalle: </label>
                    <input type="text" name="detalle"><br>
                <td>-->
                    <label>Numero de control: </label>
                    <input type="text" name="nocontrol"><br>
                </td>
                <td>
                    <input type="submit" name="enviar" value="BUSCAR">
                </td>
                <td>
                    <a href="todasLasPizzas.php">Mostrar todas las pizzas</a>
                </td>
                <td>
                <a href="agregar.php">Nueva pizza</a>
                </td>
            </tr>
        </table>
    </form>
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
                    if(isset($_POST['enviar'])){ //muestra la busqueda
                        $nombre_pizza=$_POST['nombre_pizza'];
                        //$tamaño_pizza=$_POST['tamaño_pizza'];
                        //$vegetariana=$_POST['vegetariana'];
                        //$detalle=$_POST['detalle'];
                        $nocontrol=$_POST['nocontrol'];

                        if(empty($_POST['nombre_pizza']) && /*empty($_POST['tamaño_pizza']) && empty($_POST['vegetariana']) && empty($_POST['detalle']) &&*/ empty($_POST['nocontrol'])){
                            echo '<script>
                            alert("Ingresa algun dsto en el campo de busqueda");
                            window.location= "index.php";
                            </script> ';
                        }
                        else{
                            if(empty($_POST['nombre_pizza'])){
                                $sql="select * from pizzas where nocontrol=".$nocontrol;
                            }
                            if(empty($_POST['nombre_pizza'])){
                                $sql="select * from pizzas where nombre_pizza like '%".$nombre_pizza."%' ";
                            }
                            if(!empty($_POST['nombre_pizza']) && empty($_POST['nocontrol'])){
                                $sql= "select * from pizzas where nocontrol=".$nocontrol." and nombre_pizza like '%".$nombre_pizza."%'";
                            }
                        }

                        $resultado=mysqli_query($conexion,$sql);
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
                    }else{ //muestra todas las pizzas
                        $sql ="select * from pizzas";
                        $resultado=mysqli_query($conexion,$sql);
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
                }
                ?>
        </tbody>
    </table>
</body>
</html>