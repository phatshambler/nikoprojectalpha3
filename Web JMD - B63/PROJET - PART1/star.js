function Star(x,y){
	
	this.x = x;
	this.y = y;
	
}

Star.prototype = new MetaObject(0, 0, constants.STAR_SIZE_X, constants.STAR_SIZE_Y, "rgba(255,255,255, 0.7)", 2);
Star.constructor = Star;

Star.prototype.collisionShip = function(ship){
}
Star.prototype.collisionMissile = function(){

}

Star.prototype.nextPoint = function(){
	this.movey(this.speed);
}