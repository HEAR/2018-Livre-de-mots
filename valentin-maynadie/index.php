<?php
setlocale(LC_TIME, "fr_FR");
mb_internal_encoding('UTF-8');



$data = file_get_contents("data.txt");



// 571.0 Numéro de version 571.0	
// 13/04/2018 00:57		Aucune information de présenceHORELLOU Loïc	256,6 Ko Taille 256,6 Ko	


$pattern = "/([0-9]{0,}\.0) Numéro de version [0-9]{0,}\.0\t\r\n([0-9]{1,2}\/[0-9]{1,2}\/[0-9]{1,4}) ([0-9]{1,2}:[0-9]{1,2})\t\tAucune information de présence([\w]+ [\w]+)\t[0-9]{1,},[0-9]{1,} Ko Taille ([0-9]{1,},[0-9]{1,}) Ko/i";


preg_match_all($pattern, $data, $out, PREG_SET_ORDER);



$donnees = array();


foreach ($out as $key => $ligne) {
	// echo "++++++++++++++++\n";


	$poids = floatVal( str_replace(",", ".", $ligne[5]));

	$index = intVal($ligne[1]);

	$info = new stdClass;

	$info->date 	= $ligne[2];
	$info->heure 	= $ligne[3];
	$info->nom 		= $ligne[4];
	$info->poids 	= $poids;


	$donnees[ $index ] = $info;
}

ksort($donnees);


$diff = 0;
$oldPoids = 0;


foreach ($donnees as $key => $ligne) {

	$diff = round($ligne->poids - $oldPoids, 2);

	$supprWarning = $diff<0? " SUPPRESSION !!!!!": "";

	// echo "\t".strtotime($ligne->date)."\n";
	// 
	// $date = explode("/",$ligne->date);

	$timestamp = strtotime($ligne->date." ".$ligne->heure);

	echo "\t".strftime("%A %e %B %Y à %Hh%M", $timestamp)."\n";


	echo "{$ligne->date} {$ligne->heure} {$ligne->nom} {$ligne->poids}Ko => {$diff}Ko $supprWarning\n";


	$oldPoids = $ligne->poids ;
}

// print_r($donnees);



