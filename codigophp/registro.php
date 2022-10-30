<?php
if(isset($_POST['nombre'])) {
    //print_r($_FILES);
    // Recorrer subida de archivos múltiple
    // $fotos = $_FILES['fotos'];
    // for($i=0; $i < sizeof($fotos["name"]); $i++) {
    //     print_r($fotos["name"][$i] . " -> " . $fotos["tmp_name"][$i]);
    //     print_r("<br>");
    // }
    // exit(0);

    require("conecta.php");

    // recupera los datos del formulario
    $nombre = $_POST["nombre"];
    $password = $_POST["password"];

    // inyectable
    //$sql = "INSERT INTO usuario (nombre, edad, foto) values ('$nombre', $edad, '$foto')";
    
    // prepara la sentencia SQL. Le doy un nombre a cada dato del formulario 
    $sql = "INSERT INTO usuario (nombre, contraseña) values (:nombre, :password)";

    // asocia valores a esos nombres
    $datos = array("nombre" => $nombre,
                   "password" => $password,
                  );
    // comprueba que la sentencia SQL preparada está bien 
    $stmt = $conn->prepare($sql);
    // ejecuta la sentencia usando los valores
    if($stmt->execute($datos) != 1) {
        print("No se pudo dar de alta");
        exit(0);
    }
    //echo('header("Location: index.php");');
    //print_r($_POST);
    //print_r($_FILES);
    //file_put_contents("fotos/perroooo", file_get_contents($_FILES["foto"]["tmp_name"]));
    
    
    exit(0);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre: </label>
    <input type="text" name="nombre" id="nombre">
    <label for="password">Contraseña: </label>
    <input type="password" name="password" id="password">
    <!-- Subida múltiple de archivos
    <input type="file" name="fotos[]" id="foto" multiple>
    -->
    <input type="submit" value="Enviar">
</form>    
</body>
</html>