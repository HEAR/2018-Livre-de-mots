<?php


require_once("parsecsv-for-php/parsecsv.lib.php");

// on déclare le parser (l'analyseur)
$csv = new ParseCsv\Csv();
$csv->encoding('UTF-16', 'UTF-8');
$csv->delimiter = ";";


// on parse les données (on les analyse, on les filtre)
$csv->parse('tableau-de-mots.csv');


print_r($csv->data);
// echo ± print_r
// print_r( count( $csv->data ) . "\n" );
/*
function cmp($a, $b) {
	if ( strtolower($a['Nom']) == strtolower($b['Nom']) ) {
		//return 0;
		if ( strtolower($a['Mot']) == strtolower($b['Mot']) ) {
			return 0;
		}
		return ( strtolower($a['Mot']) < strtolower($b['Mot']) )	 ? -1 : 1;
	}
	return ( strtolower($a['Nom']) < strtolower($b['Nom']) )	 ? -1 : 1;
}

uasort($csv->data, 'cmp');

$xml = "<livre>";

foreach( $csv->data as $ligne ){

	$xml .= "<nom><prenom>".$ligne["Prénom"] . "</prenom> " . $ligne["Nom"]."</nom>\n";
	$xml .= "<mot>".$ligne["Mot"] . "</mot>\n";
	$xml .= "<definition>".$ligne["Définition"] . "</definition>\n";

	// print_r( "=>\t" .$ligne["Prénom"] . " " . $ligne["Nom"] . "\n" );
	// print_r( "\t[ " .$ligne["Mot"] . " ]\n" );
	// print_r( $ligne['Définition'] . "\n" );

}

$xml .= "</livre>";

echo $xml;

file_put_contents("livre.xml", $xml);
*/
