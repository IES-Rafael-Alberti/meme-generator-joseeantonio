<?php
require ("conecta.php");
require ("testlogin.php");
    $id = $_GET["id"];
    $url = $_GET["url"];
    $textos = $_GET["textos"];
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
<?php
echo('<form action="memegenerado.php?id='.$id.'&textos='.$textos.'" method="POST">');
    echo("<img width='300px' href='creador.php' src='" . $url . "'>");
    for($x = 1;$x<=$textos;$x++){
        echo('<br><label for="texto'.$x.'">Texto'.$x.': </label>');
        echo('<input type="text" name="texto'.$x.'" id="texto'.$x.'">');
    }
    //echo('<input type="hidden" value="$textos">');
    //echo('<input type="hidden" value="$id">')
    echo('</br>');
        echo('<input type="submit" value="crear">');

echo('</form>')
?>
</body>
</html>
