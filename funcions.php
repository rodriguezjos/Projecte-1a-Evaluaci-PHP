<?php

function imprimir_index(){
    echo "<h1>Projecte 1era Evaluació IAW</h1>
    <h2>Jose Rodriguez i Nicolau Seguí</h2>";

    echo "<a href='projecte.php'>Index</a>";
    echo "<a href='projecte.php?funcionalitat=1'>Funcionalitat 1</a>";
    echo "<a href='projecte.php?funcionalitat=2'>Funcionalitat 2</a>";
}
function carrega_fitxer(){
    $jsonString = file_get_contents('prova.json');

    $arrayAsociatiu = json_decode($jsonString, true);

    // Verifica si hay errores durante la decodificación
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('Error  JSON: ' . json_last_error_msg());
    }
    return $arrayAsociatiu;
}

function mostra_videojocs($videojocs){
    echo "<table border='black'>";
    echo "<th>ID</th><th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th>";
    foreach ($videojocs as $videojoc){
        echo "<tr>";
        foreach ($videojoc as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    }

    function assigna_codi(){
        
    }
?>