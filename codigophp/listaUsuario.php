<?php

require("testlogin.php");
require("conecta.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <style>
        header{
            display: flex;
            justify-content: space-around;
            background-color: black;
            text-align: center;
        }
        .logo{
            max-height: 100px;
        }
        header h1{
            color: aliceblue;
        }
        nav{
            color: aliceblue;
        }
        nav a i{
            color: darkred;
        }
    </style>
</head>
<body>
<header>
    <img class="logo" src="img/logo.png">
    <h1 id="title">MEMES</h1>
    <nav>
        <h3><?php
        echo($_SESSION['usuario']);
        ?></h3>
        <a href="logout.php"><i class="fa-sharp fa-solid fa-power-off"></i></a>
    </nav>
</header>

<main>


    <?php

    $nombre = $_SESSION["usuario"];
    $id_usuario = $_SESSION["id_usuario"];

    $memesSQL ="SELECT * FROM meme WHERE id_usuario = :id_usuario";
    $datosSql=array("id_usuario"=>$_SESSION['id_usuario']);
    $stmt= $conn->prepare($memesSQL);
    $stmt->execute($datosSql);
    $memes = $stmt->fetchAll();

    echo ("<a href='index.php'><i class='fa-solid fa-plus'>Añadir meme</i></a>");
    echo ("<br>");
    foreach($memes as $meme){
        echo("<img width='200px' src='memes/".$meme['ruta']."?id_meme=".$meme['id_meme']."'>");
        echo("<a href='borrarmeme.php?id_meme=".$meme["id_meme"]."' ><i class='fa-solid fa-trash'></i></a>") ;

    }

   ?>


</main>

</body>
</html>