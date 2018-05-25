<?php
require_once("parsecsv-for-php/parsecsv.lib.php");
$csv = new ParseCsv\Csv(); $csv->encoding('UTF-16', 'UTF-8'); 
$csv->delimiter = ";";   $csv->parse('tableau-de-mots-EXCEL.csv');   

print_r($csv->data);  

$xml = "<livre>";  

foreach( $csv->data as $numeroDeLigne => $ligne ){          

	$csv->data[ $numeroDeLigne ]["nbrLettres"] = strlen( $ligne["Mot"] ); 
} 

uasort($csv->data, 'comparaison'); 

function comparaison($a, $b) {   

	if ( $a['nbrLettres'] == $b['nbrLettres'] ) {        
		return 0;  
	}   
	return ( $a['nbrLettres'] < $b['nbrLettres'] ) ? -1 : 1; 
} 

foreach( $csv->data as $numeroDeLigne => $ligne ){
	$mot = $ligne["Mot"];
	$xml .= "<nom>" . strlen($mot) . " $mot</nom>\n";
}

print_r($csv->data);

$xml .= "</livre>";

file_put_contents("livre-test.xml", $xml); 

