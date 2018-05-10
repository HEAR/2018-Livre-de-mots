<?php


require_once("parsecsv-for-php/parsecsv.lib.php");

// on déclare le parser (l'analyseur)
$csv = new ParseCsv\Csv();
$csv->encoding('UTF-16', 'UTF-8');
$csv->delimiter = ";";


// on parse les données (on les analyse, on les filtre)
$csv->parse('tableau-de-mots-EXCEL.csv');


print_r($csv->data);

$xml = "<livre>";

foreach( $csv->data as $numeroDeLigne => $ligne ){



	// $csv->data[ $key ]  <=> $ligne

	$csv->data[ $numeroDeLigne ]["nbrLettres"] = strlen( $ligne["Mot"] );

	//$pos = strpos( $ligne["Mot"], "o" );

	//if( $pos ===false ){

		// $mot = $ligne["Mot"];

		// $mot = str_replace("Oe","Œ",$mot);

		// $xml .= "<nom>" . strlen($mot) . " $mot</nom>\n";
		// print_r( $mot ." " . strlen($mot) . "\n" );
	//}

}

print_r($csv->data);

$xml .= "</livre>";

file_put_contents("livre-test.xml", $xml);












