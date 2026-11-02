<?php 
// procesar datos del formulario

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];

// Validar los datos recibidos
if (empty($nombre) || empty($email) || empty($telefono)) {
    echo "Por favor, complete todos los campos.";
    exit;
}
// con empty entrara en el if si alguno de los campos esta vacio, es decir, si no se ha ingresado ningun valor en alguno de los campos del formulario.

// datos de conexion a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "";
$nombre_base_datos = "formulario";

try{
    // nos conectamos usanndo PDO
    $conexion = new PDO("mysql:host=$servidor;dbname=$nombre_base_datos; charset=utf8", $usuario, $password);

    // configuramos el modo de error de PDO para que lance excepciones
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // preparamos la consulta SQL (Usar ? para evitar inyecciones SQL)
    $sql = "INSERT INTO usuarios (nombre, email, telefono) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    // ejecutamos la consulta con los datos recibidos del formulario
    $stmt->execute([$nombre, $email, $telefono]);
    echo "<h3>Datos guardados correctamente.</h3>";
    echo "<p> Gracias, " . htmlspecialchars($nombre) . ", tus datos han sido guardados.</p>";
}catch(PDOException $e){
    // en el caso de haber algun error lo mostramos
    echo "Error al guardar los datos: " . $e->getMessage();
}