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


function cmp($a, $b) {
    if ( strtolower($a['Nom']) == strtolower($b['Nom']) ) {
         if ( strtolower($a['Prénom']) == strtolower($b['Prénom']) ) {
	        return 0;
	    }
	    return ( strtolower($a['Prénom']) < strtolower($b['Prénom']) ) ? -1 : 1;
    }
    return ( strtolower($a['Nom']) < strtolower($b['Nom']) ) ? -1 : 1;
}


shuffle($csv->data);

uasort($csv->data, 'cmp');

$xml = "<livre>";

foreach( $csv->data as $ligne ){


	$pattern = '/[0-9]/';
//$ponctuation = array(",", ".", ";", "'", "’", "\"", ":", "?", "!", "[", "]", "«", "»", "(", ")", "-", "_", "—", "–", "/", "\t","“","…"," ");
//$texte = str_replace($ponctuation, $pattern, $texte);

	


	// print_r(str_word_count($ligne["Mot"]).' '.$ligne["Mot"]."\n");

	if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Gaby" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}



}


foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Morgat" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}

foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Alice" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}

foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Quitterie" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}

foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Victoria" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}

foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Laurine" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}

foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Valentin" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}

foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Lucie" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}

foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Anna" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}

foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Valentine" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}

foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Marie" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}

foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Julia" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}

foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Chani" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}

foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Pauline" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}

foreach( $csv->data as $ligne ){
	$pattern = '/[0-9]/';

if( str_word_count($ligne["Mot"]) <=1 && preg_match($pattern, $ligne["Mot"], $matches, PREG_OFFSET_CAPTURE) == 0 && $ligne["Prénom"] == "Angela" ){
		$xml .= "<" . $ligne["Prénom"] . ">";
		$xml .= "<mot>" . $ligne["Mot"] . "</mot>\n" . "<definition>".$ligne["Définition"] . "</definition>\n";
		$xml .= "</" . $ligne["Prénom"] . ">\n";		
	// $xml .= "<source>".$ligne["Source"] . "</source>\n";
	}
}



$xml .= "</livre>";


$xml = str_replace("&", "&amp;", $xml);

// echo $xml;

file_put_contents("livre-multichamps.xml", $xml);

