<?php
// conexion.php - Conexión a base de datos para comentarios y carrito

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basededatos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
function guardarPedido($datos) {
    global $conn;
    
    $sql = "INSERT INTO pedidos (nombre_cliente, direccion, telefono, metodo_pago, total, productos) 
            VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    
    $productos_json = json_encode($datos['productos']);
    
    $stmt->bind_param("ssssds", 
        $datos['nombre'],
        $datos['direccion'],
        $datos['telefono'],
        $datos['pago'],
        $datos['total'],
        $productos_json
    );
    
    return $stmt->execute();
}
// Cerrar conexión al final del script
$conn->close();
?>