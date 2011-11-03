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
	
	this.lastFrameShot = 0;
	this.shot = false;
	this.white = 255;
	this.firstStrike = false;
	this.tempmode;
	this.tempcolor;
	//this.acceleration = 0;
}

Ship.prototype = new MetaObject(0, 0, constants.SHIP_SIZE_X, constants.SHIP_SIZE_Y, "rgba(10,125,250,0.9)", 5);
Ship.constructor = Ship;

Ship.prototype.movex = function(offset){
	if(this.x + offset > 0 + constants.SHIP_SIZE_X / 2 && this.x + offset < constants.MAX_X - constants.SHIP_SIZE_X / 2){
		this.x += offset;
	}
	else{
		this.dead = true;
	}
}

Ship.prototype.movey = function(offset){
	if(this.y + offset > 0 + constants.SHIP_SIZE_Y / 2 && this.y + offset < constants.MAX_Y - constants.SHIP_SIZE_Y / 2){
		this.y += offset;
	}
	else{
		this.dead = true;
	}
}

Ship.prototype.bougeRandom=function(){
	this.x=(Math.floor(Math.random()*480))+10;
	this.y=(Math.floor(Math.random()*680))+10;
}

Ship.prototype.shoot = function(){
if(this.beamSize == 1){
	controleur.modele.arrayMissilesJoueur.unshift(new CustomMissile(this.x - 2, this.y - 25, -this.speed - 2, this.color, this.mode, 0));
}
else{
	for (var i = -this.beamSize + 1; i < this.beamSize; i++){
	controleur.modele.arrayMissilesJoueur.unshift(new CustomMissile(this.x - 2, this.y - 25, -this.speed -2, this.color, this.mode, i));
	}
}
}

Ship.prototype.selfCheck = function(){
	if(this.firstStrike){
		this.lastFrameShot = controleur.frame;
		this.firstStrike = false;
		this.white = 30;
		
		this.tempcolor = this.color;
		this.tempmode = this.mode;
		
		if(this.tempmode == 0){
			this.color = "rgba(" + this.white + "," + this.white / 2 + "," + 0 + ",0.9)";
			
		}
		else if(this.tempmode == 1){
			this.color = "rgba(" + 0 + "," + 0 + "," + this.white + ",0.9)";
			
		}
		
		console.log("shot");
		this.mode = 666;
	}
	if(this.shot){
		this.white += 2;
		console.log(this.tempmode);
		
		if(this.tempmode == 0){
			
			this.color = "rgba(" + this.white + "," + this.white / 2 + "," + 0 + ",0.9)";
		}
		else if(this.tempmode == 1){
			this.color = "rgba(" + 0 + "," + 0 + "," + this.white + ",0.9)";
		}
	}
	if (this.white > 253 && this.shot){
		this.shot = false;
		
		if(this.tempmode == 0){
			this.color = constants.RED;
		}
		else{
			this.color = constants.BLUE;
		}
		
		this.mode = this.tempmode;
		
	}
}


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