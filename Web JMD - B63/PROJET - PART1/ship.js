function Ship(x, y){
	this.x = x;
	this.y = y;
	this.hiscore = 0;
	this.lastHiScore = 0;
	this.powerUpSpeed = 0;
	this.multi = 1.0;
	this.mode = 1;
	this.lives = 3;
	this.beamSize = 1;
	
	this.speed = 1;
	
	this.baseSpeed = 0;
	this.baseMulti = 0;
	this.baseBeam = 0;
	//this.acceleration = 0;
}

Ship.prototype = new MetaObject(0, 0, constants.SHIP_SIZE_X, constants.SHIP_SIZE_Y, "rgba(10,125,250,0.9)", 5);
Ship.constructor = Ship;

Ship.prototype.bougeRandom=function(){
	this.x=(Math.floor(Math.random()*480))+10;
	this.y=(Math.floor(Math.random()*680))+10;
}

Ship.prototype.shoot = function(){
if(this.beamSize == 1){
	controleur.modele.arrayMissilesJoueur.unshift(new CustomMissile(this.x - 2, this.y - 25, -5, "rgba(255,180,0, 0.9)", 0, 0));
}
else{
	for (var i = -this.beamSize + 1; i < this.beamSize; i++){
	controleur.modele.arrayMissilesJoueur.unshift(new CustomMissile(this.x - 2, this.y - 25, -5, "rgba(255,180,0, 0.9)", 0, i));
	}
}
}
/*
Ship.prototype.selfCheck = function(){
	if(this.powerUp == 1){
		this.speed = 10;
	}
	else{
		this.speed = 5;
	}
}
*/

/*
function Joueur(vies, score){
	this.vies = vies;
	this.score = score;
	this.powerupSpeed = false;
	this.powerupKool = false;
}

Joueur.prototype = new MetaObject(Constants.MAX_X / 2, Math.floor(Constants.MAX_Y / 5) * 4, "rgba(180,124, 20, 0.8)", 5);
Joueur.constructor = Joueur;

Joueur.prototype.collision = function(){
	//no kollision for playa?
}
*/