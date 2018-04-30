<?php

// https://github.com/parsecsv/parsecsv-for-php
require_once("parsecsv-for-php/parsecsv.lib.php");



$csv = new ParseCsv\Csv();
$csv->encoding('UTF-16', 'UTF-8');
$csv->delimiter = ";";
$csv->parse('tableau-de-mots.csv');


// champs :
/*
Mot
Prénom
Nom
Date d'insertion
Type (nom commun, artiste, graphiste, collectif, livre, film, etc.)
Définition
Source
Prénom auteur (si le mot est une œuvre ou une citation)
Nom de famille auteur
Date de naissance et décès
Mots-clés associés (alphabétiquement)
Liens images en ligne
Éditeur
Date de création (si œuvre) ou de parution
Pays
Ville
Remarque
*/


function cmp($a, $b) {
    if ( strtolower($a['Nom']) == strtolower($b['Nom']) ) {
        return 0;
    }
    return ( strtolower($a['Nom']) < strtolower($b['Nom']) )	 ? -1 : 1;
}

$texte = "";

// https://secure.php.net/manual/fr/array.sorting.php
uasort($csv->data, 'cmp');


foreach ($csv->data as $key => $ligne) {
	echo $key . " => " .$ligne['Prénom'] .' '.$ligne['Nom'] ."\n";

	$texte .= $ligne['Définition']." ";

}

$ponctuation = array(",", ".", ";", "'", "’", "\"", ":", "?", "!", "[", "]", "«", "»", "(", ")", "-", "_", "—", "–", "/", "\t","“","…"," ");
$texte = str_replace($ponctuation, " ", $texte);
$texte = preg_replace('/[\n]+/', " ", $texte);
$texte = preg_replace('/[ ]+/', " ", $texte);
// echo $texte;

$mots = explode(" ", $texte);


asort($mots);
// print_r($mots);

$mots3lettres = array();

foreach ($mots as $key => $mot) {
	$mots[$key] = trim($mot);
}

foreach ($mots as $key => $mot) {
	
	if(strlen($mot) >= 3){ // nombre de lettres
		if( array_key_exists($mot, $mots3lettres) ){
			$mots3lettres[$mot] ++;
		}else{
			$mots3lettres[$mot] = 1;
		}
	}
}

foreach ($mots3lettres as $mot => $nbr) {
	if($nbr <= 1){
		unset( $mots3lettres[$mot] );
	}
}

asort($mots3lettres);


print_r($mots3lettres);
