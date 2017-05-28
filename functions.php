<?php

/**
 * Affiche la grille $grille sous forme lisible
 *
 * @param array $grille
 *
 * @return affichage
 */
function displayGridTest($grille) {
    for ($i = 0; $i < count($grille); $i++) {
        for ($j = 0; $j < count($grille[$i]); $j++) {
            echo $grille[$i][$j]." ";
        }
        echo "</br>";
    }
    echo "</br>";
}

/**
 * Retourne un array de 8 contenant des 1 & des 0
 * Représente une ligne de la grille de jeux
 * Sans triplon et dont le total fait 4
 *
 * @param void
 *
 * @return array
 */
function generateLine () {
    $line = array();
    while(array_sum($line) != 4 ) {
        for ($i = 0; $i < 8; $i++) {
            if ($i > 1 && $line[$i - 1] == $line[$i - 2]) {
                if ($line[$i - 1] == 0) $line[$i] = 1;
                else $line[$i] = 0;
            }else  $line[$i] = rand(0, 1);
        }
    }
    return $line;
}


/**
 * Retourne un tableau de 8 tableaux (lignes)
 * les 2 premières lignes générées par la fonction generateLine()
 * Les 6 lignes suivantes sont générées par newLineTest()
 * Ou retourne false si newLineTest() était dans une impasse
 *
 * @param void
 *
 * @return false ou array
 */
function grid() {
    $grille = array();
    $grille[0] = generateLine();
    $grille[1] = generateLine();
    for ($i = 2; $i < 8; $i++) {
        $line = newLineTest($grille, $i);
        if ($line == true ) { $grille[$i] = $line; } else { return false; };

    }
    return $grille;
}

/**
 * Retourne un array de 8 representant la ligne numéro $nb que nous souhaitons crées
 * Respectant les régles du takuzu et cohérente vis à vis de la grille $grille en cours
 *
 * @param array $grille, int $nb
 *
 * @return false ou array
 */
function newLineTest($grille,$nb)
{
    //la ligne[$nb] est un tableau
    $grille[$nb] = array();
    //tableau temporaire qui stock les 2 lignes précédentes celle que l'on veut créer
    $grilleTempTriplon = array_slice($grille, $nb-2, 2);

    //boucle pour les 8 cases de notre ligne
    for ($i = 0; $i < 8; $i++) {

        //stock la colonne de la case en cours sous forme de tableau
        $column4 = array_column($grille, $i);
        //stock la colonne des 2 lignes précédentes sous forme de tableau de la case que nous voulons créer
        $columnTriplon = array_column($grilleTempTriplon, $i);
        //transforme en string $columnTriplon
        $columnStringTriplon = implode("", $columnTriplon);

        //stock la colonne des 2 lignes précédentes sous forme de tableau de la case que nous voulons créer
        $columnTriplonNext = array_column($grilleTempTriplon, $i+1);
        //transforme en string $columnTriplon
        $columnStringTriplonNext = implode("", $columnTriplonNext);

        //à partir de la ligne 4 et + et si le total de la colonne en cours est égal à 4
        if ($nb >= 4 && array_sum($column4) == 4 && gettype(strpos($columnStringTriplon, '00')) == "integer") {
            //on est obligé de mettre un 0 mais si cela ne colle pas au règle on retourne false
            if (checkTriplonTest($grille[$nb],$i,0) == true ) { array_push($grille[$nb], "0"); } else { return false; }
            //sinon si on risque un triplon de 0 via la colonne
        } elseif (gettype(strpos($columnStringTriplon, '00')) == "integer") {
            //on est obligé de mettre un 1 mais si cela ne colle pas au règle on retourne false
            if (checkTriplonTest($grille[$nb],$i,1) == true ) { array_push($grille[$nb], "1"); } else { return false; }
            //sinon si on risque un triplon de 11 via la colonne
        } elseif (gettype(strpos($columnStringTriplon, '11')) == "integer") {
            //on est obligé de mettre un 0 mais si cela ne colle pas au règle on retourne false
            if (checkTriplonTest($grille[$nb],$i,0) == true ) { array_push($grille[$nb], "0"); } else { return false; }
            //sinon on anticipe le risque de triplon croisé 11 sur la colonne à venir & 00 surla ligne
        } elseif ($i > 1 && gettype(strpos($columnStringTriplonNext, '11')) == "integer" && $grille[$i - 1] == 0 ) {
            if (checkTriplonTest($grille[$nb],$i,1) == true ) { array_push($grille[$nb], "1"); } else { return false; }
            //sinon on anticipe le risque de triplon croisé 00 sur la colonne à venir & 00 surla ligne
        } elseif ($i > 1 && gettype(strpos($columnStringTriplonNext, '00')) == "integer" && $grille[$i - 1] == 1 ) {
            if (checkTriplonTest($grille[$nb],$i,0) == true ) { array_push($grille[$nb], "0"); } else { return false; }
            //sinon on doit juste vérifier qu'il n'y a pas de risque de triplon sur la ligne
        } else { $bin = noTriplonTest($grille[$nb],$i); array_push($grille[$nb], $bin); }

    }
    //si la ligne générée n'est pas égal à 4 on retourne false
    if ( array_sum($grille[$nb]) != 4 ) { return false; }
    //la ligne générée est correcte on la retourne
    return $grille[$nb];
}

/**
 * Vérifie si le nombre $test que l'on veut insérer à la case $i ne va pas créer de triplon
 * sur la ligne $ligne si un triplon est créé retourne false sinon true
 *
 * @param $ligne, $i, $test
 *
 * @return false ou true
 */
function checkTriplonTest($ligne,$i,$test) {
    if ($i > 1 && $ligne[$i - 1] == $ligne[$i - 2]) {
        if ($ligne[$i - 1] == 0 && $test == 0) {
            return false;
        } elseif ($ligne[$i - 1] == 1 && $test == 1) {
            return false;
        }
    }
    return true;
}

/**
 * Retourne un int pour remplir la case $i de la ligne $ligne
 * ne créant pas de triplon
 *
 * @param $ligne, $i
 *
 * @return int
 */
function noTriplonTest($ligne,$i) {
    if ($i > 1 && $ligne[$i - 1] == $ligne[$i - 2]) {
        if ($ligne[$i - 1] == 0) {
            $bin = 1;
        } else {
            $bin = 0;
        }
    } else {
        $bin = rand(0, 1);
    }
    return $bin;
}

/**
 * Retourne un array 8 x 8 de la grille $grille à faire avec $nb case vide
 *
 * @param array $grille, int $nb
 *
 * @return array
 */
function startGrid($grille, $nb){
    $case = 0;
    while($case<$nb) {
        $l = rand(0, 7);
        $c = rand(0, 7);
        if ($grille[$l][$c] != "") {
            $grille[$l][$c] = "";
            $case++;
        }
    }

    return $grille;
}