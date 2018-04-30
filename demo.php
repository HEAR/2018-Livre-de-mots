<?php


require_once("parsecsv-for-php/parsecsv.lib.php");

// on déclare le parser (l'analyseur)
$csv = new ParseCsv\Csv();
$csv->encoding('UTF-16', 'UTF-8');
$csv->delimiter = ";";


// on parse les données (on les analyse, on les filtre)
$csv->parse('tableau-de-mots-EXCEL.csv');


// print_r($csv->data);

$xml = "<livre>";

// on compte les lettres des mots
foreach( $csv->data as $numeroDeLigne => $ligne ){

	$csv->data[ $numeroDeLigne ]["nbrLettres"] = strlen( $ligne["Mot"] );

}

// on trie avec la fonction de comparaison
uasort($csv->data, 'comparaison');

function comparaison($a, $b) {
    if ( $a['nbrLettres'] == $b['nbrLettres'] ) {
        return 0;
    }
    return ( $a['nbrLettres'] < $b['nbrLettres'] ) ? -1 : 1;
}

foreach( $csv->data as $numeroDeLigne => $ligne ){

	$mot = $ligne["Mot"];

	downloadGoogle($mot,0);


	$xml .= "<nom>" . strlen($mot) . " $mot</nom>\n";
}


// print_r($csv->data);

$xml .= "</livre>";

file_put_contents("livre-test.xml", $xml);



// downloadGoogle("toaster");
// downloadGoogle("grille pain");



function downloadGoogle($requete = false, $delais = 3){

	if(!is_dir('images')){
		mkdir('images');
	}

	if($requete){

		// https://www.google.fr/search?q=Les+champs+de+r%C3%A9sonances&source=lnms&tbm=isch

		$cible = str_replace(' ','_',$requete);

		$requete = str_replace(' ','+',$requete);



		echo $cible."\n";

		$url = "https://www.google.fr/search?q=$requete&source=lnms&tbm=isch";

		$result = file_get_contents($url);

		$pattern = "/src\s*=\s*(\"|')(([^\"';]*))(\"|')/";

		//echo $result;

		preg_match($pattern, $result, $matches, PREG_OFFSET_CAPTURE, 3);

		//print_r($matches[2][0]);

		try {
			$image = file_get_contents($matches[2][0]) ;

			if($image){
				file_put_contents('images/'.$cible.".jpg", $image);

				echo date('l jS \of F Y h:i:s A')."\n";
				echo "sleep $delais\n";
				sleep( $delais );
			}
		} catch (Exception $e) {
			// echo 'Caught exception: ',  $e->getMessage(), "\n";
			echo "l'image n'existe pas pour l'ISBN $isbn\n";
		}
	}

}




