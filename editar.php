<?php
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pizza</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <?php
    if(isset($_POST['enviar'])){ //aca entra cuando se toca el boton de enviar
        $id_pizzas=$_POST['id_pizzas'];
        $nombre_pizza=$_POST['nombre_pizza'];
        $tamaño_pizza=$_POST['tamaño_pizza'];
        $vegetariana=$_POST['vegetariana'];
        $detalle=$_POST['detalle'];
        $nocontrol=$_POST['nocontrol'];

        $sql = "UPDATE pizzas SET nombre_pizza='$nombre_pizza', tamaño_pizza='$tamaño_pizza', vegetariana='$vegetariana', detalle='$detalle', nocontrol='$nocontrol' where id_pizzas='$id_pizzas'";
        $resultado= mysqli_query($conexion,$sql);
        
        if($resultado){
            echo '<script>
            alert("Los datos fueron actualizados correctamente");
            window.location="index.php";
            </script> ';
        }else{
                echo '<script>
                alert("ERROR: Los datos NO fueron actualizados correctamente");
                window.location="index.php";
                </script> ';
        }
        mysqli_close($conexion);

        }else{

            $id_pizzas=$_GET['id_pizzas'];
            $sql="SELECT * FROM pizzas WHERE id_pizzas='".$id_pizzas."'";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);
            $nombre_pizza=$fila["nombre_pizza"];
            $tamaño_pizza=$fila["tamaño_pizza"];
            $vegetariana=$fila["vegetariana"];
            $detalle=$fila["detalle"];
            $nocontrol=$fila["nocontrol"];

            mysqli_close($conexion);

    ?>
    <h1>Editar pizza</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">

        <label>Nombre: </label>
        <input type="text" name="nombre_pizza" value="<?php echo $nombre_pizza; ?>"><br>

        <label>Tamaño: </label>
        <input type="text" name="tamaño_pizza" value="<?php echo $tamaño_pizza; ?>"><br>

        <label>Vegetariana: </label>
        <input type="text" name="vegetariana" value="<?php echo $vegetariana; ?>"><br>

        <label>Detalle: </label>
        <input type="text" name="detalle" value="<?php echo $detalle; ?>"><br>

        <label>Numero de control: </label>
        <input type="text" name="nocontrol" value="<?php echo $nocontrol; ?>"><br>

        <input type="hidden" name="id_pizzas" value="<?php echo $id_pizzas; ?>">

        <input type="submit" name="enviar" value="ACTUALIZAR">
        <a href="index.php">Regresar</a>

    </form>
    <?php
        }
    ?>
</body>
</html>