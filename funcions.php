<?php

function imprimir_index(){
    echo "<h1>Projecte 1era Evaluació IAW</h1>
    <h2>Jose Rodriguez i Nicolau Seguí</h2>
    <form method='post'>
        <input type='submit' name='funcionalitat_1' value='funcionalitat_1' />
        <input type='submit' name=?funcionalitat_2' value='funcionalitat_2' />
    </form>";
}
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