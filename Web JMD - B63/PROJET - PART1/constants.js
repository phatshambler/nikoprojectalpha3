function Constants(maxx, maxy){

	this.MAX_X = maxx;
	this.MAX_Y = maxy;
	this.NO_OF_SHIPS = 10;
	this.SHIP_SPEED = 12;
	
	this.SHIP_SIZE_X = 15;
	this.SHIP_SIZE_Y = 15;
	
	this.HALF_SHIP_SIZE_X = Math.floor(this.SHIP_SIZE_X / 2) + 1;
	this.HALF_SHIP_SIZE_Y = Math.floor(this.SHIP_SIZE_Y / 2) + 1;
	
	this.STARS_SIZE_X = 1;
	this.STARS_SIZE_Y = 1;
	
	this.POWERUP_SIZE_X = 10;
	this.POWERUP_SIZE_Y = 10;
	
	this.MISSILE_SIZE_X = 3;
	this.MISSILE_SIZE_Y = 4;
	
	this.ENEMYA_SIZE_X = 5;
	this.ENEMYA_SIZE_Y = 12;
	
	this.ENEMYB_SIZE_X = 7;
	this.ENEMYB_SIZE_Y = 14;
	
	this.ENEMYC_SIZE_X = 4;
	this.ENEMYC_SIZE_Y = 9;
	
	this.ENEMYMISSILE_SIZE_X = 2;
	this.ENEMYMISSILE_SIZE_Y = 3;
	
	this.ENEMYA_SPEED = 3;
	this.ENEMYB_SPEED = 5;
	this.ENEMYC_SPEED = 4;
	
	
	this.BLUE = "rgba(10,125,250,0.9)";
	this.RED = "rgba(250,125,10,0.9)";
	
	this.VALUEOFMISSILE = 10;
	this.POWERUPSPEEDVALUE = 1;
	this.POWERUPMULTIVALUE = 1;
}

Constants.prototype.testJSON = function(){
	console.log("jsontesting1-2-3");

}