<!DOCTYPE html>
<html>
	<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>INDEX</title>

	<link href="https://fonts.googleapis.com/css?family=Source+Code+Pro:200,400" rel="stylesheet">

	<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
	<script src="masonry.pkgd.min.js"></script>


		<style type="text/css">

			* { box-sizing: border-box; }

			ul { list-style-type: none; margin: 0; padding: 0; font-family: 'Source Code Pro', monospace; font-weight: 200; color: white; max-width: content; }
			
			li { background: white; border: 1px solid black; color: black; font-size: 20px; width: content; margin: 10px; padding: 8px; float:left;}

			li:hover{background-color: black; color: white; border: 1px solid black;}


		</style>

	</head>
	<body>
        <p>
<ul>
          <?php


require_once("../parsecsv-for-php/parsecsv.lib.php");

// on déclare le parser (l'analyseur)
$csv = new ParseCsv\Csv();
// $csv->encoding('UTF-16', 'UTF-8');
$csv->delimiter = ",";
// on parse les données (on les analyse, on les filtre)
$csv->parse('tableau-de-mots3.csv');

// $row = 1;
// if (($handle = fopen("tableau-de-mots.csv", "r")) !== FALSE) {
//     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//         $num = count($data);
//         echo "<p> $num champs à la ligne $row: <br /></p>\n";
//         $row++;
//         for ($c=0; $c < $num; $c++) {
//             echo $data[$c] . "<br />\n";
//         }
//     }
//     fclose($handle);
// }
//analiser une colonne, lecture dans le terminal
// foreach( $csv->data as $ligne ){

// 	print_r( $ligne["Mot"] . "\n");

// }

foreach( $csv->data as $key => $ligne ){

	echo "<li data-clef='' id='mot".$key."'
	class='liste'><a href='?id".$key."'>".$ligne["Définition"]."</a></li>";

}

//par ordre alphabétique 
function cmp($a, $b) {
  
        if ( strtolower($a["Mot"]) == strtolower($b["Mot"]) ) {
	        return 0;
	    }
	   	return ( strtolower($a["Mot"]) < strtolower($b["Mot"]) ) ? -1 : 1;
}

uasort($csv->data, 'cmp');

foreach($csv->data as $ligne){


		if(!empty($ligne["Mot"] )){
		$xml .= "<mot>".$ligne["Mot"] . "</mot>\n";
		}

		if(!empty($ligne["Date de création (si œuvre) ou de parution"] )){
		$xml .= "<Date de création (si œuvre) ou de parution>".$ligne["Date de création (si œuvre) ou de parution"] . "</Date de création (si œuvre) ou de parution>\n";
		}

		//etc

}




//parse csv2php
// $row = 1;
// if (($handle = fopen("test.csv", "r")) !== FALSE) {
//   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//     $num = count($data);
//     echo "<p> $num fields in line $row: <br /></p>\n";
//     $row++;
//     for ($c=0; $c < $num; $c++) {
//         echo $data[$c] . "<br />\n";
//     }
//   }
//   fclose($handle);
// }
?>
</ul>
        </p>   
	</body>
</html>