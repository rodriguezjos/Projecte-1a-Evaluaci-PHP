<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 1 IAW</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

</body>

</html>

<?php
    require('funcions.php');

    imprimir_index();

    if($_GET['funcionalitat'] == 1) {
        mostra_videojocs(carrega_fitxer());
    } 
    if($_GET['funcionalitat'] == 2) {
        $id_maxim = id_maxim(carrega_fitxer());
        assigna_codi($id_maxim);
        mostra_videojocs(carrega_fitxer());
    } 
?>