<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 1 IAW</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Projecte 1era Evaluació IAW</h1>
    <h2>Jose Rodriguez i Nicolau Seguí</h2>
    <form method='post'>
        <input type='submit' name='funcionalitat_1' value='funcionalitat 1' />
        <input type='submit' name='funcionalitat_2' value='funcionalitat 2' />
    </form>
</body>

</html>

<?php
    require('funcions.php');

    if(isset($_POST['funcionalitat_1'])) {
        mostra_videojocs(carrega_fitxer());
        header("Location: {$_SERVER['projecte.php']}"); // Redirige a la misma página
        exit();
    } 
    if(isset($_POST['funcionalitat_2'])) {
        echo "hola";
    } 

?>