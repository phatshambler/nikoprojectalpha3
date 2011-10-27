function Missile(x,y){
	
	this.x = x;
	this.y = y;
	
}

Missile.prototype = new MetaObject(0, 0, "rgba(180,124, 20, 0.8)", 2);
Missile.constructor = Missile;

function Star(x,y){
	
	this.x = x;
	this.y = y;
	
}

Star.prototype = new MetaObject(0, 0, "rgba(255,255,255, 0.7)", 2);
Star.constructor = Star;

Star.prototype.collisionShip = function(ship){

}

function PowerUp(x,y){
	
	this.x = x;
	this.y = y;
	
}

PowerUp.prototype = new MetaObject(0, 0, "rgba(255,0,0, 0.7)", 2);
PowerUp.constructor = PowerUp;

PowerUp.prototype.collisionShip = function(ship){
	
	if (this.x > ship.x -20 && this.x < ship.x + 20 && this.y > ship.y - 20 && this.y < ship.y + 20){
		ship.powerUp = 1;
	}
}