<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Projecte 1era Evaluació IAW</h1>
    <h2>Jose Rodriguez i Nicolau Seguí</h2>
    <form method="post">
        <input type="submit" name="funcionalitat_1" value="funcionalitat_1" />
        <input type="submit" name="funcionalitat_2" value="funcionalitat_2" />
    </form>
</body>

</html>

<?php
    require('funcions.php');
      
    if(isset($_POST['funcionalitat_1'])) { 
        mostra_videojocs(carrega_fitxer());
    } 
    if(isset($_POST['funcionalitat_2'])) { 
        echo "hola";
    } 

?>