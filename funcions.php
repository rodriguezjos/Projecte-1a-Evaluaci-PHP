<?php

function imprimir_index()
{
    echo "<h1>Projecte 1era Evaluació IAW</h1>
    <h2>Jose Rodriguez i Nicolau Seguí</h2>";

    echo "<a href='projecte.php'>Index</a>";
    echo "<a href='projecte.php?funcionalitat=1'>Funcionalitat 1</a>";
    echo "<a href='projecte.php?funcionalitat=2'>Funcionalitat 2</a>";
}
function carrega_fitxer()
{
    $jsonString = file_get_contents('prova.json');

    $arrayAsociatiu = json_decode($jsonString, true);

    // Verifica si hay errores durante la decodificación
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('Error  JSON: ' . json_last_error_msg());
    }
    return $arrayAsociatiu;
}

function mostra_videojocs($videojocs)
{
    echo "<table border='black'>";
    echo "<th>ID</th><th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th>";
    foreach ($videojocs as $videojoc) {
        echo "<tr>";
        foreach ($videojoc as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}

function id_maxim($videojocs)
{
    $id_maxim = 0;
    $id = 0;
    foreach ($videojocs as $valor) {
        if ($valor["ID"] != 0) {
            $id = $valor["ID"];
            if ($id > $id_maxim) {
                $id_maxim = $id;
            }
        }
    }
    return $id_maxim;
}


//Queda arreglar que escrigui el nou ID a la posicio que toca al JSON
function assigna_codi($id_maxim)
{
    $jsonString = file_get_contents('prova.json');
    $arrayAsociatiu = json_decode($jsonString, true);
    foreach ($arrayAsociatiu as $columna => $valor) {
        if (!$arrayAsociatiu[$columna]['ID']) {
            $id_maxim++;
            $arrayAsociatiu[$columna]['ID'] = $id_maxim;
            $newJsonString = json_encode($arrayAsociatiu,JSON_PRETTY_PRINT,JSON_INVALID_UTF8_IGNORE);
            file_put_contents('prova.json', $newJsonString);
        }
    }
}
?>