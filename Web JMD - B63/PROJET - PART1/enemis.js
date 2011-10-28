function EnemyA(x,y){
	
	this.x = x;
	this.y = y;

}

EnemyA.prototype = new MetaObject(300, 10, constants.RED, 3);
EnemyA.constructor = EnemyA;

EnemyA.prototype.shoot = function(direction, vitesse, sizex, sizey){
	controleur.modele.arrayMissilesAutres.unshift(new Missile(this.x + Math.floor(sizex / 2), this.y + Math.floor(sizey / 2), 11, constants.RED, 0));
}
EnemyA.prototype.death = function(ship){
	controleur.modele.ship.hiscore += 10;
}

function EnemyB(x,y){
	this.x = x;
	this.y = y;
}

EnemyB.prototype = new MetaObject(200, 10, constants.RED, 5);
EnemyB.constructor = EnemyB;

EnemyB.prototype.shoot = function(direction, vitesse, sizex, sizey){
	for(var i = -this.speed; i < this.speed; i++){
		controleur.modele.arrayMissilesAutres.unshift(new CustomMissile(this.x + Math.floor(sizex / 2), this.y + Math.floor(sizey / 2), 11, constants.RED, 0, i));
	}
}
EnemyB.prototype.death = function(ship){
	controleur.modele.ship.hiscore += 15;
}


function EnemyC(x,y){
	this.x = x;
	this.y = y;
}

EnemyC.prototype = new MetaObject(200, 10, "rgba(10,125,250,0.9)", 4);
EnemyC.constructor = EnemyC;

EnemyC.prototype.shoot = function(direction, vitesse, sizex, sizey){
	for(var i = -this.speed; i < this.speed; i++){
	for(var j = -this.speed; j < this.speed; j++){
		controleur.modele.arrayMissilesAutres.unshift(new CustomMissile(this.x + Math.floor(sizex / 2), this.y + Math.floor(sizey / 2), j, constants.BLUE, 1, i));
		}
	}
}
EnemyC.prototype.death = function(ship){
	controleur.modele.ship.hiscore += 5;
}