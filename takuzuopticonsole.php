<?php

include 'functions.php';
$timestamp_debut = microtime(true);

//grid() tant qu'elle est fausse pour créer la grille de 8x8 respectant les règles du takuzu
$nbgrille = 0;
do {
    $grille = grid();
    $nbgrille++;
} while ($grille == false);

displayGridTest($grille);

$timestamp_fin = microtime(true);
$difference_ms = $timestamp_fin - $timestamp_debut;
echo "</br>$nbgrille grilles ont dû être générées";
echo '</br>Exécution du script : ' . $difference_ms . ' secondes.';