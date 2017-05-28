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
        #info button {
            font-size: 3em;}
        #info, #retour {
            clear: both; margin:2em; transform: translateX(-50%);
            margin-left: 50%;}
        #table p {
            font-size: 1.3em; font-weight: bold;}
        #table button { margin: 1em;
        }
        #table {
            background-color: white;
        }

        .container-fluid button {background-color: #ee7117; border:none;}
        .line {
            clear: both;
            font-size: 1.5em;
            font-weight: bold;
            font-family: "Arial Black";
        }
        .square {
            float:left;
            position: relative;
            width: 12.5%;
            padding-bottom: 12.5%;
            overflow:hidden;
            border: 1px solid black;
            text-align: center;
        }

        .content {
            position:absolute;
            height: 100%;
            width: 100%;

        }
        .table{
            display:table;
            width:100%;
            height:100%;
        }
        .table-cell{
            display:table-cell;
            vertical-align:middle;
        }
    </style>
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
<script>
    function takeHighResScreenshot(srcEl, scaleFactor) {
        // Save original size of element
        var originalWidth = 895;
        var originalHeight = 797.15;
        // Force px size (no %, EMs, etc)
        srcEl.style.width = "895px";
        srcEl.style.height = "797.15px";

        // Position the element at the top left of the document because of bugs in html2canvas. The bug exists when supplying a custom canvas, and offsets the rendering on the custom canvas based on the offset of the source element on the page; thus the source element MUST be at 0, 0.
        // See html2canvas issues #790, #820, #893, #922
        srcEl.style.position = "absolute";
        srcEl.style.top = "0";
        srcEl.style.left = "0";

        // Create scaled canvas
        var scaledCanvas = document.createElement("canvas");
        scaledCanvas.width = originalWidth * scaleFactor;
        scaledCanvas.height = originalHeight * scaleFactor;
        scaledCanvas.style.width = originalWidth + "px";
        scaledCanvas.style.height = originalHeight + "px";
        var scaledContext = scaledCanvas.getContext("2d");
        scaledContext.scale(scaleFactor, scaleFactor);

        html2canvas(srcEl, { canvas: scaledCanvas })
            .then(function(canvas) {
                var data = canvas.toDataURL();
            window.open(data);
            });
    };



    // With scale: 2 (dpi: 192).


    function generate(id) {
        document.getElementById(id).style.transform = document.getElementById(id).style.webkitTransform = 'scale(2)'
        document.getElementById(id).style.transformOrigin = document.getElementById(id).style.webkitTransformOrigin = '0 0'
        html2canvas(document.getElementById(id),{
            width: document.getElementById(id).offsetWidth * 2,
            height: document.getElementById(id).offsetHeight * 2,
            background:"#fff"
        } ).then(function(canvas) {
            $("#imgcanvas").append(canvas);
            document.getElementById(id).style.transform = document.getElementById(id).style.webkitTransform = 'scale(1)'
        })
//
//        document.getElementById(id).style.transform = document.getElementById(id).style.webkitTransform = 'scale(1)';
//        var elmt = document.getElementById(id);
//        elmt.style.transform = "translateX(-50%)";
//        elmt.style.margin = "margin-left: 50%";
//        elmt.style.width = "100vh";
//        elmt.style.table = "table-layout: fixed";
    }
</script>
</body>
</html>