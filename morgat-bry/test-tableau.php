<?php

$largeur = 523.276;
$hauteur = 769.89;
$lignes = 20;
$colonnes = 20;

$words = ['crisco', 'langage', 'symbole', 'bulle', 'humour', 'lettrage', 'ecal' ];

$crossword = new \Crossword\Crossword($lignes, $colonnes, $words);
$isGenerated = $crossword->generate(\Crossword\Generate\Generate::TYPE_RANDOM, true);


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



$txtAID = "<UNICODE-MAC>
<Version:13><FeatureSet:InDesign-Roman><ColorTable:=<Paper:COLOR:CMYK:Process:0,0,0,0><Black:COLOR:CMYK:Process:0,0,0,1>>
<DefineParaStyle:lettretableau=<Nextstyle:lettretableau><cSize:4.000000><cFont:Monaco><pTextAlignment:Center><pShadingColor:Black><pShadingTint:20.000000>>
<DefineParaStyle:NormalParagraphStyle=<Nextstyle:NormalParagraphStyle>>
<DefineCellStyle:sans=<tCellAttrLeftStrokeWeight:0><tCellAttrRightStrokeWeight:0><tCellAttrTopStrokeWeight:0><tCellAttrBottomStrokeWeight:0>>
<DefineCellStyle:lettre=<tCellAttrLeftStrokeWeight:3><tCellAttrRightStrokeWeight:3><tCellAttrTopStrokeWeight:3><tCellAttrBottomStrokeWeight:3><tCellLeftStrokeColor:Black><tCellTopStrokeColor:Black><tCellRightStrokeColor:Black><tCellBottomStrokeColor:Black><tcLeftStrokeType:Solid><tcRightStrokeType:Solid><tcTopStrokeType:Solid><tcBottomStrokeType:Solid><tCellAttrLeftStrokeTint:100><tCellAttrRightStrokeTint:100><tCellAttrTopStrokeTint:100><tCellAttrBottomStrokeTint:100><tCellLeftStrokeOverprint:0><tCellRightStrokeOverprint:0><tCellTopStrokeOverprint:0><tCellBottomStrokeOverprint:0><tCellLeftStrokeGapTint:100><tCellRightStrokeGapTint:100><tCellTopStrokeGapTint:100><tCellBottomStrokeGapTint:100><tCellLeftStrokeGapColor:Paper><tCellRightStrokeGapColor:Paper><tCellTopStrokeGapColor:Paper><tCellBottomStrokeGapColor:Paper><tCellStyleParaStyle:lettretableau><tPageItemCellAttrLeftInset:0><tPageItemCellAttrTopInset:0><tPageItemCellAttrRightInset:0><tPageItemCellAttrBottomInset:0>>
<DefineTableStyle:motcroise=<tOuterLeftStrokeWeight:0><tOuterRightStrokeWeight:0><tOuterTopStrokeWeight:0><tOuterBottomStrokeWeight:0>>";


$txtAID .= "
<ParaStyle:NormalParagraphStyle><TableStyle:motcroise><TableStart:$lignes,$colonnes:0:0<tCellDefaultCellType:Text>>";
// $txtAID .= "<ParaStyle:NormalParagraphStyle><TableStyle:lettretableau>";
// $txtAID .= "<TableStart:".$lignes.",".$colonnes.":0:0<tCellDefaultCellType:sans>>";

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

// https://secure.php.net/manual/en/mbstring.supported-encodings.php
file_put_contents("mot-croise-utf16.txt", mb_convert_encoding($txtAID, "UTF-16LE") );

// $hex = bin2hex($txtAID);

// $hexDef ="";

// for($i = 0; strlen($hex); $i+=2){
// 	// echo $hex[$i].$hex[$i+1]."\n";
// 	// 
// 	if( !empty($hex[$i].$hex[$i+1]) ){

// 		echo "-> $i ".$hex[$i].$hex[$i+1]."\0\0\n";

// 		$hexDef .= $hex[$i].$hex[$i+1]."\0\0";

// 	}else{

// 		echo "•> $i \n";
// 	}
// }

// file_put_contents("mot-croise.txt", hex2bin( $hexDef ) );

