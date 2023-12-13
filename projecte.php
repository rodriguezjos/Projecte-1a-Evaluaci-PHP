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


<?php
require('funcions.php');

imprimir_index();

if ($_GET['funcionalitat'] == 1) {
  mostrar_videojocs(carrega_fitxer('games.json'));
}
if ($_GET['funcionalitat'] == 2) {
  $id_maxim = id_maxim(carrega_fitxer('games.json'));
  assigna_codi($id_maxim);
  mostrar_videojocs(carrega_fitxer('games.json'));
}
if ($_GET['funcionalitat'] == 3) {
  $date1 = "2015-05-19";
  $date2 = "2018-10-26";
  eliminar_videojocs($date1, $date2);
  mostra_videojocs(carrega_fitxer('JSON_Resultat_Eliminar.json'));
}
if ($_GET['funcionalitat'] == 4) {
  data_expiracio();
  mostrar_videojocs(carrega_fitxer('JSON_Resultat_Data_Expiració.json'));
}
if ($_GET['funcionalitat'] == 5) {
  comprovar_repetits();
}
if ($_GET['funcionalitat'] == 6) {
  comprovar_repetits_ampliat();
  mostrar_videojocs(carrega_fitxer('JSON_Resultat_repetits.json'));
}
if ($_GET['funcionalitat'] == 7) {
  eliminar_repetits();
  mostrar_videojocs(carrega_fitxer('JSON_Eliminar_Registres_Repetits.json'));
}
if ($_GET['funcionalitat'] == 8) {
  videojocs_antics_nous();
  mostra_videojocs(carrega_fitxer('JSON_resultat_antic_nou.json'));
}
if ($_GET['funcionalitat'] == 9) {
  ordenar_alfabeticament();
  mostrar_videojocs(carrega_fitxer('JSON_Resultat_ordenat_alfabetic.json'));
}if ($_GET['funcionalitat'] == 10) {
  juegos_por_año();
}
if ($_GET['funcionalitat'] == 11) {
  eliminarFicherosJson();
}
?>
<br>
<div class="img-container">
  <img src="Projecte-1a-Evaluaci-PHP\img\php.gif" alt="GIF PHP">
</div>

</html>


