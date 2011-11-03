function EnemyA(x,y, missilemode){
	
	this.x = x;
	this.y = y;
	this.missilemode = missilemode;
}

EnemyA.prototype = new MetaObject(300, 10, constants.ENEMYA_SIZE_X, constants.ENEMYA_SIZE_Y, constants.RED, constants.ENEMYA_SPEED);
EnemyA.constructor = EnemyA;

EnemyA.prototype.shoot = function(direction, vitesse, sizex, sizey){
	controleur.modele.arrayMissilesAutres.unshift(new Missile(this.x + Math.floor(sizex / 2), this.y + Math.floor(sizey / 2), this.speed + 1, this.color, this.missilemode));
}
EnemyA.prototype.death = function(ship){
	controleur.modele.ship.hiscore += (10.0 * controleur.modele.ship.multi);
}

function EnemyB(x,y,missilemode){
	this.x = x;
	this.y = y;
	this.missilemode = missilemode;
}

EnemyB.prototype = new MetaObject(200, 10, constants.ENEMYB_SIZE_X, constants.ENEMYB_SIZE_Y, constants.RED, constants.ENEMYB_SPEED);
EnemyB.constructor = EnemyB;

EnemyB.prototype.shoot = function(direction, vitesse, sizex, sizey){
	for(var i = -this.speed; i < this.speed; i++){
		if(i != 0){
		controleur.modele.arrayMissilesAutres.unshift(new CustomMissile(this.x + Math.floor(sizex / 2), this.y + Math.floor(sizey / 2), this.speed + 2, this.color, this.missilemode, i));
		}
	}
}
EnemyB.prototype.death = function(ship){
	controleur.modele.ship.hiscore += (10.0 * controleur.modele.ship.multi);
}


function EnemyC(x,y, missilemode){
	this.x = x;
	this.y = y;
	this.missilemode = missilemode;
	this.direction = true;
}

EnemyC.prototype = new MetaObject(100, 10, constants.ENEMYC_SIZE_X, constants.ENEMYC_SIZE_Y, "rgba(10,125,250,0.9)", constants.ENEMYC_SPEED);
EnemyC.constructor = EnemyC;

EnemyC.prototype.shoot = function(direction, vitesse, sizex, sizey){
	for(var i = -this.speed; i < this.speed; i+=2){
	for(var j = -this.speed; j < this.speed; j+=2){
		if(i != 0 && j != 0){
		controleur.modele.arrayMissilesAutres.unshift(new CustomMissile(this.x + Math.floor(sizex / 2), this.y + Math.floor(sizey / 2), j, this.color, this.missilemode, i));
		}
	}
	}
}
EnemyC.prototype.death = function(ship){
	controleur.modele.ship.hiscore += (10.0 * controleur.modele.ship.multi);
}

EnemyC.prototype.nextPoint = function(){
	this.movey(this.speed);
	
	if(this.direction){
		this.movex(2);
	}
	else{
		this.movex(-2)
	}
	
	this.nbFrames += 1;
	if(this.nbFrames % 50 == 0){
		this.shoot(1,5,10,10);
		this.direction = !this.direction;
	}
}

function EnemyD(x,y, missilemode){
	this.x = x;
	this.y = y;
	this.missilemode = missilemode;
	this.direction = true;
}

EnemyD.prototype = new MetaObject(100, 10, constants.ENEMYC_SIZE_X, constants.ENEMYC_SIZE_Y, "rgba(10,125,250,0.9)", constants.ENEMYC_SPEED + 2);
EnemyD.constructor = EnemyD;

EnemyD.prototype.shoot = function(direction, vitesse, sizex, sizey){
	for(var i = -this.speed; i < this.speed; i+=2){
	for(var j = -this.speed; j < this.speed; j+=2){
		if(i != 0 && j != 0){
		controleur.modele.arrayMissilesAutres.unshift(new CustomMissile(this.x + Math.floor(sizex / 2), this.y + Math.floor(sizey / 2), j, this.color, this.missilemode, direction));
		}
	}
	}
}
EnemyD.prototype.death = function(ship){
	controleur.modele.ship.hiscore += (15.0 * controleur.modele.ship.multi);
}

EnemyD.prototype.nextPoint = function(){
	this.movey(this.speed);
	
	if(this.direction){
		this.movex(2);
	}
	else{
		this.movex(-2)
	}
	
	this.nbFrames += 1;
	if(this.nbFrames % 50 == 0){
		if(this.direction){
		this.shoot(5,5,10,10);
		}
		else{
		this.shoot(-5,5,10,10);
		}
		this.direction = !this.direction;
	}
}