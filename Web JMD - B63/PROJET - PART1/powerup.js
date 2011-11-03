function PowerUp(x,y){
	this.x = x;
	this.y = y;
}

PowerUp.prototype = new MetaObject(0, 0, constants.POWERUP_SIZE_X, constants.POWERUP_SIZE_Y, "rgba(255,0,125, 0.8)", 2);
PowerUp.constructor = PowerUp;

PowerUp.prototype.collisionShip = function(ship){
	
	this.arrayCorners.length = 0;
	this.arrayCorners.unshift(this.x, this.y, this.x + this.lenx, this.y, this.x + this.lenx, this.y + this.leny, this.x, this.y + this.leny);
	
	for(var i = 0; i < this.arrayCorners.length; i+= 2){
		if (this.arrayCorners[i] > ship.x -constants.SHIP_SIZE_X && this.arrayCorners[i] < ship.x + constants.SHIP_SIZE_X && this.arrayCorners[i + 1] > ship.y - constants.SHIP_SIZE_Y && this.arrayCorners[i + 1] < ship.y + constants.SHIP_SIZE_Y){
			if(!ship.shot && !this.dead){
			ship.speed += constants.POWERUPSPEEDVALUE;
			this.dead = true;
		}
		}
	}
}
PowerUp.prototype.nextPoint = function(){
	this.movey(this.speed);
}

function PowerUpMulti(x,y){
	this.x = x;
	this.y = y;
}

PowerUpMulti.prototype = new MetaObject(0, 0, constants.POWERUP_SIZE_X, constants.POWERUP_SIZE_Y, "rgba(125,250,125, 0.8)", 2);
PowerUpMulti.constructor = PowerUpMulti;

PowerUpMulti.prototype.collisionShip = function(ship){
	
		this.arrayCorners.length = 0;
	this.arrayCorners.unshift(this.x, this.y, this.x + this.lenx, this.y, this.x + this.lenx, this.y + this.leny, this.x, this.y + this.leny);
	
	for(var i = 0; i < this.arrayCorners.length; i+= 2){
		if (this.arrayCorners[i] > ship.x -constants.SHIP_SIZE_X && this.arrayCorners[i] < ship.x + constants.SHIP_SIZE_X && this.arrayCorners[i + 1] > ship.y - constants.SHIP_SIZE_Y && this.arrayCorners[i + 1] < ship.y + constants.SHIP_SIZE_Y){
			if(!ship.shot && !this.dead){
				ship.multi += constants.POWERUPMULTIVALUE;
				this.dead = true;
			}
		}
	}
}
PowerUpMulti.prototype.nextPoint = function(){
	this.movey(this.speed);
}

function PowerUpVies(x,y){
	this.x = x;
	this.y = y;
}

PowerUpVies.prototype = new MetaObject(0, 0, constants.POWERUP_SIZE_X, constants.POWERUP_SIZE_Y, "rgba(255,255,255, 0.7)", 2);
PowerUpVies.constructor = PowerUpVies;

PowerUpVies.prototype.collisionShip = function(ship){
	
		this.arrayCorners.length = 0;
	this.arrayCorners.unshift(this.x, this.y, this.x + this.lenx, this.y, this.x + this.lenx, this.y + this.leny, this.x, this.y + this.leny);
	
	for(var i = 0; i < this.arrayCorners.length; i+= 2){
		if (this.arrayCorners[i] > ship.x -constants.SHIP_SIZE_X && this.arrayCorners[i] < ship.x + constants.SHIP_SIZE_X && this.arrayCorners[i + 1] > ship.y - constants.SHIP_SIZE_Y && this.arrayCorners[i + 1] < ship.y + constants.SHIP_SIZE_Y){
			if(!ship.shot && !this.dead){
				ship.lives += 1;
				this.dead = true;
			}
		}
	}
}
PowerUpVies.prototype.nextPoint = function(){
	this.movey(this.speed);
}