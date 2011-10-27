function MetaObject(x,y,color,speed){
	this.x = x;
	this.y = y;
	this.color = color;
	this.speed = speed;
	this.acceleration = 0;
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

MetaObject.prototype.nextPoint = function(){
	this.movey(this.speed);
}
