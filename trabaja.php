<?php
$nombre= $_POST['nombre'];
$dni= $_POST['dni'];
$sexo= $_POST['sexo'];
$fecha= $_POST['fecha'];
$ciudad= $_POST['ciudad'];
$nacionalidad= $_POST['nacionalidad'];
$codigo= $_POST['codigo'];
$email= $_POST['email'];
$telefono= $_POST['telefono'];
$titulacion = $_POST['titulacion'];
$anio_inicio = $_POST['anio_inicio'];
$anio_fin = $_POST['anio_fin'];
$idioma = $_POST['idioma'];

// Validar los datos recibidos
if (empty($nombre) || empty($dni) || empty($sexo) || empty($fecha) || empty($ciudad) || empty($nacionalidad) || empty($codigo) || empty($email) || empty($telefono) || empty($titulacion) || empty($anio_inicio) || empty($anio_fin) || empty($idioma)) {
    echo "Por favor, complete todos los campos.";
    exit;
}

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
    $sql = "INSERT INTO usuarios (nombre, dni, sexo, fecha, ciudad, nacionalidad, codigo, email, telefono, titulacion, anio_inicio, anio_fin, idioma) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    // ejecutamos la consulta con los datos recibidos del formulario
    $stmt->execute([$nombre, $dni, $sexo, $fecha, $ciudad, $nacionalidad, $codigo, $email, $telefono, $titulacion, $anio_inicio, $anio_fin, $idioma]);
    echo "<h3>Datos guardados correctamente.</h3>";
    echo "<p> Gracias, " . htmlspecialchars($nombre) . ", tus datos han sido guardados.</p>";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>