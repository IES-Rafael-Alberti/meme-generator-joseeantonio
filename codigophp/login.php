<?php
if(isset($_POST['usuario'])) {
   require("conecta.php");

    // recupera los datos del formulario
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
   
    // prepara la sentencia SQL. Le doy un nombre a cada dato del formulario 
    $sql = "SELECT * FROM usuario WHERE nombre = :usuario AND contraseña = :password";
    // asocia valores a esos nombres
    $datos = array("usuario" => $usuario,
                   "password" => $password
                  );
    // comprueba que la sentencia SQL preparada está bien 
    $stmt = $conn->prepare($sql);
    // ejecuta la sentencia usando los valores
    $stmt->execute($datos);
    if($stmt->rowCount() == 1) {
        session_start();
        $_SESSION["usuario"] = $usuario;
        session_write_close();
        header("Location: index.php");
        exit(0);
    }
    header("Location: login.php");
    exit(0);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<a href="registro.php"><button>Registrarse</button></a>
<form action="" method="post" enctype="multipart/form-data">
    <label for="usuario">Usuario: </label>
    <input type="text" name="usuario" id="usuario">
    <label for="password">Password: </label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Login">
    
</form>    
</body>
</html>