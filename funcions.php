<?php

// Funció que imprimeix per pantalla tots els botons per a cada funcionalitat i el header de la pàgina
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
    echo "<button class='Boto' onclick=\"window.location.href='projecte.php?funcionalitat=6'\">Funcionalitat 6</button>";
    echo "<button class='Boto' onclick=\"window.location.href='projecte.php?funcionalitat=7'\">Funcionalitat 7</button>";
    echo "<button class='Boto' onclick=\"window.location.href='projecte.php?funcionalitat=8'\">Funcionalitat 8</button>";
    echo "<button class='Boto' onclick=\"window.location.href='projecte.php?funcionalitat=9'\">Funcionalitat 9</button>";
    echo "<button class='Boto' onclick=\"window.location.href='projecte.php?funcionalitat=10'\">Funcionalitat 10</button>";
    echo "<button class='Boto' onclick=\"window.location.href='projecte.php?funcionalitat=11'\">Esborrar Jsons</button>";
}

//Aquesta funció carrega les dades del fitxer Json que li pasis per parametre, i crea un array associatiuamb les dades de cada registre.
function carrega_fitxer($fitxer)
{
    $jsonString = file_get_contents($fitxer);

    $arrayAsociatiu = json_decode($jsonString, true);

    // Verifica si es produeixen errors durant la decodificació
    if (json_last_error() !== JSON_ERROR_NONE) {
        die('Error  JSON: ' . json_last_error_msg());
    }
    return $arrayAsociatiu;
}
//Aquesta funció imprimeix la taula de continguts inicial (les columnes son estatiques)
function mostra_videojocs($videojocs)
{
    echo "<table border='black'>";
    echo "<th>Nom</th><th>Desenvolupador</th><th>Plataforma</th><th>Llançament</th><th>ID</th>";
    foreach ($videojocs as $videojoc) {
        echo "<tr>";
        foreach ($videojoc as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}
//Aquesta funció imprimeix la taula de continguts lletgint l'array per parametre (les columnes poden variar del arxiu original)
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

//Afegeix a cada registre sense el parametre 'ID' un nou ID, respectant el ID màxim anterior(id_maxim)
function assigna_codi($id_maxim)
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);
    foreach ($arrayAsociatiu as $columna => $valor) {
        if (!$arrayAsociatiu[$columna]['ID']) {
            $id_maxim++;
            $arrayAsociatiu2 = $arrayAsociatiu[$columna] + array('ID' => $id_maxim);
            $arrayAsociatiu[$columna] = $arrayAsociatiu2;
            $newJsonString = json_encode($arrayAsociatiu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            file_put_contents('games.json', $newJsonString);
        }
    }
}

//funcio que elimina registres en funció de si es troben entre un període de temps determinat per 2 dades i guarda tots els registres no esborrats en
//un nou json anomenat 'JSON_Resultat_Eliminar.json
function eliminar_videojocs($date1, $date2)
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);

    foreach ($arrayAsociatiu as $columna => $valor) {
        if ($arrayAsociatiu[$columna]["Llançament"] >= $date1 && $arrayAsociatiu[$columna]["Llançament"] <= $date2) {
            unset($arrayAsociatiu[$columna]);
        }
    }
    $newJsonString = json_encode($arrayAsociatiu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents("JSON_Resultat_Eliminar.json", $newJsonString);
}

//funció que afegeix una nova columna anomenada 'Data expiració' que equival a la data de llançament afegint 5 anys
//el array amb la nova columna es guarda al arxiu 'JSON_Resultat_Data_Expiració.json'
function data_expiracio()
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);


    foreach ($arrayAsociatiu as $columna => $valor) {
        $data_expiracio = date('Y-m-d', strtotime($valor['Llançament'] . ' + 5 years'));
        $array_expiracio = $arrayAsociatiu[$columna] + array('Data expiracio' => $data_expiracio);
        $arrayAsociatiu[$columna] = $array_expiracio;

        $newJsonString = json_encode($arrayAsociatiu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents('JSON_Resultat_Data_Expiració.json', $newJsonString);
    }
}

//funció que comprova si existeixen registres repetits e imprimeix per pantalla una missatge indicant si hi ha repetits o si no n'hi ha
function comprovar_repetits()
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);
    $elementsvists = [];
    $repetits = false;

    foreach ($arrayAsociatiu as $valor) {
        $nom = $valor['Nom'];
        if (in_array($nom, $elementsvists)) {
            $repetits = true;
            break;
        } else {
            $elementsvists[] = $nom;
        }
    }
    if ($repetits == true) {
        print('<br>');
        print('<p>HI HA REPETITS</p>');
    } else {
        print('<br>');
        print('<p>NO HI HA REPETITS</p>');
    }
}

//funcio que comprova si existeixen registres repetits, afegeix els registres repetits al següent fitxer json: 'JSON_Resultat_repetits.json'
// i els mostra per pantalla 
function comprovar_repetits_ampliat()
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);
    $elementsvists = [];
    $repetits = [];

    foreach ($arrayAsociatiu as $valor) {
        $nom = $valor['Nom'];
        if (in_array($nom, $elementsvists)) {
            $repetits[] = $valor;
        } else {
            $elementsvists[] = $nom;
        }
    }

    if (!empty($repetits)) {
        $JSON_RESULTAT_REPETITS = json_encode($repetits, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents('JSON_Resultat_repetits.json', $JSON_RESULTAT_REPETITS);
    } else {
        print('<br>');
        print('<p>NO HI HA REPETITS</p>');
    }
}

//funcio que elimina els registres repetits i guarda tots els registres que no estan repetits a un fitxer json 
//anomenat: 'JSON_Eliminar_Registres_Repetits.json'
function eliminar_repetits()
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);
    $elementsvists = [];
    $registresNoRepetits = [];

    foreach ($arrayAsociatiu as $valor) {
        $nom = $valor['Nom'];
        if (in_array($nom, $elementsvists)) {

        } else {
            $elementsvists[] = $nom;
            $registresNoRepetits[] = $valor;
        }
    }

    $jsonEliminarRepetits = json_encode($registresNoRepetits, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents('JSON_Eliminar_Registres_Repetits.json', $jsonEliminarRepetits);

    if (!empty($registresNoRepetits)) {

    } else {
        print('<br>');
        print('<p>NO HI HA REPETITS</p>');
    }
}

//funcio que mostra per pantalla el registres del videojocs mes antic i del mes nou

function videojocs_antics_nous()
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);
    $dataantiga = PHP_INT_MAX;
    $datarecent = 0;
    $videojoc_antic = null;
    $videojoc_recent = null;

    foreach ($arrayAsociatiu as $valor) {
        $data = $valor['Llançament'];
        if ($data) {
            $timestamp_data = strtotime($data);

            if ($timestamp_data < $dataantiga) {
                $dataantiga = $timestamp_data;
                $videojoc_antic = $valor;
            }

            if ($timestamp_data > $datarecent) {
                $datarecent = $timestamp_data;
                $videojoc_recent = $valor;
            }
        }
    }

    if ($videojoc_antic !== null && $videojoc_recent !== null) {
        $info_videojocs = array('videojoc_antic' => $videojoc_antic, 'videojoc_recent' => $videojoc_recent);
        $json_info = json_encode($info_videojocs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents('JSON_resultat_antic_nou.json', $json_info);
    } else {
        print("No s'han trobat dates valides");
    }
}

//funcio que crea un json amb tots els registres ordenats de forma alfabèticament i el mostra per pantalla
function ordenar_alfabeticament()
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);
    asort($arrayAsociatiu);
    $json_encode = json_encode(array_values($arrayAsociatiu), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents('JSON_Resultat_ordenat_alfabetic.json', $json_encode);
}

//funcio que mostra per pantalla una llista on es mostra el número de videojocs que s'han publicat a cada any
function juegos_por_año()
{
    $jsonString = file_get_contents('games.json');
    $arrayAsociatiu = json_decode($jsonString, true);

    //Ordenam el array per data
    usort($arrayAsociatiu, 'compararFechas');

    foreach ($arrayAsociatiu as $videojuego) {
        $fechalanzamiento = strtotime($videojuego['Llançament']);
        $añoDeLanzamiento[] = date('Y', $fechalanzamiento);
    }
    $frecuencia_elementos = array_count_values($añoDeLanzamiento);

    echo "<ul >";
    foreach ($frecuencia_elementos as $elemento => $frecuencia) {
        echo "<li >Año: $elemento - Cantidad de videojuegos: $frecuencia</li>\n";
    }
    echo "</ul>";
}

//funcio que retorna la diferencia entre dues dates
function compararFechas($a, $b)
{
    return strtotime($a['Llançament']) - strtotime($b['Llançament']);
}

//funcio que elimina tots els fitxers json que s'han creat degut a les funcionalitats
function eliminarFicherosJson() {
    // Obtenim els arxius json en el directori
    $archivos = glob('./' . '/*.json');
    // Iterar sobre la llista de arxius
    foreach ($archivos as $archivo) {
        // Obtenim el nom del arxiu
        $nombreArchivo = basename($archivo);

        // Verificar que el nom del arxiu no es 'games.json'
        if ($nombreArchivo !== 'games.json') {
            // Eliminam l'arxiu
            unlink($archivo);
            echo "S'ha esborrat l'arxiu: $nombreArchivo<br>";
        }
    }

    echo "Procés completat.";
}

?>
