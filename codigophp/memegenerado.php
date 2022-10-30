<?php
require ("conecta.php");
require ("testlogin.php");
    $textos = $_GET["textos"];
    $id = $_GET["id"];
    $arraytextos = array();
    for($x = 1;$x<=$textos;$x++){
        array_push($arraytextos,array("text" => $_POST["texto$x"]));
    }

    //url for meme creation
    $url = 'https://api.imgflip.com/caption_image';

    //The data you want to send via POST
    $fields = array(
        "template_id" => $id,
        "username" => "fjortegan",
        "password" => "pestillo",
        "boxes" => $arraytextos);


    //url-ify the data for the POST
    $fields_string = http_build_query($fields);

    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //execute post
    $result = curl_exec($ch);

    //decode response
    $data = json_decode($result, true);

    //if success show image
    if ($data["success"]) {
        //añado meme a la carpeta memes con el nombre creado con las fechas
        $nameMeme = $_SESSION["usuario"].date("dmyhis").".jpg";
        file_put_contents("memes/$nameMeme",file_get_contents($data["data"]["url"]));
        $url=$data["data"]["url"];
        echo "<img src='" . $data["data"]["url"] . "'>";

        $sql="INSERT INTO meme (ruta,id_usuario) VALUES (:ruta,:id_usuario)";
        $datosSql=array("ruta"=>$nameMeme,
            "id_usuario"=>$_SESSION['id_usuario']);
        $stmt= $conn->prepare($sql);
        if($stmt->execute($datosSql) != 1) {
            print("No se pudo añadir el meme a la base de datos");
        }
    }
    echo("<br>");
    echo("<a href='listaUsuario.php'><button>Mi listado</button></a>");
