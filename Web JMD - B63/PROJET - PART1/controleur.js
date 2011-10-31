controleur="";
constants ="";
constants= new Constants(0, 0);
serial = new SaveAndLoadFunctions();

window.onload = function(){
	loadGame();
}

window.onresize = function(){
	setSize();
}

function loadGame(){
	console.log("hello");
	
	if (controleur==""){
		
		constants = new Constants();
		
		setSize();
		
		var ship = new Ship(Math.floor(constants.MAX_X / 2), constants.MAX_Y - 100);
		
		setCookies(ship);
		
		var v = new Vue();
		var m = new Modele(ship);
		var d = new Date();
		controleur= new Controleur(v,m,d);
		
		/*plug mes écouteurs*/
		document.onkeydown = controleur.keydown;
		document.onkeyup = controleur.keyup;
		//document.onkeypress = controleur.keypressed;
		
		document.onmousedown = controleur.mousedown;
		document.onmouseup = controleur.mouseup;
		
		controleur.vue.afficheMenu(ship.lastHiScore);
		console.log("Voici votre nouveau Controleur "+controleur);
	}else{
		console.log("...!");
	}
}

function setSize(){

	var winW = 600, winH = 400;
	if (document.body && document.body.offsetWidth) {
	 winW = document.body.offsetWidth;
	 winH = document.body.offsetHeight;
	}
	if (document.compatMode=='CSS1Compat' &&
		document.documentElement &&
		document.documentElement.offsetWidth ) {
	 winW = document.documentElement.offsetWidth;
	 winH = document.documentElement.offsetHeight;
	}
	if (window.innerWidth && window.innerHeight) {
	 winW = window.innerWidth;
	 winH = window.innerHeight;
	}
	
	var canvas = document.getElementById("canvas");
		canvas.height = (winH - 5);
		canvas.width = (winW - 5);
		constants.MAX_X = winW - 5;
		constants.MAX_Y = winH - 5;
	
}

function setCookies(ship){
	var op = new Options();
	op.lisMultipleCookies();
	ship.speed = parseInt(op.masterkookie["Vitesse"]);
	ship.multi = parseFloat(op.masterkookie["Multiplicateur"]);
	ship.lives = parseInt(op.masterkookie["Vies"]);
	ship.beamSize = parseInt(op.masterkookie["Balles"]);
	
	ship.baseSpeed = ship.speed;
	ship.baseMulti = ship.multi;
	ship.baseBeam = ship.beamSize;
}

function Controleur(vue,modele,date){
	this.vue=vue;
	this.modele=modele;
	
	//this.vue.afficheShip(this.modele.ship.x,this.modele.ship.y, this.modele.arrayMissilesJoueur);
	this.leftKey = false;
	this.rightKey = false;
	this.downKey = false;
	this.upKey = false;
	this.shootKey = false;
	this.shiftKey = false;
	this.lockShiftKey = false;
	
	this.pauseKey = false;
	this.lockPauseKey = false;
	this.saveKey = false;
	this.lockSaveKey = false;
	this.loadKey = false;
	this.lockLoadKey = false;
	
	this.mouseLeft = false;
	this.mouseRight = false;
	this.lockMouseRight = false;
	
	//this.vue.afficheMetaObject(this.modele.arrayEnemyA, 3);
	//this.lock = false;
	this.frame = 0;
	this.date = date;
	this.startTime = this.date.getTime();
	
	this.phase = 0;
	this.paused = true;
	this.display = true;
	this.endgame = false;
	
	this.saveSlot = 0;
	this.frequencyP = 1.0;
	this.frequencyE = 1.0;
	
	this.vue.afficheMenu();
	
	this.mainloop = masterloop;
}


function masterloop(){
		
		controleur.deplacement();
		controleur.deplacementSouris();
		
		if(controleur.display){
			controleur.newItems();
			
			//controleur.modele.ship.selfCheck();
			
			controleur.vue.afficheShip(controleur.modele.ship.x, controleur.modele.ship.y, controleur.modele.arrayMissilesJoueur);
			controleur.vue.afficheMetaObject(controleur.modele.arrayEnemyA, constants.ENEMYA_SIZE_X,constants.ENEMYA_SIZE_Y );
			controleur.vue.afficheMetaObject(controleur.modele.arrayEnemyB, constants.ENEMYB_SIZE_X,constants.ENEMYB_SIZE_Y );
			controleur.vue.afficheMetaObject(controleur.modele.arrayEnemyC, constants.ENEMYC_SIZE_X,constants.ENEMYC_SIZE_Y );
			
			controleur.vue.afficheMetaObject(controleur.modele.arrayMissilesJoueur, constants.MISSILE_SIZE_X,constants.MISSILE_SIZE_Y );
			controleur.vue.afficheMetaObject(controleur.modele.arrayMissilesAutres, constants.ENEMYMISSILE_SIZE_X,constants.ENEMYMISSILE_SIZE_Y );
			
			controleur.vue.affichePower(controleur.modele.arrayPowerUp, constants.POWERUP_SIZE_X, constants.POWERUP_SIZE_Y );
			controleur.vue.affichePower(controleur.modele.arrayPowerUpM, constants.POWERUP_SIZE_X, constants.POWERUP_SIZE_Y );
			
			controleur.vue.afficheMetaObject(controleur.modele.arrayStars, constants.STARS_SIZE_X,constants.STARS_SIZE_Y );
			//controleur.vue.afficheHigh();
			controleur.frame++;
		}
		
		if(!controleur.paused){
			setTimeout(masterloop, 30);
		}
		else if(controleur.endgame){
		if(controleur.modele.ship.hiscore >= controleur.modele.ship.lastHiScore){
				effaceCookie("hiscore");
				creeCookie("hiscore", controleur.modele.ship.hiscore, 20);
			}
			
			controleur = "";
			loadGame();
			constants.ENEMYA_SPEED = 2;
			constants.ENEMYB_SPEED = 4;
			constants.ENEMYC_SPEED = 3;

			//constants = new Constants();
			
		}
}
Controleur.prototype.newItems = function(){

		controleur.modele.arrayStars.unshift(new Star(Math.floor(Math.random()*constants.MAX_X), 0));
		if(controleur.frame % Math.floor(150 / this.frequencyP) == 0){
			controleur.modele.arrayPowerUp.unshift(new PowerUp(Math.floor(Math.random()*constants.MAX_X), 0));
		}
		
		if(controleur.frame % Math.floor(250 / this.frequencyP) == 0){
			controleur.modele.arrayPowerUpM.unshift(new PowerUpMulti(Math.floor(Math.random()*constants.MAX_X), 0));
		}
		
		if (controleur.frame % Math.floor(70 / this.frequencyE) == 0){
			tempX = Math.floor(Math.random(controleur.frame)*constants.MAX_X);
			tempY = 0;
			compteur = 0;
		}
		
		if (compteur < 5){
			controleur.modele.arrayEnemyC.unshift(new EnemyC(tempX, tempY, 1));
			tempY += constants.ENEMYC_SIZE_Y * 2;
			compteur += 1;
		}
		
		if (controleur.frame % Math.floor(20 / this.frequencyE) == 0){
			controleur.modele.arrayEnemyA.unshift(new EnemyA(Math.floor(Math.random()*constants.MAX_X), 0, 0));
			//controleur.modele.arrayEnemyA.unshift(new EnemyA());
		}
		
		if(controleur.frame % Math.floor(35 / this.frequencyE) == 0){
			controleur.modele.arrayEnemyB.unshift(new EnemyB(Math.floor(Math.random()*constants.MAX_X), 0, 0));
		}
		
		if(controleur.frame % 1000 == 0){
			controleur.phasedeux();
			controleur.phase += 1;
		}
		
}


Controleur.prototype.deplacement = function(){
		
		var speed = controleur.modele.ship.speed;
		//var accel = controleur.modele.ship.acceleration;
		//speed = speed + accel;
		//console.log(this.leftKey + " " + this.rightKey + " " + this.upKey + " " + this.downKey);
		
		if (this.leftKey) {
			//console.log("left");
			controleur.modele.ship.movex(-speed);
		}
		else if (this.rightKey) {
			//console.log(speed);
			controleur.modele.ship.movex(speed);
		}
		
		if (this.upKey) {
			//console.log("up");
			controleur.modele.ship.movey(-speed);
		}
		else if (this.downKey) {
			//console.log("down");
			controleur.modele.ship.movey(speed);
		}
		
		if (this.shootKey) {
			//console.log("space");
			controleur.modele.ship.shoot();
			//console.log(controleur.modele.arrayMissilesJoueur.length);
			// ball.jump(); - à lier avec la balle, selon votre nom de variable/fonction
		}
		if (this.shiftKey && !this.lockShiftKey) {
			//console.log("space");
			if(controleur.modele.ship.mode == 0){
				controleur.modele.ship.mode = 1;
				controleur.modele.ship.color = constants.BLUE;
			}
			else if(controleur.modele.ship.mode == 1){
				controleur.modele.ship.mode = 0;
				controleur.modele.ship.color = constants.RED;
			}
			
			controleur.lockShiftKey = true;
			//console.log(controleur.modele.arrayMissilesJoueur.length);
			// ball.jump(); - à lier avec la balle, selon votre nom de variable/fonction
		}
		
		if (this.pauseKey && !this.lockPauseKey) {
			
			controleur.display = !controleur.display;
			
			controleur.lockPauseKey = true;
		}
		else if (this.saveKey && !this.lockSaveKey) {
			serial.saveState();
			controleur.lockSaveKey = true;
		}
		else if (this.loadKey && !this.lockLoadKey) {
			serial.loadState();
			controleur.lockLoadKey = true;
		}
}
Controleur.prototype.keypressed = function(e) {
	/*
	if (controleur.modele.ship.acceleration < 10){
		controleur.modele.ship.acceleration += 1;
		console.log(controleur.modele.ship.acceleration);
	}
	*/
}
Controleur.prototype.keydown = function(e) {
	var unicode = "";
	
	if (navigator.appName == "Microsoft Internet Explorer") {
			unicode = event.keyCode; // not a typo.
	}
	else{
		unicode = e.which;
	}
	console.log(unicode);
		if (unicode == 65 || unicode == 97 || unicode == 37) {
			
			controleur.leftKey = true;
		}
		else if (unicode == 68  || unicode == 100 || unicode == 39) {
			
			controleur.rightKey = true;
		}
		
		if (unicode == 87 || unicode == 38) {
			
			controleur.upKey = true;
		}
		else if (unicode == 83 || unicode == 40) {
			
			controleur.downKey = true;
		}
		
		if (unicode == 32) {
			
			controleur.shootKey = true;
		}
		if (unicode == 16) {
			
			controleur.shiftKey = true;
		}
		if (unicode == 74) {
			
			
			controleur.pauseKey = true;
			
		}
		if (unicode == 75) {
			
			controleur.saveKey = true;
			
		}
		if (unicode == 76) {
			
			controleur.loadKey = true;
			
		}
	
}
Controleur.prototype.keyup = function(e) {
	var unicode = "";
	
	if (navigator.appName == "Microsoft Internet Explorer") {
			unicode = event.keyCode; // not a typo.
	}
	else{
		unicode = e.which;
	}
		if (unicode == 65 || unicode == 97 || unicode == 37) {
			
			controleur.leftKey = false;
		}
		else if (unicode == 68  || unicode == 100 || unicode == 39) {
			
			controleur.rightKey = false;
		}
		
		if (unicode == 87 || unicode == 38) {
			
			controleur.upKey = false;
		}
		else if (unicode == 83 || unicode == 40) {
			
			controleur.downKey = false;
		}
		
		if (unicode == 32) {
			
			controleur.shootKey = false;
		}
		if (unicode == 16) {
			
			controleur.shiftKey = false;
			controleur.lockShiftKey = false;
		}
		if (unicode == 74) {
			
			controleur.pauseKey = false;
			controleur.lockPauseKey = false;
			
		}
		if (unicode == 75) {
			
			controleur.saveKey = false;
			controleur.lockSaveKey = false;
			
		}
		if (unicode == 76) {
			
			controleur.loadKey = false;
			controleur.lockLoadKey = false;
			
		}
}

Controleur.prototype.deplacementSouris = function(){
	if (this.mouseRight && this.lockMouseRight) {
			
			if(controleur.modele.ship.mode == 0){
				controleur.modele.ship.mode = 1;
				controleur.modele.ship.color = constants.BLUE;
			}
			else if(controleur.modele.ship.mode == 1){
				controleur.modele.ship.mode = 0;
				controleur.modele.ship.color = constants.RED;
			}
			
			controleur.lockMouseRight = false;
		}
		else if (this.mouseLeft) {
			controleur.modele.ship.shoot();
		}

}


Controleur.prototype.mousedown = function(e){
	if (controleur.paused && !controleur.endgame){
		controleur.paused = false;
		controleur.mainloop();
		console.log("red");
	}
	else if(controleur.display){
		if(e.button == 0){
			controleur.mouseLeft = true;
			console.log("mama");
		}
		else if(e.button == 2){
			controleur.mouseRight = true;
			controleur.lockMouseRight = true;
		}
	
	}
}

Controleur.prototype.mouseup = function(e){
	if (controleur.paused && !controleur.endgame){
		controleur.paused = false;
		controleur.mainloop();
		console.log("red");
	}
	else if(controleur.display){
		if(e.button == 0){
			controleur.mouseLeft = false;
			
		}
		else if(e.button == 2){
			controleur.mouseRight = false;
			controleur.lockMouseRight = false;
			console.log("papa");
		}
	
	}
}



Controleur.prototype.phasedeux = function(){

var temp;

temp = EnemyA.prototype.shoot;
EnemyA.prototype.shoot = EnemyB.prototype.shoot;
EnemyB.prototype.shoot = temp;

temp = EnemyB.prototype.shoot;
EnemyB.prototype.shoot = EnemyC.prototype.shoot;
EnemyC.prototype.shoot = temp;
/*
temp = EnemyC.prototype.shoot;
EnemyC.prototype.shoot = EnemyA.prototype.shoot;
EnemyA.prototype.shoot = temp;
*/
constants.ENEMYA_SPEED += 1;
constants.ENEMYB_SPEED += 1;
constants.ENEMYC_SPEED += 1;

controleur.frequencyP += 0.3;
controleur.frequencyE += 0.5;

	constants.ENEMYA_SIZE_X += 2;
	constants.ENEMYA_SIZE_Y += 2;
	
	constants.ENEMYB_SIZE_X += 2;
	constants.ENEMYB_SIZE_Y += 2;
	
	constants.ENEMYC_SIZE_X += 2;
	constants.ENEMYC_SIZE_Y += 2;

console.log("switcheroo");
}