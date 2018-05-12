#includepath "~/Documents/;%USERPROFILE%Documents";
#include "basiljs/bundle/basil.js";

function setup() {


	var doc = b.doc();


	b.clear( b.layer( 'calque E' ) );

	var tailleMin = 30;
	var tailleMax = 200;
	var taille = tailleMin;
	var allTextFrames = doc.textFrames;

	var compte = 0;
	var nbrE = 0;


	for(var i = 1; i <= b.pageCount(); i++){

		items = b.items( b.page( i ) );

		// ON BOUCLE SUR TOUS LES ITEMS DE LA PAGE
		for(var item = 0; item < items.length ; item++){

			if( items[ item ].name == "conteneur" ){

				b.characters( b.nameOnPage("conteneur"), function(ch, ci) {

					if(ch.contents == "e" || ch.contents == "E"){
						nbrE ++ ;
					}

				});
			}
		}
	}


	b.println("nbrE => "+ nbrE);


	var pasTypo = (tailleMax - tailleMin)/nbrE;

	
	
	b.layer( 'calque E' );


	for(var i = 1; i <= b.pageCount(); i++){

		items = b.items( b.page( i ) );

		// ON BOUCLE SUR TOUS LES ITEMS DE LA PAGE
		for(var item = 0; item < items.length ; item++){

			if( items[ item ].name == "conteneur" ){

				var ei = 0;

				b.characters( b.nameOnPage("conteneur"), function(ch, ci) {

					if(ch.contents == "e" || ch.contents == "E"){
					
						// on attribue la couleur papier aux lettres trouvées
						ch.fillColor = "Paper";

						// b.typo(ch,'pointSize',taille);

						var xPosCorrection = 25.72/117 * (ei);

						// b.println(xPosCorrection +" "+ei);

						var chPos 	= b.bounds(ch);
						var myFrame = b.text(ch.contents, chPos.left - xPosCorrection, chPos.bottom - 300 - 8.3 + xPosCorrection, 300, 300);
						myFrame.textFramePreferences.verticalJustification = VerticalJustification.BOTTOM_ALIGN ;

						b.typo(myFrame,'pointSize',taille);	

						taille += pasTypo;
						ei++;

					}
				});
			}
		}
	}
}

b.go();


