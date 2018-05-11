#includepath "~/Documents/;%USERPROFILE%Documents";
#include "basiljs/bundle/basil.js";

function setup() {


	var doc = b.doc();

	var taille = 20;
	var allTextFrames = doc.textFrames;

	var compte = 0;

	b.layer('calque E');

	// for(var i=0;i<allTextFrames.length;i++){
	for(var i=0;i<1;i++){
		var tf = allTextFrames[i];

		b.characters(tf, function(ch, ci) {

			if(ch.contents == "e" || ch.contents == "E"){
				b.println('Character ' + ci + " "+ch.contents);

				// b.typo(ch,'pointSize',taille);
				
				b.fill('Paper');

				var myFrame = b.text(ch.contents, 0, 0, 350, 50);

				taille += 0.2;

				if(taille >= 50){
					taille = 30;
				}

				taille = Math.round(taille * 1000)/1000;

				b.println("->"+taille);

				compte ++;

				if(compte > 300){
					return false;
				}
			}
		});
	}
}

b.go();