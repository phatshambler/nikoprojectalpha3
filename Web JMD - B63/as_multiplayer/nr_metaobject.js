/*	Nicolas Roy-Bourdages - 2011
*	Web avancé phase 1 - Space shooter
*/	

function MetaObject(x,y, lenx, leny, color, speed){
	this.x = x;
	this.y = y;
	this.lenx = lenx;
	this.leny = leny;
	this.color = color;
	this.speed = speed;
	
	this.acceleration = 1;
	this.nbFrames = 0;
	this.dead = false;
	
	this.arrayCorners = new Array();
	
	this.arrayCorners.unshift(this.x, this.y, this.x + this.lenx, this.y, this.x + this.lenx, this.y + this.leny, this.x, this.y + this.leny);
}

MetaObject.prototype.movex = function(offset){
	if(this.x + offset > 0 && this.x + offset < constants.MAX_X){
		this.x += offset;
	}
	else{
		this.dead = true;
	}
}

MetaObject.prototype.movey = function(offset){
	if(this.y + offset > 0 && this.y + offset < constants.MAX_Y){
		this.y += offset;
	}
	else{
		this.dead = true;
	}
}

MetaObject.prototype.collisionShip = function(ship){
	//console.log(this.arrayCorners[0] + " " + this.arrayCorners[1]);
	this.arrayCorners.length = 0;
	this.arrayCorners.unshift(this.x, this.y, this.x + this.lenx, this.y, this.x + this.lenx, this.y + this.leny, this.x, this.y + this.leny);
	
	for(var i = 0; i < this.arrayCorners.length; i+= 2){
		if (this.arrayCorners[i] > ship.x -constants.SHIP_SIZE_X && this.arrayCorners[i] < ship.x + constants.SHIP_SIZE_X && this.arrayCorners[i + 1] > ship.y - constants.SHIP_SIZE_Y && this.arrayCorners[i + 1] < ship.y + constants.SHIP_SIZE_Y){
			if(this.mode == ship.mode){
				//var lala = 5 * ship.multi * 10;
				
				
				this.dead = true;
				//console.log("deadMissile");
				//console.log(lala);
				ship.multi += 0.01;
				ship.hiscore += 5 * ship.multi;
				break;
			}
			else{
				if(ship.lives > 0 && !ship.shot){
					ship.lives -= 1;
					ship.multi = ship.baseMulti;
					ship.speed = ship.baseSpeed;
					ship.beamSize = ship.baseBeam;
					this.dead = true;
					ship.shot = true;
					ship.firstStrike = true;
				}
				else if(ship.lives < 1){
					controleur.paused = true;
					controleur.endgame = true;
				}
				break;
			}
		}
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
				controleur.modele.ship.hiscore += 10 * controleur.modele.ship.multi;
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

MetaObject.prototype.death = function(ship){

}
