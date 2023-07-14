<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST["producto_id"];

    // Agregar el producto al carrito
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    // Verificar si el producto ya está en el carrito
    $producto_en_carrito = false;
    foreach ($_SESSION['carrito'] as $producto) {
        if ($producto['id'] == $producto_id) {
            $producto_en_carrito = true;
            break;
        }
    }

    if (!$producto_en_carrito) {
        // Obtener la información del producto desde la base de datos
        $conn = mysqli_connect("127.0.0.1:3307", "root", "", "tienda_online");
        if (!$conn) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM productos WHERE id = $producto_id";
        $result = mysqli_query($conn, $query);
        $producto = mysqli_fetch_assoc($result);

        // Agregar el producto al carrito
        $_SESSION['carrito'][] = $producto;

        mysqli_close($conn);

        echo "El producto ha sido agregado al carrito.";
    } else {
        echo "El producto ya está en el carrito.";
    }
}
?>
