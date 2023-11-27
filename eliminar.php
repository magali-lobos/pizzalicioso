<?php
    $id_pizzas=$_GET['id_pizzas'];
    include("conexion.php");

    $sql="DELETE FROM pizzas where id_pizzas='".$id_pizzas."'";
    $resultado=mysqli_query($conexion,$sql);
 
    if($resultado){
        echo '<script>
        alert("Los datos se eliminaron correctamente");
        window.location= "index.php";
        </script> ';
    }
    else{
        echo '<script>
        alert("Los datos NO se pudieron eliminar");
        window.location= "index.php";
        </script> ';
    }
    mysqli_close($conexion);
?>