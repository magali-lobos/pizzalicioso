<?php
include("conexion.php");

// Verifica si se ha proporcionado el parámetro id_pedidos en la URL
$id_pedidos = isset($_GET['id_pedidos']) ? $_GET['id_pedidos'] : null;

if ($id_pedidos !== null) {
    // Intenta eliminar el pedido
    $sql = "DELETE FROM pedidos WHERE id_pedidos='$id_pedidos'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        echo '<script>
        alert("El pedido se eliminó correctamente");
        window.location= "pedidos.php";
        </script> ';
    } else {
        echo '<script>
        alert("El pedido NO se pudo eliminar");
        window.location= "pedidos.php";
        </script> ';
    }
} else {
    echo '<script>
    alert("No se proporcionó un ID de pedido válido");
    window.location= "pedidos.php";
    </script> ';
}

mysqli_close($conexion);
?>
