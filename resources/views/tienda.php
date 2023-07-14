<!DOCTYPE html>
<html>
<head>
    <title>Tienda Online</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Tienda Online</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="carrito.php">Carrito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cerrar.php">Cerrar Sesion</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
        <h1>Bienvenido a la Tienda Online</h1>
        <p>Explora nuestra amplia selección de ropa y encuentra las mejores ofertas.</p>
    </div>


    <div class="container">
        <h1>Productos</h1>
        <div class="row">
            <?php
            // Conexión a la base de datos
            $conn = mysqli_connect("127.0.0.1:3307", "root", "", "tienda_online");
            if (!$conn) {
                die("Error de conexión: " . mysqli_connect_error());
            }
            
            // Obtener productos de la base de datos
            $query = "SELECT * FROM productos";
            $result = mysqli_query($conn, $query);
            
            // Mostrar productos en la página
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-lg-3 col-md-4 col-sm-6">';
                echo '<div class="card">';
                echo '<img class="card-img-top" width= "200" height="300" src="'. $row['imagen'] . '" alt="' . $row['nombre'] . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['nombre'] . '</h5>';
                echo '<p class="card-text">' . $row['descripcion'] . '</p>';
                echo '<p class="card-price">S/' . $row['precio'] . '</p>';
                echo '<form method="POST" action="/tienda/agragar">';
                echo '<input type="hidden" name="producto_id" value="' . $row['id'] . '">';
                echo '<button type="submit" class="btn btn-primary">Agregar al Carrito</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            
            
            
            // Cerrar conexión a la base de datos
            mysqli_close($conn);
            ?>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>


