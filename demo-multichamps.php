<?php

// ici c'est le bloc pour préparer la librairie permettant l'analyse du fichier CSV

require_once("parsecsv-for-php/parsecsv.lib.php");

// on déclare le parser (l'analyseur)
$csv = new ParseCsv\Csv();
$csv->encoding('UTF-16', 'UTF-8');
$csv->delimiter = ";";

// on parse les données (on les analyse, on les filtre)
$csv->parse('tableau-de-mots.csv');


// print_r($csv->data);


$xml = "<livre>";

foreach( $csv->data as $ligne ){

	$definition = mb_strtolower($ligne["Définition"]);
	$mot = mb_strtolower($ligne["Mot"]);

	if( strpos($definition, 'artiste') === false && strpos($mot, 'artiste') === false ){

		$xml .= "<nom><prenom>".$ligne["Prénom"] . "</prenom> " . $ligne["Nom"]."</nom>\n";
		$xml .= "<mot>".$ligne["Mot"] . "</mot>\n";
		$xml .= "<definition>".$ligne["Définition"] . "</definition>\n";
	}

}

$xml .= "</livre>";


$xml = str_replace("&", "&amp;", $xml);

// echo $xml;

file_put_contents("livre-multichamps.xml", $xml);

