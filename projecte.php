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
        mostrar_videojocs(carrega_fitxer('games.json'));
    } 
    if($_GET['funcionalitat'] == 2) {
        $id_maxim = id_maxim(carrega_fitxer('prova.json'));
        assigna_codi($id_maxim);
        mostrar_videojocs(carrega_fitxer('prova.json'));
    }
    if($_GET['funcionalitat'] == 3) {
        eliminar_videojocs();
        mostra_videojocs(carrega_fitxer('JSON_Resultat_Eliminar.json'));
    } 
?>