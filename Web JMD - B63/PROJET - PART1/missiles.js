function Missile(x,y){
	
	this.x = x;
	this.y = y;
	
}

Missile.prototype = new MetaObject(0, 0, "rgba(180,124, 20, 0.8)", 2);
Missile.constructor = Missile;