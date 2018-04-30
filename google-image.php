<?php

date_default_timezone_set('Europe/Paris');


set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

// https://www.google.fr/search?q=Les+champs+de+r%C3%A9sonances&source=lnms&tbm=isch
// https://www.google.fr/search?q=Djamel+Tatah&source=lnms&tbm=isch

// https://www.google.fr/search?site=imghp&tbm=isch&source=hp&biw=1920&bih=945&q=Djamel+Tatah

// http://api.duckduckgo.com/?q=Djamel+Tatah&format=json

// $google_html = file_get_contents( "google.html" );

$google_html = file_get_contents( "https://www.google.fr/search?site=imghp&tbm=isch&source=hp&biw=1920&bih=945&q=Les+champs+de+r%C3%A9sonances" );

// echo print_r( $google_html );

// => <img.+?src="(.+?)".+?\/\?\>

$pattern = '/<img.+?src="(.+?)".+?\/?\>/';
preg_match_all($pattern, $google_html, $matches, PREG_OFFSET_CAPTURE);

print_r($matches[1]);

foreach ($matches[1] as $key => $image) {

	// echo $image[0]."\n";

	$data = file_get_contents($image[0]);
	$filename  = "php-export-b64/$key.jpg";

	file_put_contents( $filename, $data );
}


// $ddg_html = file_get_contents( "https://duckduckgo.com/i.js?l=us-en&o=json&q=Djamel%20Tatah&f=" );
// echo print_r(json_decode($ddg_html )->results);

//https://duckduckgo.com/i.js?l=us-en&o=json&q=Djamel%20Tatah&f=


/*
// \(function\(\)\{var data=\[\[([\d\w\D]+)\][\n],[\d]{0,10}\]
$pattern = '/\(function\(\)\{var data=\[\[([\d\w\D\n]+)\][\n],[\d]{0,10}\]/';
preg_match($pattern, $google_html, $matches, PREG_OFFSET_CAPTURE);

if(isset($matches[1][0])){

	$imagesTab = explode("]\n,[",$matches[1][0]);

	file_put_contents("liste.txt", $matches[1][0]);




	$i = 0;

	foreach ($imagesTab as $key => $imagebase64) {
		echo "\n--------------\n";
		echo "$i =>\t$key\n";

		//$patternImage = '/[\[]*\"[\w_:-]+\","data\:image\/([\w]+);[\d\w]+,([\d\w\D]+)"[\]]*//*';*/

		/*preg_match($patternImage, $imagebase64, $matchesBase64, PREG_OFFSET_CAPTURE);

		$filename  = "php-export-b64/$key.".$matchesBase64[1][0];
		

		$data	= base64_decode( $matchesBase64[2][0] );

		print_r($key.' '.$filename.' '.substr($data, 0, 20 ) );

		// print_r("php-export-b64/$key.".$matchesBase64[1][0]);
		// print_r($matchesBase64[2][Ø]);

		file_put_contents( $filename, $data );
		

		$i++;
		// break;
	}

}*/




function downloadGoogle($requete = false, $delais = 3){

	if(!is_dir('images')){
		mkdir('images');
	}

	if($requete){

		// https://www.google.fr/search?q=Les+champs+de+r%C3%A9sonances&source=lnms&tbm=isch

	

		$requete = str_replace(' ','+',$requete);

		echo $isbn."\n";

		$url = "https://www.google.fr/search?q=$requete&source=lnms&tbm=isch";

		$result = file_get_contents($url);

		$pattern = "/src\s*=\s*(\"|')(([^\"';]*))(\"|')/";

		//echo $result;

		preg_match($pattern, $result, $matches, PREG_OFFSET_CAPTURE, 3);

		//print_r($matches[2][0]);

		try {
			$image = file_get_contents($matches[2][0]) ;

			if($image){
				file_put_contents('images/'.$isbn.".jpg", $image);

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