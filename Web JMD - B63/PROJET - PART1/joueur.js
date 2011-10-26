function Ship(){
	this.x=(Math.floor(500 / 2));
	this.y=(Math.floor(700 / 5) * 4);
}

Ship.prototype.bougeRandom=function(){
	this.x=(Math.floor(Math.random()*480))+10;
	this.y=(Math.floor(Math.random()*680))+10;
}
Ship.prototype.movex = function(offset){
	if(this.x + offset > 0 || this.x + offset < constants.MAX_X - 20){
		this.x += offset;
	}
}
Ship.prototype.movey = function(offset){
	if(this.y + offset > 0 || this.y + offset < constants.MAX_Y - 20){
		this.y += offset;
	}
}
Ship.prototype.shoot = function(){
	controleur.modele.arrayMissilesJoueur.unshift(new Missile(this.x, this.y));
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
