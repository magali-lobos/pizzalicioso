<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar pizzas</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<?php
    if(isset($_POST['enviar'])){
        $nombre_pizza=$_POST['nombre_pizza'];
        $tamaño_pizza=$_POST['tamaño_pizza'];
        $vegetariana=$_POST['vegetariana'];
        $detalle=$_POST['detalle'];
        $nocontrol=$_POST['nocontrol'];

        include("conexion.php");
        $sql= "INSERT into pizzas (nombre_pizza,tamaño_pizza,vegetariana,detalle,nocontrol) 
        VALUES ('".$nombre_pizza."', '".$tamaño_pizza."', '".$vegetariana."','".$detalle."', '".$nocontrol."')";

        $resultado= mysqli_query($conexion,$sql);

        if($resultado){
            echo '<script>
                    alert("Los datos fueron ingresados correctamente a la base de datos");
                    window.location= "index.php";
                </script> ';
        }else{
            echo '<script>
                    alert("ERROR: Los datos NO fueron ingresados correctamente a la base de datos");
                    window.location= "index.php";
                 </script> ';
        }
        mysqli_close($conexion);
    }else{

?>
    <h1>Agregar nueva pizza</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <label>Nombre: </label>
        <input type="text" name="nombre_pizza"> <br>
        <label>Tamaño: </label>
        <input type="text" name="tamaño_pizza"><br>
        <label>Vegetariana: </label>
        <input type="text" name="vegetariana"><br>
        <label>Detalle: </label>
        <input type="text" name="detalle"><br>
        <label>Numero de control: </label>
        <input type="text" name="nocontrol"><br>

        <input type="submit" name="enviar" value="AGREGAR">
        <a href="index.php">Regresar</a>

    </form>
<?php
    }
?>
    
</body>
</html>