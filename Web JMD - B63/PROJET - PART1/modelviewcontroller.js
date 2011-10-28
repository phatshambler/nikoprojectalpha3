controleur="";
constants ="";

window.onresize = function(){
	setSize();
}

function Constants(maxx, maxy){

	this.MAX_X = maxx;
	this.MAX_Y = maxy;
	this.NO_OF_SHIPS = 10;
	this.SHIP_SPEED = 12;
	
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
	
	this.BLUE = "rgba(10,125,250,0.9)";
	this.RED = "rgba(250,125,10,0.9)";
	
	this.VALUEOFMISSILE = 100;
}

function loadGame(){
	console.log("hello");
	
	
	if (controleur==""){
		
		constants= new Constants(document.body.clientHeight, document.body.clientWidth);
		setSize();
		controleur= new Controleur();
		
		/*plug mes écouteurs*/
		document.onkeydown = controleur.keydown;
		document.onkeyup = controleur.keyup;
		//document.onkeypress = controleur.keypressed;
		
		document.onmousedown = controleur.mousedown;
		
		controleur.vue.afficheMenu();
		console.log("Voici votre nouveau Controleur "+controleur);
	}else{
		console.log("...!");
	}
}

function setSize(){
	var winW = 630, winH = 460;
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

function Modele(parent){
	this.parent = parent;
	this.ship = new Ship(Math.floor(constants.MAX_X / 2), constants.MAX_Y - 100);
	this.score = 0;
	
	
	this.ship.lastHiScore = lisCookie("hiscore");
	
	if(this.ship.lastHiScore == null){
		creeCookie("hiscore", 1, 10);
		this.ship.lastHiScore = lisCookie("hiscore");
	}
	
	this.arrayMissilesJoueur = new Array();
	//this.arrayMissilesJoueur.unshift(new Missile(200,100));
	
	this.arrayMissilesAutres = new Array();
	
	this.arrayEnemyA = new Array();
	//this.arrayEnemyA.unshift(new EnemyA(200,100));
	
	this.arrayEnemyB = new Array();
	//this.arrayEnemyB.unshift(new EnemyB(400,100));
	
	this.arrayEnemyC = new Array();
	//this.arrayEnemyC.unshift(new EnemyC(600,100));
	
	this.arrayPowerUp = new Array();
	this.arrayStars = new Array();
}

function Vue(parent){
	this.parent=parent;
	
}

Vue.prototype.afficheShip= function(x,y, liste){
    var canvas = document.getElementById("canvas");
    if (canvas.getContext) {  
		var ctx = canvas.getContext("2d");
		//ctx.fillStyle = "rgba(180,124, 20, 0.8)"; 
		ctx.clearRect(0,0,constants.MAX_X,constants.MAX_Y);
		ctx.fillStyle = controleur.modele.ship.color;
		ctx.beginPath();
		ctx.arc(x,y,20,0,2*Math.PI,false);
		ctx.fill();
		ctx.closePath();
		/*
		ctx.fillStyle = "rgba(200,200,0,50)";
		var i = 0;
		for (i = 0; i < liste.length; i++){
			if(liste[i] != null){
				ctx.fillRect(liste[i].x,
							liste[i].y,
							constants.MISSILE_SIZE_X,
							constants.MISSILE_SIZE_Y);
							
				liste[i].movey(-5);
				if(liste[i].dead){
					liste.splice(i, 1);
				}
				}

		}
		*/
		ctx.fillStyle = "rgba(180,124, 20, 0.8)";
		ctx.font = 'normal 30px sans-serif';
		
		var g = "Hi-Score: " + controleur.modele.ship.hiscore;
		//ctx.measureText(g);
		ctx.fillText(g, 20 , 30);
		var h = "Top score: " + controleur.modele.ship.lastHiScore;
		ctx.fillText(h, 20 , 60);
	}  
}

Vue.prototype.afficheMetaObject= function(liste, sizex, sizey){
	var canvas = document.getElementById("canvas");
    if (canvas.getContext) {  
		var ctx = canvas.getContext("2d");
		//ctx.fillStyle = color;
		var i = 0;
		for (i = 0; i < liste.length; i++){
			if(liste[i] != null){
				ctx.fillStyle = liste[i].color;
				ctx.fillRect(liste[i].x,
							liste[i].y,
							sizex,
							sizey);
							
				liste[i].nextPoint();
				liste[i].collisionShip(controleur.modele.ship);
				liste[i].collisionMissile(controleur.modele.arrayMissilesJoueur, sizex, sizey);
				
				if(liste[i].y > constants.MAX_Y || liste[i].dead){
					liste[i].death(controleur.modele.ship);
					liste.splice(i, 1);
				}
				}

		}
	}

}

Vue.prototype.afficheMenu= function(){
	var canvas = document.getElementById("canvas");
    if (canvas.getContext) {  
		var ctx = canvas.getContext("2d");
		
		//ctx.clearRect(0,0,700,500);
		ctx.clearRect(0,0,constants.MAX_X,constants.MAX_Y);
		ctx.fillStyle = "rgba(180,124, 20, 0.8)";
		ctx.font = 'normal 20px sans-serif';
		var g = "Le jeu du siècle!";
		var h = "WASD pour se déplacer, Space pour tirer";
		var i = "Cliquez pour débuter une partie";
		var k = "Augmenter difficulté - peser + ou -";
		//ctx.measureText(g);
		ctx.fillText(g, 100 , 100);
		ctx.fillText(h, 100 , 200);
		ctx.fillText(i, 100 , 300);
	}

}

function Controleur(){
	this.vue=new Vue(this);
	this.modele=new Modele(this);
	//this.vue.afficheShip(this.modele.ship.x,this.modele.ship.y, this.modele.arrayMissilesJoueur);
	this.leftKey = false;
	this.rightKey = false;
	this.downKey = false;
	this.upKey = false;
	this.shootKey = false;
	this.shiftKey = false;
	this.lockShiftKey = false;
	
	//this.vue.afficheMetaObject(this.modele.arrayEnemyA, 3);
	this.lock = false;
	this.frame = 0;
	this.paused = true;
	this.endgame = false;
	
	this.vue.afficheMenu();
	
	this.mainloop = masterloop;
}

function masterloop(){
		
		controleur.deplacement();
		
		controleur.newItems();
		
		controleur.modele.ship.selfCheck();
		
		controleur.vue.afficheShip(controleur.modele.ship.x, controleur.modele.ship.y, controleur.modele.arrayMissilesJoueur);
		controleur.vue.afficheMetaObject(controleur.modele.arrayEnemyA, constants.ENEMYA_SIZE_X,constants.ENEMYA_SIZE_Y );
		controleur.vue.afficheMetaObject(controleur.modele.arrayEnemyB, constants.ENEMYB_SIZE_X,constants.ENEMYB_SIZE_Y );
		controleur.vue.afficheMetaObject(controleur.modele.arrayEnemyC, constants.ENEMYC_SIZE_X,constants.ENEMYC_SIZE_Y );
		
		controleur.vue.afficheMetaObject(controleur.modele.arrayMissilesJoueur, constants.MISSILE_SIZE_X,constants.MISSILE_SIZE_Y );
		controleur.vue.afficheMetaObject(controleur.modele.arrayMissilesAutres, constants.ENEMYMISSILE_SIZE_X,constants.ENEMYMISSILE_SIZE_Y );
		
		controleur.vue.afficheMetaObject(controleur.modele.arrayPowerUp, constants.POWERUP_SIZE_X,constants.POWERUP_SIZE_Y );
		
		controleur.vue.afficheMetaObject(controleur.modele.arrayStars, constants.STARS_SIZE_X,constants.STARS_SIZE_Y );
		//controleur.vue.afficheHigh();
		controleur.frame++;
		
		if(!controleur.paused){
			setTimeout(masterloop, 30);
		}
		else{
		if(controleur.modele.ship.hiscore >= controleur.modele.ship.lastHiScore){
				effaceCookie("hiscore");
				creeCookie("hiscore", controleur.modele.ship.hiscore, 20);
			}
			controleur = new Controleur();
		}
}
Controleur.prototype.newItems = function(){

		controleur.modele.arrayStars.unshift(new Star(Math.floor(Math.random()*constants.MAX_X), 0));
		if(controleur.frame % 150 == 0){
			controleur.modele.arrayPowerUp.unshift(new PowerUp(Math.floor(Math.random()*constants.MAX_X), 0));
		}
		
		if (controleur.frame % 70 == 0){
			tempX = Math.floor(Math.random(controleur.frame)*constants.MAX_X);
			tempY = 0;
			compteur = 0;
		}
		
		if (compteur < 5){
			controleur.modele.arrayEnemyC.unshift(new EnemyC(tempX, tempY));
			tempY += 15;
			compteur += 1;
		}
		
		if (controleur.frame % 20 == 0){
			controleur.modele.arrayEnemyA.unshift(new EnemyA(Math.floor(Math.random()*constants.MAX_X), 0));
			//controleur.modele.arrayEnemyA.unshift(new EnemyA());
		}
		
		if(controleur.frame % 35 == 0){
			controleur.modele.arrayEnemyB.unshift(new EnemyB(Math.floor(Math.random()*constants.MAX_X), 0));
		}
}

Controleur.prototype.deplacement = function(){
		
		var speed = controleur.modele.ship.speed;
		var accel = controleur.modele.ship.acceleration;
		speed = speed + accel;
		//console.log(this.leftKey + " " + this.rightKey + " " + this.upKey + " " + this.downKey);
		
		if (this.leftKey) {
			//console.log("left");
			controleur.modele.ship.movex(-speed);
		}
		else if (this.rightKey) {
			//console.log("right");
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
}

Controleur.prototype.mousedown = function(e){
	if (controleur.paused && !controleur.endgame){
		controleur.paused = false;
		controleur.mainloop();
		console.log("red");
	}
}