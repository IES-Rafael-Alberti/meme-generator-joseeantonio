<?php
require ("testlogin.php");
require("conecta.php");

$id_meme = $_GET["id_meme"];

// prepara la sentencia SQL. Le doy un nombre a cada dato del formulario
$sql = "DELETE FROM meme WHERE id_meme = :id_meme";
// asocia valores a esos nombres
//$datos = array("idusuario" => $usuario);
// comprueba que la sentencia SQL preparada está bien
$stmt = $conn->prepare($sql);
// método alternativo con bindParam
$stmt->bindParam(":id_meme", $id_meme);
// ejecuta la sentencia usando los valores
//if($stmt->execute($datos) != 1) {
if($stmt->execute() != 1) {
    print("No se pudo borrar");
    exit(0);
}

header("Location: listaUsuario.php");