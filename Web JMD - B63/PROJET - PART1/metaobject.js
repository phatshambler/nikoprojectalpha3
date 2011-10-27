function MetaObject(x,y,color,speed){
	this.x = x;
	this.y = y;
	this.color = color;
	this.speed = speed;
	this.acceleration = 1;
	this.nbFrames = 0;
	this.dead = false;
}

MetaObject.prototype.movex = function(offset){
	if(this.x + offset > 0 || this.x + offset < Constants.MAX_X){
		this.x += offset;
	}
}

MetaObject.prototype.movey = function(offset){
	if(this.y + offset > 0 || this.y + offset < Constants.MAX_Y){
		this.y += offset;
	}
	else{
		this.dead = true;
	}
	//console.log("fuck :" + this.x + " " + this.y);
}

MetaObject.prototype.collisionShip = function(ship){
	if (this.x > ship.x -20 && this.x < ship.x + 20 && this.y > ship.y - 20 && this.y < ship.y + 20){
		controleur.paused = true;
		controleur.endgame = true;
	}
	//console.log(this.x + " " + this.y);
}

MetaObject.prototype.collisionMissile = function(liste, sizex, sizey){
	for (var i = 0; i < liste.length; i++){
		if(liste[i] != null){
			var xx = liste[i].x;
			var yy = liste[i].y;
			if (this.x >= xx - Math.floor(sizex / 2) && this.x <= xx + Math.floor(sizex / 2) && this.y >= yy - Math.floor(sizey / 2)  && this.y <= yy + Math.floor(sizey / 2)){
				this.dead = true;
			}
		}
	}
	//console.log(this.x + " " + this.y);
}

MetaObject.prototype.shoot = function(direction, vitesse, sizex, sizey){
	controleur.modele.arrayMissilesAutres.unshift(new Missile(this.x + Math.floor(sizex / 2), this.y + Math.floor(sizey / 2), 11, "rgba(0,180, 180, 0.8)"));
}

MetaObject.prototype.nextPoint = function(){
	this.movey(this.speed);
	this.nbFrames += 1;
	if(this.nbFrames % 50 == 0){
		this.shoot(1,5,10,10);
	}
}
