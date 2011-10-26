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
	
	this.MISSILE_SIZE_X = 3;
	this.MISSILE_SIZE_Y = 4;
	
	this.ENEMYA_SIZE_X = 5;
	this.ENEMYA_SIZE_Y = 12;
	
	this.ENEMYB_SIZE_X = 7;
	this.ENEMYB_SIZE_Y = 7;
}

function loadGame(){
	console.log("hello");
	/*plug mes écouteurs*/
	
	if (controleur==""){
		controleur= new Controleur();
		constants= new Constants(document.body.clientHeight, document.body.clientWidth);
		setSize();
		
		document.onkeydown = controleur.keydown;
		document.onkeyup = controleur.keyup;
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
		canvas.height = winH - 5;
		canvas.width = winW - 5;
		constants.MAX_X = winW - 5;
		constants.MAX_Y = winH - 5;
	
}

function Modele(parent){
	this.parent = parent;
	this.ship = new Ship();
	this.score = 0;
	
	this.arrayMissilesJoueur = new Array();
	this.arrayMissilesJoueur.unshift(new Missile(200,100));
	
	this.arrayEnemyA = new Array(10);
	this.arrayEnemyA.unshift(new EnemyA(200,100));
	
	this.arrayEnemyB = new Array(10);
	this.arrayEnemyB.unshift(new EnemyB(200,100));
}

function Vue(parent){
	this.parent=parent;
	
}

Vue.prototype.afficheShip= function(x,y, liste){
    var canvas = document.getElementById("canvas");
    if (canvas.getContext) {  
		var ctx = canvas.getContext("2d");
		ctx.fillStyle = "rgba(180,124, 20, 0.8)"; 
		ctx.clearRect(0,0,constants.MAX_X,constants.MAX_Y);
		ctx.fillStyle = "rgba(180,124, 20, 0.8)"; 
		ctx.beginPath();
		ctx.arc(x,y,20,0,2*Math.PI,false);
		ctx.fill();
		ctx.closePath();
		
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
		var g = "Hi-Score: " + controleur.modele.score;
		//ctx.measureText(g);
		ctx.fillText(g, 20 , 30);
	}  
}

Vue.prototype.afficheEnnemis= function(liste, color){
	var canvas = document.getElementById("canvas");
    if (canvas.getContext) {  
		var ctx = canvas.getContext("2d");
		ctx.fillStyle = color;
		var i = 0;
		for (i = 0; i < liste.length; i++){
			if(liste[i] != null){
				ctx.fillRect(liste[i].x,
							liste[i].y,
							constants.ENEMYA_SIZE_X,
							constants.ENEMYA_SIZE_Y);
							
				liste[i].nextPoint();
				liste[i].collisionShip(controleur.modele.ship);
				if(liste[i].dead){
					liste.splice(i, 1);
				}
				}

		}
	}

}

Vue.prototype.afficheHigh= function(){
	var canvas = document.getElementById("canvas");
    if (canvas.getContext) {  
		var ctx = canvas.getContext("2d");
		
		//ctx.clearRect(0,0,constants.MAX_X,constants.MAX_Y);
		ctx.fillStyle = "rgba(180,124, 20, 0.8)";
		ctx.font = 'normal 20px sans-serif';
		var g = "Hi-Score: " + controleur.modele.score;
		//ctx.measureText(g);
		ctx.fillText(g, 20 , 20);
	}

}

Vue.prototype.afficheMenu= function(){
	var canvas = document.getElementById("canvas");
    if (canvas.getContext) {  
		var ctx = canvas.getContext("2d");
		
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
	
	//this.vue.afficheEnnemis(this.modele.arrayEnemyA, 3);
	this.lock = false;
	this.frame = 0;
	this.finished = true;
	this.endgame = false;
	
	this.vue.afficheMenu();
	
	this.mainloop = masterloop;
	
}

function masterloop(){
		
		
		if (controleur.frame % 20 == 0){
			controleur.modele.arrayEnemyA.unshift(new EnemyA(Math.floor(Math.random()*constants.MAX_X), 0));
			//controleur.modele.arrayEnemyA.unshift(new EnemyA());
		}
		
		if(controleur.frame % 35 == 0){
			controleur.modele.arrayEnemyB.unshift(new EnemyB(Math.floor(Math.random()*constants.MAX_X), 0));
		}
		controleur.vue.afficheShip(controleur.modele.ship.x, controleur.modele.ship.y, controleur.modele.arrayMissilesJoueur);
		controleur.vue.afficheEnnemis(controleur.modele.arrayEnemyA, constants.ENEMYA_COLOR );
		controleur.vue.afficheEnnemis(controleur.modele.arrayEnemyB, constants.ENEMYB_COLOR );
		//controleur.vue.afficheHigh();
		controleur.frame++;
		
		if(!controleur.finished){
			setTimeout(masterloop, 30);
		}
		else{
			controleur = new Controleur();
		}
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
			console.log("left");
			controleur.modele.ship.movex(-5);
		}
		else if (unicode == 68  || unicode == 100 || unicode == 39) {
			console.log("right");
			controleur.modele.ship.movex(5);
		}
		
		if (unicode == 87 || unicode == 38) {
			console.log("up");
			controleur.modele.ship.movey(-5);
		}
		else if (unicode == 83 || unicode == 40) {
			console.log("down");
			controleur.modele.ship.movey(5);
		}
		
		if (unicode == 32) {
			console.log("space");
			controleur.modele.ship.shoot();
			console.log(controleur.modele.arrayMissilesJoueur.length);
			// ball.jump(); - à lier avec la balle, selon votre nom de variable/fonction
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
	console.log(unicode);
	
}

Controleur.prototype.mousedown = function(e){
	if (controleur.finished && !controleur.endgame){
		controleur.finished = false;
		controleur.mainloop();
	}
	else if(controleur.finished && controleur.endgame){
		controleur.vue.afficheMenu();
		controleur.finished = false;
	}
	else if(!controleur.finished && controleur.endgame){
		controleur.finished = false;
		controleur.endgame = false;
		controleur.mainloop();
	}
}