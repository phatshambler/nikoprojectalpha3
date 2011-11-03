/*	Nicolas Roy-Bourdages - 2011
*	Web avancé phase 1 - Space shooter
*/	

function Missile(x,y,speed,color,mode){
	
	this.x = x;
	this.y = y;
	this.speed = speed;
	this.color = color;
	this.mode = mode;
}

Missile.prototype = new MetaObject(0, 0, constants.MISSILE_SIZE_X, constants.MISSILE_SIZE_Y, "rgba(180,124, 200, 0.8)", 0);
Missile.constructor = Missile;

Missile.prototype.nextPoint = function(){
	this.movey(this.speed);
}

Missile.prototype.collisionMissile = function(){}

function CustomMissile(x,y,speed,color,mode, direction){
	
	this.x = x;
	this.y = y;
	this.speed = speed;
	this.color = color;
	this.mode = mode;
	this.direction = direction;
}
CustomMissile.prototype = new MetaObject(0, 0, constants.MISSILE_SIZE_X, constants.MISSILE_SIZE_Y, "rgba(180,124, 200, 0.8)", 0);
CustomMissile.constructor = CustomMissile;

CustomMissile.prototype.nextPoint = function(){
	this.movey(this.speed);
	this.movex(this.direction);
}

CustomMissile.prototype.collisionMissile = function(){}


