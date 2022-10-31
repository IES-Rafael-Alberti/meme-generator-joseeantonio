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
    $datosUsuario = $stmt->fetch();
    if($stmt->rowCount() == 1) {
        session_start();
        $_SESSION["usuario"] = $usuario;
        $_SESSION['id_usuario']=$datosUsuario['id_usuario'];
        session_write_close();
        header("Location: listaUsuario.php");
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
    <style>
        form{
            padding: 60px;
            max-width: 400px;
            background-color: #E7E7E7;
            margin: 0 auto;
        }

        form input, form textarea{
            margin-bottom: 15px;
            font-family: "Roboto", sans-serif;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: none;
            color: #525c66;
            font-size: 1em;
            resize: none;
        }

        .botonLogin {
            display: block;
            background-color: #0095eb;
            padding: 10px 45px 10px 45px;
            border: 0;
            font-size: 1em;
            color: 	white;
            font-family: "Roboto", sans-serif;
        }
        .botonLogin: hover{
            background-color: #046193;
        }
        textarea {  resize: none;}
        .botonRegistro{
            width: 100%;
            display: flex;
            justify-content: center;
            background-color: #046193;
            text-decoration: none;
            color: white;
        }
        h2{
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>

<h2>LOGIN</h2>
<form action="" method="post" enctype="multipart/form-data">
    <label for="usuario">Usuario: </label>
    <input type="text" name="usuario" id="usuario">
    <label for="password">Password: </label>
    <input type="password" name="password" id="password">
    <input class="botonLogin" type="submit" value="Login">
    <a class="botonRegistro" href="registro.php">Registrarse</a>
    
</form>    
</body>
</html>