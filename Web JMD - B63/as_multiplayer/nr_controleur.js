/*	Nicolas Roy-Bourdages - 2011
*	Web avancé phase 1 - Space shooter
*/	

controleur="";
defaultconstants = "";
constants ="";
constants= new Constants(0, 0);
defaultconstants = constants;
serial = new SimpleSerial();

window.onload = function(){
	loadGame();
	
}

//QUICK GAME LOADER HACKED IN 5 MIN - TO REDO
function lalagame(){
	var tmp = unescape(window.location.search.substring(1).split("?"));
	if(tmp != null && tmp != ""){
	var x = tmp.substring(5).split("=");
	if( x != "" && x != null){
	x = x[0].substring(5);
	
	console.log(x);
	controleur.mainloop();
	controleur.saveSlot = parseInt(x);
	controleur.loadKey = true;
	
	controleur.display = true;
	//serial.loadGame();
	//controleur.saveSlot
	}
	}
	}

window.onresize = function(){
	setSize();
}

/*
   Load la partie
*/
function loadGame(){
	console.log("hello");
	
	if (controleur==""){
		
		constants = new Constants();
		
		setSize();
		
		defaultconstants = constants;
		
		var ship = new Ship(Math.floor(constants.MAX_X / 2), constants.MAX_Y - 100);
		
		setCookies(ship);
		
		//bonus
		
		var v = new Vue();
		var m = new Modele(ship);
		var d = new Date();
		controleur= new Controleur(v,m,d);
		
		/*plug mes écouteurs*/
		document.onkeydown = controleur.keydown;
		document.onkeyup = controleur.keyup;
		
		
		document.onmousedown = controleur.mousedown;
		document.onmouseup = controleur.mouseup;
		
		controleur.vue.afficheMenu(ship.lastHiScore);
		console.log("Voici votre nouveau Controleur "+controleur);
		
		lalagame();
	}else{
		console.log("...!");
	}
}
/*
Donne la bonne taille au canvas
*/
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
/*
	Set les cookies au démarrage
*/
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

/*
	Le maître du jeu
*/

function Controleur(vue,modele,date){
	this.vue=vue;
	this.modele=modele;
	
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
	
	this.frame = 0;
	this.date = date;
	this.startTime = this.date.getTime();
	
	this.phase = 0;
	this.paused = true;
	this.display = true;
	this.endgame = false;
	
	this.saveSlot = 48;
	this.frequencyP = 1.0;
	this.frequencyE = 1.0;
	
	this.vue.afficheMenu();
	
	this.mainloop = masterloop;
	
	this.toJSON = function(key){
		var replacement = new Object();
		
			replacement["frame"] = this.frame;
			replacement["phase"] = this.phase;
			
			replacement["ship"] = this.modele.ship;
			
			replacement["constants"] = constants;
		
		return replacement;
	}
}
/*
	La boucle principale
*/

function masterloop(){
		
		controleur.deplacement();
		controleur.deplacementSouris();
		
		//console.log(controleur.modele.arrayMissilesAutres.length);
		
		if(controleur.display){
			controleur.newItems();
			
			controleur.vue.afficheShip(controleur.modele.ship.x, controleur.modele.ship.y, controleur.modele.arrayMissilesJoueur);
			controleur.vue.afficheMetaObject(controleur.modele.arrayEnemyA, constants.ENEMYA_SIZE_X,constants.ENEMYA_SIZE_Y );
			controleur.vue.afficheMetaObject(controleur.modele.arrayEnemyB, constants.ENEMYB_SIZE_X,constants.ENEMYB_SIZE_Y );
			controleur.vue.afficheMetaObject(controleur.modele.arrayEnemyC, constants.ENEMYC_SIZE_X,constants.ENEMYC_SIZE_Y );
			
			controleur.vue.afficheMetaObject(controleur.modele.arrayMissilesJoueur, constants.MISSILE_SIZE_X,constants.MISSILE_SIZE_Y );
			controleur.vue.afficheMetaObject(controleur.modele.arrayMissilesAutres, constants.ENEMYMISSILE_SIZE_X,constants.ENEMYMISSILE_SIZE_Y );
			
			controleur.vue.affichePower(controleur.modele.arrayPowerUp, constants.POWERUP_SIZE_X, constants.POWERUP_SIZE_Y );
			controleur.vue.affichePower(controleur.modele.arrayPowerUpM, constants.POWERUP_SIZE_X, constants.POWERUP_SIZE_Y );
			
			controleur.vue.afficheMetaObject(controleur.modele.arrayStars, constants.STARS_SIZE_X,constants.STARS_SIZE_Y );
			
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
			effaceCookie("lastscore");
			creeCookie("lastscore", controleur.modele.ship.hiscore, 20);
			
			
			
			
			window.location.search = "";
			controleur = "";
			loadGame();
			constants.ENEMYA_SPEED = 2;
			constants.ENEMYB_SPEED = 4;
			constants.ENEMYC_SPEED = 3;

			
		}
}

/*
	Contrôle la création des nouveaux items en haut de l'écran
*/
Controleur.prototype.newItems = function(){
		
		if(controleur.frame % 10 == 0){
			
			updateScore(controleur.modele.ship.hiscore, controleur.modele.ship.x, controleur.modele.ship.x);
			
		}
		
		controleur.modele.arrayStars.unshift(new Star(Math.floor(Math.random()*constants.MAX_X), 0));
		if(controleur.frame % Math.floor(150 / this.frequencyP) == 0){
			controleur.modele.arrayPowerUp.unshift(new PowerUp(Math.floor(Math.random()*constants.MAX_X), 0));
		}
		
		if(controleur.frame % Math.floor(250 / this.frequencyP) == 0){
			controleur.modele.arrayPowerUpM.unshift(new PowerUpMulti(Math.floor(Math.random()*constants.MAX_X), 0));
		}
		
		if(controleur.frame % Math.floor(700 / this.frequencyP) == 0){
			controleur.modele.arrayPowerUpM.unshift(new PowerUpVies(Math.floor(Math.random()*constants.MAX_X), 0));
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
		}
		
		if(controleur.frame % Math.floor(35 / this.frequencyE) == 0){
			controleur.modele.arrayEnemyB.unshift(new EnemyB(Math.floor(Math.random()*constants.MAX_X), 0, 0));
		}
		if(controleur.frame % Math.floor(50 / this.frequencyE) == 0){
			controleur.modele.arrayEnemyC.unshift(new EnemyD(Math.floor(Math.random()*constants.MAX_X), 0, 1));
		}
		
		
		if(controleur.frame % 1000 == 0){
			controleur.phasedeux();
			
		}
		
}

/*
	Agit effectivement sur les commandes de l'usager
*/

Controleur.prototype.deplacement = function(){
		
		var speed = controleur.modele.ship.speed;
		
		
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
			
		}
		if (this.shiftKey && !this.lockShiftKey) {
			//console.log("shift");
			if(controleur.modele.ship.mode == 0){
				controleur.modele.ship.mode = 1;
				controleur.modele.ship.tempmode = 1;
				controleur.modele.ship.color = constants.BLUE;
			}
			else if(controleur.modele.ship.mode == 1){
				controleur.modele.ship.mode = 0;
				controleur.modele.ship.tempmode = 0;
				controleur.modele.ship.color = constants.RED;
			}
			else if(controleur.modele.ship.mode == 666){
				if(controleur.modele.ship.tempmode == 0){
					controleur.modele.ship.tempmode = 1;
				}
				else if(controleur.modele.ship.tempmode == 1){
					controleur.modele.ship.tempmode = 0;
				}
			
			
			}
			
			controleur.lockShiftKey = true;
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

/*
	L'effet du clavier
*/

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
	//console.log(unicode);
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
		
		if (unicode > 47 && unicode < 54) {
			
			console.log(unicode);
			controleur.saveSlot = unicode;
			
		}
		if (unicode == 80) {
			if(!controleur.endgame && !controleur.paused){
			controleur.paused = true;
			controleur.endgame = true;
			}
		}
		if (unicode == 27) {
			
			window.location = "nr_index.html";
			
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

/*
	L'effet de la souris
*/

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
			else if(controleur.modele.ship.mode == 666){
				if(controleur.modele.ship.tempmode == 0){
					controleur.modele.ship.tempmode = 1;
				}
				else if(controleur.modele.ship.tempmode == 1){
					controleur.modele.ship.tempmode = 0;
				}
			
			
			}
			
			controleur.lockMouseRight = false;
		}
		else if (this.mouseLeft) {
			controleur.modele.ship.shoot();
		}

}

/*
	Keyup, keydown...
*/
Controleur.prototype.mousedown = function(e){
	if (controleur.paused && !controleur.endgame){
		var extra = lisCookie("extralife");
		
		if(extra != null && extra != 0){
			controleur.modele.ship.lives += parseInt(extra);
			alert("Bonus Hi-Score: " + extra + " vies extra!");
		}
		
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

/*
	La fonction qui change la phase
*/

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

	constants.ENEMYA_SIZE_X += 3;
	constants.ENEMYA_SIZE_Y += 3;
	
	constants.ENEMYB_SIZE_X += 3;
	constants.ENEMYB_SIZE_Y += 3;
	
	constants.ENEMYC_SIZE_X += 3;
	constants.ENEMYC_SIZE_Y += 3;

console.log("switcheroo");
controleur.phase += 1;
}