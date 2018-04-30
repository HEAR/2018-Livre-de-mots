<?php

// http://phpcrossword.sourceforge.net/demo.php?cols=15&rows=15&max_words=15&groupid=large
// http://phpcrossword.sourceforge.net/demo-user-words.php
// http://bryanhelmig.com/python-crossword-puzzle-generator/

// https://github.com/MironowDW/Crossword
// 

require_once "Crossword-master/demo/autoloader.php";


$words = ['ubuntu', 'bower', 'seed', 'need', 'hello', 'on', 'hi', ];

$crossword = new \Crossword\Crossword(9, 9, $words);
$isGenerated = $crossword->generate(\Crossword\Generate\Generate::TYPE_RANDOM);


$tableau  = $crossword->toArray();
// print_r($crossword->toArray());
// 
// 
// 
// https://www.lynda.com/InDesign-tutorials/XML-creation-basics/53705/69541-4.html?utm_medium=viral&utm_source=youtube&utm_campaign=videoupload-53705-0704
// 
// 
// https://helpx.adobe.com/fr/indesign/using/importing-xml.html
// https://wwwimages2.adobe.com/content/dam/acom/en/products/indesign/pdfs/indesign_and_xml_technical_reference.pdf => page 22
// 
// https://helpx.adobe.com/indesign/using/default-keyboard-shortcuts.html#keys_for_working_with_xml
// 
// http://www.ozalto.com/5-erreurs-que-vous-ferez-avec-limport-xml-dans-adobe-indesign/
// http://www.ozalto.com/oubliez-la-validation-dtd-dans-adobe-indesign/
// http://www.ozalto.com/savoir-limport-xml-adobe-indesign/
// 
// 
// !!! https://pagination.com/tutorials/indesign-xml/

$xml = "<Root xmlns:aid=\"http://ns.adobe.com/AdobeInDesign/4.0/\"\nxmlns:aid5=\"http://ns.adobe.com/AdobeInDesign/5.0/\">\n";

$xml .= "<Table aid:table=\"table\" aid:trows=\"9\" aid:tcols=\"9\" aid5:table>\n";


for( $y = 0; $y < 9; $y++){
	for( $x = 0; $x < 9; $x++){


		$xml .= "<Cell aid:table=\"cell\" aid:crows=\"".($y+1)."\" aid:ccols=\"".($x+1)."\" aid:ccolwidth=\"38\">".$tableau[$y][$x]."</Cell>\n";
		// $xml .= "<Cell aid:table=\"cell\" aid:crows=\"".($y+1)."\" aid:ccols=\"".($x+1)."\" aid:ccolwidth=\"38.772\">".$tableau[$y][$x]."</Cell>\n";
	
	}

	// $xml .= "\n";
}

$xml .= "</Table>\n";
$xml .= "</Root>\n";


file_put_contents("mot-croise.xml", $xml);


// foreach($tableau as $numLigne => $ligne){

// 	foreach ($ligne as $numColonne => $colonne) {
		
// 		print_r($numColonne . ' '. $numLigne .' '. $colonne."\n");

// 	}

// }