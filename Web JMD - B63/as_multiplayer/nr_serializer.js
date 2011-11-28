/*	Nicolas Roy-Bourdages - 2011
*	Web avancé phase 1 - Space shooter
*/	

function SaveAndLoadFunctions(){

}

SaveAndLoadFunctions.prototype.saveState = function(){
	controleur.display = false;
	var blue = JSON.decycle(controleur);
	var green = JSON.stringify(blue);
	//console.log (green);
	//effaceCookie("state" + controleur.saveSlot);
	creeCookie("state" + controleur.saveSlot, green);
	//constants.testJSON();
	controleur.display = true;
}

SaveAndLoadFunctions.prototype.loadState = function(){
	controleur.display = false;
	
	var red = lisCookie("state" + controleur.saveSlot);
	var raw = JSON.retrocycle(JSON.parse(red));
	
	raw.__proto__ = controleur.__proto__;
	raw.vue.__proto__ = controleur.vue.__proto__;
	raw.modele.__proto__ = controleur.modele.__proto__;
	raw.date.__proto__ = controleur.date.__proto__;
	
	raw.modele.ship.__proto__ = controleur.modele.ship.__proto__;
	
	console.log("hello");
	
	var powerUpM = new PowerUpMulti(0,0);
	var powerUp = new PowerUp(0,0);
	
	for (var i = 0; i < raw.modele.arrayMissilesJoueur.length; i++){
		raw.modele.arrayMissilesJoueur[i].__proto__ = controleur.modele.arrayMissilesJoueur[0].__proto__;
		
		//raw.modele.arrayMissilesJoueur[i].constructor = Missile;
		
	}
	
	for (var i = 0; i < raw.modele.arrayMissilesAutres.length; i++){
		raw.modele.arrayMissilesAutres[i].__proto__ = controleur.modele.arrayMissilesAutres[0].__proto__;
		//raw.modele.arrayMissilesAutres[i].constructor = CustomMissile;
	}
	
	for (var i = 0; i < raw.modele.arrayEnemyA.length; i++){
		raw.modele.arrayEnemyA[i].__proto__ = controleur.modele.arrayEnemyA[0].__proto__;
		//raw.modele.arrayEnemyA[i].constructor = EnemyA;
	}
	
	for (var i = 0; i < raw.modele.arrayEnemyB.length; i++){
		raw.modele.arrayEnemyB[i].__proto__ = controleur.modele.arrayEnemyB[0].__proto__;
		//raw.modele.arrayEnemyB[i].constructor = EnemyB;
	}
	
	for (var i = 0; i < raw.modele.arrayEnemyC.length; i++){
		raw.modele.arrayEnemyC[i].__proto__ = controleur.modele.arrayEnemyC[0].__proto__;
		//raw.modele.arrayEnemyC[i].constructor = EnemyC;
	}
	for (var i = 0; i < raw.modele.arrayStars.length; i++){
		raw.modele.arrayStars[i].__proto__ = controleur.modele.arrayStars[0].__proto__;
		//raw.modele.arrayStars[i].constructor = Star;
	}
	for (var i = 0; i < raw.modele.arrayPowerUp.length; i++){
		raw.modele.arrayPowerUp[i].__proto__ = powerUp.__proto__;
		//raw.modele.arrayStars[i].constructor = Star;
	}
	for (var i = 0; i < raw.modele.arrayPowerUpM.length; i++){
		raw.modele.arrayPowerUpM[i].__proto__ = powerUpM.__proto__;
		//raw.modele.arrayStars[i].constructor = Star;
	}
	
	//arrayPowerUp
	
	
	//arrayEnemyA
	
	controleur = raw;
	serial = new SaveAndLoadFunctions();
	controleur.display = true;
	//masterloop();
}

