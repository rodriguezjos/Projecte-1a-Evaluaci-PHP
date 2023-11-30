<?php

function imprimir_index()
{
    echo "<header><h1>Projecte 1era Evaluació IAW</h1>
    <h2>Jose Rodriguez i Nicolau Seguí</h2></header>";
    
    echo "<button class='Boto' onclick=\"window.location.href='projecte.php'\">Index</button>";
    echo "<button class='Boto' onclick=\"window.location.href='projecte.php?funcionalitat=1'\">Funcionalitat 1</button>";
    echo "<button class='Boto' onclick=\"window.location.href='projecte.php?funcionalitat=2'\">Funcionalitat 2</button>";
    echo "<button class='Boto' onclick=\"window.location.href='projecte.php?funcionalitat=3'\">Funcionalitat 3</button>";
    echo "<button class='Boto' onclick=\"window.location.href='projecte.php?funcionalitat=4'\">Funcionalitat 4</button>";
    echo "<button class='Boto' onclick=\"window.location.href='projecte.php?funcionalitat=5'\">Funcionalitat 5</button>";
    
}
function carrega_fitxer($fitxer)
{
    $jsonString = file_get_contents($fitxer);

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

function mostrar_videojocs($videojocs)
{
    echo "<table border='black'>";

    // Imprimir la capçalera de la taula
    echo "<tr>";
    foreach (array_keys($videojocs[0]) as $header) {
        echo "<th>$header</th>";
    }
    echo "</tr>";

    // Imprimir el contingut de la taula
    foreach ($videojocs as $videojoc) {
        echo "<tr>";
        foreach ($videojoc as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}

// id_maxim troba el codi mes gran al fitxer json i l'emmagtzema. L'utilitzarem a assignae_codi per començar a assignar codis a partir d'aquest.
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


//Queda arreglar que escrigui el nom de la columna 'ID: ' seguit del nou codi. Ara per ara imprimeix '0: ' i el nou codi.
function assigna_codi($id_maxim)
{
    $jsonString = file_get_contents('prova.json');
    $arrayAsociatiu = json_decode($jsonString, true);
    foreach ($arrayAsociatiu as $columna => $valor) {
        if (!$arrayAsociatiu[$columna]['ID']) {
            $id_maxim++;
            $arrayAsociatiu2 = array('ID:' => $id_maxim) + $arrayAsociatiu[$columna];
            $arrayAsociatiu[$columna] = $arrayAsociatiu2;
            $newJsonString = json_encode($arrayAsociatiu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents('prova.json', $newJsonString);
        }
    }
}

//NICO AIXO NA CRISTINA HA DIT QUE SES DATES S'HAN DE PASSAR PER PARAMETRE PER NO ELIMINAR SEMPRE ES MATEIXOS VIDEOJOCS

function eliminar_videojocs()
{
    $date1 = "2015-05-19";
    $date2 = "2018-10-26";

    $jsonString = file_get_contents('prova.json');
    $arrayAsociatiu = json_decode($jsonString, true);

    foreach ($arrayAsociatiu as $columna => $valor) {
        if ($arrayAsociatiu[$columna]["Llançament"] >= $date1 && $arrayAsociatiu[$columna]["Llançament"] <= $date2) {
            unset($arrayAsociatiu[$columna]);
        }
    }
    $newJsonString = json_encode($arrayAsociatiu, JSON_PRETTY_PRINT);
    file_put_contents("JSON_Resultat_Eliminar.json", $newJsonString);
}

//NO afegeix els registres al json pero l'array esta modificat de forma correcta
function data_expiracio()
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);

    foreach ($arrayAsociatiu as $columna => $valor) {
        $data_expiracio = date('Y-m-d', strtotime($valor['Llançament'] . ' + 5 years'));
        $array_expiracio = array('Data expiracio' => $data_expiracio);
        $arrayAsociatiu = array_merge($valor, $array_expiracio);
        print_r ($arrayAsociatiu);
        echo "<br>";  
        $newJsonString = json_encode($arrayAsociatiu, JSON_PRETTY_PRINT,JSON_UNESCAPED_UNICODE);
        file_put_contents('JSON_Resultat_Data_Expiració.json', $newJsonString);   
    }
}

function comprovar_repetits() {
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);
    $elementsvists = [];
    $repetits = false;

    foreach ($arrayAsociatiu as $valor) {
        $nom = $valor['Nom'];
        if (in_array($nom, $elementsvists)) {
            $repetits = true;
            break;
        }
        else{
            $elementsvists[] = $nom;
        }
    }
    if($repetits == true){
        print('<br>');
        print('HI HA REPETITS');
    }
    else{
        print('<br>');
        print('NO HI HA REPETITS');
    }
}


?>