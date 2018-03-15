<?php


require_once("parsecsv-for-php/parsecsv.lib.php");

// on déclare le parser (l'analyseur)
$csv = new ParseCsv\Csv();
$csv->encoding('UTF-16', 'UTF-8');
$csv->delimiter = ";";


// on parse les données (on les analyse, on les filtre)
$csv->parse('tableau-de-mots.csv');


print_r($csv->data);