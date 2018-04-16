<?php

require_once("../parsecsv-for-php/parsecsv.lib.php");

// on déclare le parser (l'analyseur)
$csv = new ParseCsv\Csv();
// $csv->encoding('UTF-16', 'UTF-8');
$csv->delimiter = ",";
// on parse les données (on les analyse, on les filtre)
$csv->parse('tableau-de-mots3.csv');


$nbr_elements = count($csv->data);

echo "$nbr_elements\n";

// on ajoute une colonne MotSansAccent pour pouvoir trier correctement
// on enlève également les guillemets et les espaces de début et de fin
// for($i; $i < count($csv->data) ; $i++ ){
// 	$temp = str_without_accents($csv->data[$i]['Mot']);

// 	$csv->data[$i]['temp'] = $temp;
// }

//par ordre alphabétique 
function cmp($a, $b) {
  
        if ( strtolower($a["Mot"]) == strtolower($b["Mot"]) ) {
	        return 0;
	    }
	   	return ( strtolower($a["Mot"]) < strtolower($b["Mot"]) ) ? -1 : 1;
}

uasort($csv->data, 'cmp');


$html = file_get_contents("temp_header.php");

$html_mots        = array();
$html_definitions = array();
$html_images      = array();




foreach( $csv->data as $key => $ligne ){

	if(!empty($ligne["Mot"] )){
		$html_mots[] = "<li id='mot-$key' class='liste'><span>$key</span> {$ligne['Mot']}</li>";
	} 

	if(!empty($ligne["Définition"] )){
		$html_definitions[$key] = "<li id='definition-$key' class='liste'><span>$key</span> {$ligne['Définition']}</li>";
	} 

	$files = glob("images/".$key.".*");
	echo $key." => ".count($files)."\n"; 

	if(!empty($ligne["Liens images en ligne"] && count($files) == 0 )){

		// on va vérifier que c'est un image
		// https://stackoverflow.com/questions/676949/best-way-to-determine-if-a-url-is-an-image-in-php
		$headers = @get_headers($ligne["Liens images en ligne"], 1); // @ to suppress errors. Remove when debugging.

		echo "\t".$key." => ".$headers['Content-Type']."\n";
		print_r($headers['Content-Type']);
		echo "\n";

		if (isset($headers['Content-Type'])) {
			if (strpos($headers['Content-Type'], 'image/') === FALSE) {
    			// Not a regular image (including a 404).
			}
			else {
    			// It's an image!
    			$ext = explode("/", $headers['Content-Type']);
    			file_put_contents( "images/".$key.".".$ext[1] ,file_get_contents($ligne["Liens images en ligne"]));
			}
		}
		else {
  			// No 'Content-Type' returned.
		}	
	} 


	if(count($files)){
		foreach($files as $image){

			$html_images[$key] = "<li id='image-$key' class='liste'><span>$key</span> <img src='$image'></li>";
		}
	}

} // fermeture du foreach




// LA LISTE DES MOTS

$html .= "<ul>\n";
$html .= "<li class='liste'><h2>Mots</h2></li>\n";
$html .= implode("\n", $html_mots);
$html .= "</ul>\n";


// LA LISTE DES DEFINITIONS

$html .= "<ul>\n";
$html .= "<li class='liste'><h2>Définitions</h2></li>\n";
ksort($html_definitions);
$html .= implode("\n", $html_definitions);
$html .= "</ul>\n";


// LA LISTE DES IMAGES

$html .= "<ul>\n";
$html .= "<li class='liste'><h2>Images</h2></li>\n";
ksort($html_images);
$html .= implode("\n", $html_images);
$html .= "</ul>\n";


$html .= file_get_contents("temp_footer.php");


file_put_contents("index.html", $html);


// https://stackoverflow.com/questions/1017599/how-do-i-remove-accents-from-characters-in-a-php-string#10790734
function str_without_accents($str, $charset='utf-8'){
    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

    return $str;   // or add this : mb_strtoupper($str); for uppercase :)
}

