/*	Nicolas Roy-Bourdages - 2011
*	Web avancé phase 1 - Space shooter
*/	

function Star(x,y){
	
	this.x = x;
	this.y = y;
	
}

Star.prototype = new MetaObject(0, 0, constants.STAR_SIZE_X, constants.STAR_SIZE_Y, "rgba(255,255,255, 0.7)", 3);
Star.constructor = Star;

Star.prototype.collisionShip = function(ship){
}
Star.prototype.collisionMissile = function(){

}

Star.prototype.nextPoint = function(){
	this.movey(this.speed);
}