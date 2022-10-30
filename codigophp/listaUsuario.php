<?php

require("testlogin.php");
require("conecta.php");

$nombre = $_SESSION["usuario"];
$id_usuario = $_SESSION["id_usuario"];

$memesSQL ="SELECT * FROM meme WHERE id_usuario = :id_usuario";
$datosSql=array("id_usuario"=>$_SESSION['id_usuario']);
$stmt= $conn->prepare($memesSQL);
$stmt->execute($datosSql);
$memes = $stmt->fetchAll();

foreach($memes as $meme){
    echo("<img width='200px' src='memes/".$meme['ruta']."'>");

}