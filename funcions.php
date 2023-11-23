<?php


function carrega_fitxer(){
    $jsonString = file_get_contents('games.json');

    $arrayAsociatiu = json_decode($jsonString, true);

    // Verifica si hay errores durante la decodificación
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('Error  JSON: ' . json_last_error_msg());
    }
    return $arrayAsociatiu;
}

function mostra_videojocs($videojocs){
    echo "<table border='black'>";
    echo "<th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th>";
    foreach ($videojocs as $videojoc){
        echo "<tr>";
        foreach ($videojoc as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    }
?>