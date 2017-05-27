<?php

include 'functions.php';

//grid() tant qu'elle est fausse pour créer la grille de 8x8 respectant les règles du takuzu
do {
    $grille = grid();
} while ($grille == false);

$grillestart21 = startGrid($grille, 21);
$grillestart16 = startGrid($grille, 16);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Takuzu</title>
    <style>
        table { float: left; font-size: 1.5em;
            transform: translateX(-50%);
            margin-left: 50%;
            2px solid black;
            width: 100vh;
            table-layout: fixed;
        }
        td {
            height:60px;
            width:60px;
            border:1px solid;
            text-align:center;
        }
        #info button {
            font-size: 3em;}
        #info, #retour {
            clear: both; margin:2em; transform: translateX(-50%);
            margin-left: 50%;}
        #table p {
            font-size: 1.3em; font-weight: bold;}
        #table button { margin: 1em;
        }
        #table {margin-top: 3em;}

        .container-fluid button {background-color: #ee7117; border:none;}
    </style>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
    <div id="retour" class="text-center col-lg-12 col-xs-12 col-md-12 col-sm-12">
        <a href="index.php"><button class="btn btn-warning" id="accueil">Retour à l'accueil</button></a></div>
    <div id="info" class="text-center col-lg-12 col-xs-12 col-md-12 col-sm-12">
        <a href="./takuzuhtml.php"><button class="btn btn-warning glyphicon glyphicon-retweet"></button></a>
    </div>
    <div id="table" class="text-center col-lg-12 col-xs-12 col-md-12 col-sm-12">
        <p>Solution : </p>
        <button class="btn btn-warning" onclick="generate('grillesolution')">Générer l'image</button>
        <table id="grillesolution" style="background-color: white;">
            <tbody>
            <?php
            // pour chaque ligne
            for ($i=0; $i<8; $i++)
            {
                ?>
                <tr>
                    <?php		// pour chaque colonne (de la ligne)
                    for ($j=0; $j<8; $j++)
                    {
                        ?>		<td>
                        <?php
                        echo $grille[$i][$j];
                        ?>		</td>
                    <?php	} // end for
                    ?>
                </tr>
                <?php
            } // end for
            ?>
            </tbody>
        </table>

    </div>
    <div id="table" class="text-center col-lg-12 col-xs-12 col-md-12 col-sm-12">
        <p>Facile : </p>
        <button class="btn btn-warning" onclick="generate('grillea47faire')">Générer l'image</button>
        <table id="grillea47faire" style="background-color: white;">
            <tbody>
            <?php
            // pour chaque ligne
            for ($i=0; $i<8; $i++)
            {
                ?>
                <tr>
                    <?php		// pour chaque colonne (de la ligne)
                    for ($j=0; $j<8; $j++)
                    {
                        ?>		<td>
                        <?php
                        echo $grillestart16[$i][$j];
                        //                if ($grillestart[$i][$j]== "_") { echo " ";} else {echo $grillestart[$i][$j];};
                        ?>		</td>
                    <?php	} // end for
                    ?>
                </tr>
                <?php
            } // end for
            ?>
            </tbody>
        </table>

    </div>
    <div id="table" class="text-center col-lg-12 col-xs-12 col-md-12 col-sm-12">
        <p>Difficile : </p>
        <button class="btn btn-warning" onclick="generate('grillea53faire')">Générer l'image</button>
        <table id="grillea53faire" style="background-color: white;">
            <tbody>
            <?php
            // pour chaque ligne
            for ($i=0; $i<8; $i++)
            {
                ?>
                <tr>
                    <?php		// pour chaque colonne (de la ligne)
                    for ($j=0; $j<8; $j++)
                    {
                        ?>		<td>
                        <?php
                        echo $grillestart21[$i][$j];
                        //                if ($grillestart[$i][$j]== "_") { echo " ";} else {echo $grillestart[$i][$j];};
                        ?>		</td>
                    <?php	} // end for
                    ?>
                </tr>
                <?php
            } // end for
            ?>
            </tbody>
        </table>

    </div>

</div>
<script src="lib/jquery-3.2.1.min.js"></script>
<script src="lib/html2canvas.js"></script>
<script>
    function generate(id) {

        document.getElementById(id).style.transform = document.getElementById(id).style.webkitTransform = 'scale(4)'
        document.getElementById(id).style.transformOrigin = document.getElementById(id).style.webkitTransformOrigin = '0 0'
        html2canvas(document.getElementById(id), {
            width: document.getElementById(id).offsetWidth * 4,
            height: document.getElementById(id).offsetHeight * 4
        }).then(function(canvas) {
            var data = canvas.toDataURL();
            window.open(data);// now img quality doubled!
        })

        document.getElementById(id).style.transform = document.getElementById(id).style.webkitTransform = 'scale(1)';
        var elmt = document.getElementById(id);
        elmt.style.transform = "translateX(-50%)";
        elmt.style.margin = "margin-left: 50%";
        elmt.style.width = "100vh";
        elmt.style.table = "table-layout: fixed";
    }
</script>
</body>
</html>