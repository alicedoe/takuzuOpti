<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Takuzu</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
    <div id="retour" class="text-center col-lg-12 col-xs-12 col-md-12 col-sm-12">
        <a href="index.php"><button class="btn btn-warning" id="accueil">Retour à l'accueil</button></a></div>
    <div id="info" class="text-center col-lg-12 col-xs-12 col-md-12 col-sm-12">
        <a href="./takuoptihtml.php"><button class="btn btn-warning glyphicon glyphicon-retweet"></button></a>
    </div>

    <div id="table" class="text-center col-lg-4 col-xs-12 col-md-4 col-sm-12">
        <p>Solution : </p>
        <button class="btn btn-warning" onclick="generate('grille1')">Générer l'image</button>
        <div id="grille1">
            <?php

            include 'functions.php';

            //grid() tant qu'elle est fausse pour créer la grille de 8x8 respectant les règles du takuzu
            do {
                $grille = grid();
            } while ($grille == false);

            $grillestart21 = startGrid($grille, 21);
            $grillestart16 = startGrid($grille, 16);


    for ($i=0; $i<8; $i++) {
       ?> <div class="line"> <?php
    for ($j=0; $j<8; $j++)
    {
        ?> <div class="square">
        <div class="content">
            <div class="table">
                <div class="table-cell">
                    <?php
                    echo $grille[$i][$j];
                    ?>
                </div>
            </div>
        </div>
    </div> <?php
    } ?>
    </div> <?php
    }
    ?>
    </div>
    </div>


    <div id="table" class="text-center col-lg-4 col-xs-12 col-md-4 col-sm-12">
        <p>Facile : </p>
        <button class="btn btn-warning" onclick="generate('grille2')">Générer l'image</button>
        <div id="grille2">
            <?php
            for ($i=0; $i<8; $i++) {
                ?> <div class="line"> <?php
                    for ($j=0; $j<8; $j++)
                    {
                        ?> <div class="square">
                        <div class="content">
                            <div class="table">
                                <div class="table-cell">
                                    <?php
                                    echo $grillestart16[$i][$j];
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div> <?php
                    } ?>
                </div> <?php
            }
            ?>
        </div>

    </div>
    <div id="table" class="text-center col-lg-4 col-xs-12 col-md-4 col-sm-12">
        <p>Difficile : </p>
        <button class="btn btn-warning" onclick="generate('grille3')">Générer l'image</button>
        <div id="grille3">
            <?php
            for ($i=0; $i<8; $i++) {
                ?> <div class="line"> <?php
                    for ($j=0; $j<8; $j++)
                    {
                        ?> <div class="square">
                        <div class="content">
                            <div class="table">
                                <div class="table-cell">
                                    <?php
                                    echo $grillestart21[$i][$j];
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div> <?php
                    } ?>
                </div> <?php
            }
            ?>
        </div>

    </div>
    <div id="imgcanvas"></div>
<script src="lib/jquery-3.2.1.min.js"></script>
<script src="lib/html2canvas.js"></script>
    <script src="lib/script.js"></script>
</body>
</html>