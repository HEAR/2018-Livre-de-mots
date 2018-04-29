<?php
// ici c'est le bloc pour préparer la librairie permettant l'analyse du fichier CSV
require_once("../parsecsv-for-php/parsecsv.lib.php");
// on déclare le parser (l'analyseur)
$csv = new ParseCsv\Csv();
$csv->encoding('UTF-16', 'UTF-8');
$csv->delimiter = ";";
// on parse les données (on les analyse, on les filtre)
$csv->parse('tableau-de-motsV2.csv');
// print_r($csv->data);
$xml = "<livre>";

foreach( $csv->data as $key => $ligne ){
	$csv->data[$key]['MotTri'] = str_without_accents($ligne["Mot"]);

	if($ligne['Type (Nom commun, artiste, graphiste, collectif, livre, film, etc.)'] != 'Citation' && !empty($ligne["Mot"]) ){

		if(!is_file('html/'.$key.'.txt')){
			$googleHTML = file_get_contents("https://www.google.fr/search?q=".$ligne["Mot"]);

			sleep(10);

			file_put_contents('html/'.$key.'.txt', $googleHTML );


		}else{

			$googleHTML = file_get_contents('html/'.$key.'.txt');
		}

		preg_match_all("/id=\"resultStats\">Environ ([0-9 ]+)/", $googleHTML, $out, PREG_PATTERN_ORDER);

		$nombre = str_replace("\xA0", "", $out[1][0]);

		echo $ligne["Mot"]." ".$nombre."\n";

		$csv->data[$key]	 = $nombre;

	}


	// break;
}



function cmp($a, $b) {
    if ( strtolower($a['nbrResultat']) == strtolower($b['nbrResultat']) ) {
        return 0;
    }
    return ( strtolower($a['nbrResultat']) < strtolower($b['nbrResultat']) ) ? 1 : -1; 
}

 // https://secure.php.net/manual/fr/array.sorting.php
uasort($csv->data, 'cmp');


foreach( $csv->data as $ligne ){
	//$xml .= "<nom><prenom>".$ligne["Prénom"] . "</prenom> " . $ligne["Nom"]."</nom>\n";
	
	if($ligne['Type (Nom commun, artiste, graphiste, collectif, livre, film, etc.)'] != 'Citation' && !empty($ligne["Mot"]) ){

		$xml .= "<mot>".$ligne["Mot"] . "</mot>\n";

	}
	
	//$xml .= "<definition>".$ligne["Définition"] . "</definition>\n";
}
$xml .= "</livre>";
$xml = str_replace("&", "&amp;", $xml);
// echo $xml;
file_put_contents("index-alpha.xml", $xml);

//exclure toutes les definitons avec tel mot ou tel mot


function str_without_accents($str, $charset='utf-8'){
    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

    return $str;   // or add this : mb_strtoupper($str); for uppercase :)
}
