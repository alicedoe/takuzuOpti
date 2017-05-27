<?php

include 'functions.php';
$timestamp_debut = microtime(true);

//grid() tant qu'elle est fausse pour créer la grille de 8x8 respectant les règles du takuzu
do {
    $grille = grid();
} while ($grille == false);

displayGridTest($grille);

$timestamp_fin = microtime(true);
$difference_ms = $timestamp_fin - $timestamp_debut;
echo 'Exécution du script : ' . $difference_ms . ' secondes.';