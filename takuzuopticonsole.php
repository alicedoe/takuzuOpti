<?php

include 'functions.php';

//grid() tant qu'elle est fausse pour créer la grille de 8x8 respectant les règles du takuzu
do {
    $grille = grid();
} while ($grille == false);

displayGridTest($grille);