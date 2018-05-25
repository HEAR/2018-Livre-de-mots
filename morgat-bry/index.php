<?php

// http://phpcrossword.sourceforge.net/demo.php?cols=15&rows=15&max_words=15&groupid=large
// http://phpcrossword.sourceforge.net/demo-user-words.php
// http://bryanhelmig.com/python-crossword-puzzle-generator/

// https://github.com/MironowDW/Crossword
// 

require_once "Crossword-master/demo/autoloader.php";



require_once("../parsecsv-for-php/parsecsv.lib.php");
// on déclare le parser (l'analyseur)
$csv = new ParseCsv\Csv();
// $csv->encoding('UTF-16', 'UTF-8');
$csv->delimiter = ";";
// on parse les données (on les analyse, on les filtre)
$csv->parse('tableau-de-mots.csv');



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


$oldPrenom = "";

$donnees = array();


// ON TRIE LES DONNEES
foreach ($csv->data as $key => $ligne) {

	$mot	= trim( $ligne["Mot"] );
	$prenom = $ligne["Prénom"] ;

	if($prenom != ""){
		if($oldPrenom != $prenom ){
			// echo $prenom."\n";

			$prenomInfo 		= new stdClass;
			$listeMots 			= array();
			$listeDefinitions 	= array();
		}

		$pattern = '/[0-9]/';


		if( !empty($mot) &&
			str_word_count($mot) <=1 &&
			preg_match($pattern, $mot, $matches, PREG_OFFSET_CAPTURE) == 0 &&
			strpos($mot, "-") === false &&
			strpos($mot, "'") === false ){

			$listeMots[] = $mot;

			$motInfo = new stdClass;

			$motInfo->mot = $mot;
			$motInfo->definition = $ligne["Définition"];

			$listeDefinitions[] = $motInfo;
		}

		$prenomInfo->prenom 			= $prenom;
		$prenomInfo->listeMots 			= $listeMots;
		$prenomInfo->listeDefinitions 	= $listeDefinitions;

		$donnees[$prenom] = $prenomInfo;

		$oldPrenom = $prenom;
	}
}

$largeur 	= 523.276;
$hauteur 	= 769.89;
$lignes 	= 40;
$colonnes 	= 40;



$txtAID = "<UNICODE-MAC>
<Version:13><FeatureSet:InDesign-Roman><ColorTable:=<Paper:COLOR:CMYK:Process:0,0,0,0><Black:COLOR:CMYK:Process:0,0,0,1>>
<DefineParaStyle:nom=<Nextstyle:nom><cTypeface:Blanca><cFont:Perec><pTextAlignment:Center><cOTFContAlt:0>>
<DefineParaStyle:mot=<Nextstyle:mot><cTypeface:Blanca><cFont:Perec><pTextAlignment:Center><cOTFContAlt:0>>
<DefineParaStyle:definition=<Nextstyle:definition><cTypeface:Negra><cSize:8.000000><pHyphenationLadderLimit:2><pHyphenation:0><pMinCharBeforeHyphen:3><pMinCharAfterHyphen:3><pHyphenateCapitals:0><pShortestWordHyphenated:6><pSpaceAfter:8.000000><cFont:Perec><pHyphenateLastWord:0><pHyphenateCrossFrame:0><cOTFContAlt:0>>
<DefineParaStyle:lettretableau=<Nextstyle:lettretableau><cSize:4.000000><cFont:Monaco><pTextAlignment:Center><pShadingColor:Black><pShadingTint:20.000000>>
<DefineParaStyle:NormalParagraphStyle=<Nextstyle:NormalParagraphStyle>>
<DefineCellStyle:sans=<tCellAttrLeftStrokeWeight:0><tCellAttrRightStrokeWeight:0><tCellAttrTopStrokeWeight:0><tCellAttrBottomStrokeWeight:0>>
<DefineCellStyle:lettre=<tCellAttrLeftStrokeWeight:3><tCellAttrRightStrokeWeight:3><tCellAttrTopStrokeWeight:3><tCellAttrBottomStrokeWeight:3><tCellLeftStrokeColor:Black><tCellTopStrokeColor:Black><tCellRightStrokeColor:Black><tCellBottomStrokeColor:Black><tcLeftStrokeType:Solid><tcRightStrokeType:Solid><tcTopStrokeType:Solid><tcBottomStrokeType:Solid><tCellAttrLeftStrokeTint:100><tCellAttrRightStrokeTint:100><tCellAttrTopStrokeTint:100><tCellAttrBottomStrokeTint:100><tCellLeftStrokeOverprint:0><tCellRightStrokeOverprint:0><tCellTopStrokeOverprint:0><tCellBottomStrokeOverprint:0><tCellLeftStrokeGapTint:100><tCellRightStrokeGapTint:100><tCellTopStrokeGapTint:100><tCellBottomStrokeGapTint:100><tCellLeftStrokeGapColor:Paper><tCellRightStrokeGapColor:Paper><tCellTopStrokeGapColor:Paper><tCellBottomStrokeGapColor:Paper><tCellStyleParaStyle:lettretableau><tPageItemCellAttrLeftInset:0><tPageItemCellAttrTopInset:0><tPageItemCellAttrRightInset:0><tPageItemCellAttrBottomInset:0>>
<DefineTableStyle:motcroise=<tOuterLeftStrokeWeight:0><tOuterRightStrokeWeight:0><tOuterTopStrokeWeight:0><tOuterBottomStrokeWeight:0>>";

// ON TRAITE LES DONNEES
foreach ($donnees as $key => $personne) {
	echo $personne->prenom."\n";


	print_r($personne->listeMots );


	$crossword = new \Crossword\Crossword($lignes, $colonnes, $personne->listeMots);
	$isGenerated = $crossword->generate(\Crossword\Generate\Generate::TYPE_RANDOM, false);

	$tableau  = $crossword->toArray();

	print_r($tableau );

	$txtAID .= "<ParaStyle:nom>".$personne->prenom."\n";

	$i = 1;
	foreach ($prenomInfo->listeDefinitions as $key => $definition) {

		$txtAID .= "<ParaStyle:mot>$i\n";
		$txtAID .= "<ParaStyle:definition>".$definition->definition."\n";

		$i++;
	}
	$txtAID .= "<ParaStyle:mot><cNextXChars:Page>";

	$txtAID .= "
<ParaStyle:NormalParagraphStyle><TableStyle:motcroise><TableStart:$lignes,$colonnes:0:0<tCellDefaultCellType:Text>>";

	// on défini les colonnes du tableau
	for( $y=0; $y< $colonnes; $y++){
		$txtAID .= "<ColStart:<tColAttrWidth:". ($largeur / $colonnes) .">>";
	}

	// on énumère les lignes et les cellules
	for( $y = 0; $y < $lignes; $y++){

		$txtAID .= "<RowStart:<tRowAttrHeight:".($largeur / $colonnes).">";

		$txtAID .= "<tRowAttrMinRowSize:".($largeur / $colonnes)."><tRowAutoGrow:0>>";



		for( $x = 0; $x < $colonnes; $x++){

			// si la cellule a un contenu
			if( !empty( $tableau[$y][$x] ) ){

				$txtAID .= "<CellStyle:lettre><StylePriority:2><CellStart:1,1><ParaStyle:lettretableau>".$tableau[$y][$x]."<CellEnd:>";
			}

			// si la cellule est vide
			else{
				$txtAID .= "<CellStyle:sans><StylePriority:1><CellStart:1,1><CellEnd:>";
			}
		}
		$txtAID.= "<RowEnd:>";
	}


	$txtAID .= "<TableEnd:>
	";


	$txtAID .= "<ParaStyle:mot><cNextXChars:Page>";

}

file_put_contents("mot-croise-YOUPI.txt", mb_convert_encoding($txtAID, "UTF-16LE") );

