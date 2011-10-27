function Ship(x, y){
	this.x = x;
	this.y = y;
	this.hiscore = 0;
	this.lastHiScore = 0;
	this.powerUp = 0;
}

Ship.prototype = new MetaObject(0, 0, "rgba(255,255,255, 0.7)", 1);
Ship.constructor = Ship;

Ship.prototype.bougeRandom=function(){
	this.x=(Math.floor(Math.random()*480))+10;
	this.y=(Math.floor(Math.random()*680))+10;
}

Ship.prototype.shoot = function(){
	controleur.modele.arrayMissilesJoueur.unshift(new Missile(this.x, this.y - 15));
}

Ship.prototype.selfCheck = function(){
	if(this.powerUp == 1){
		this.speed = 20;
	}
	else{
		this.speed = 1;
	}
}



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
