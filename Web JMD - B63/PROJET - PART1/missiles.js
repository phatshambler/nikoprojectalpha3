function Missile(x,y,speed,color,mode){
	
	this.x = x;
	this.y = y;
	this.speed = speed;
	this.color = color;
	this.mode = mode;
}

Missile.prototype = new MetaObject(0, 0, "rgba(180,124, 200, 0.8)", 0);
Missile.constructor = Missile;

Missile.prototype.nextPoint = function(){
	this.movey(this.speed);
}

Missile.prototype.collisionMissile = function(){

}

function CustomMissile(x,y,speed,color,mode, direction){
	
	this.x = x;
	this.y = y;
	this.speed = speed;
	this.color = color;
	this.mode = mode;
	this.direction = direction;
}
CustomMissile.prototype = new Missile(0, 0, 0, "rgba(180,124, 200, 0.8)", 0);
CustomMissile.constructor = CustomMissile;

CustomMissile.prototype.nextPoint = function(){
	this.movey(this.speed);
	this.movex(this.direction);
}

function Star(x,y){
	
	this.x = x;
	this.y = y;
	
}

Star.prototype = new MetaObject(0, 0, "rgba(255,255,255, 0.7)", 2);
Star.constructor = Star;

Star.prototype.collisionShip = function(ship){
}
Star.prototype.collisionMissile = function(){

}

Star.prototype.nextPoint = function(){
	this.movey(this.speed);
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
PowerUp.prototype.nextPoint = function(){
	this.movey(this.speed);
}