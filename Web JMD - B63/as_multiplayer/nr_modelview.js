/*	Nicolas Roy-Bourdages - 2011
*	Web avanc� phase 1 - Space shooter
*/	

function Modele(ship){
	//this.parent = parent;
	this.ship = ship;
	//this.score = 0;
	
	
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
	this.arrayPowerUpM = new Array();
	
	this.arrayStars = new Array();
}

function Vue(){
	//this.parent=parent;
	
}

Vue.prototype.afficheShip= function(x,y, liste){
    var canvas = document.getElementById("canvas");
    if (canvas.getContext) {  
		var ctx = canvas.getContext("2d");
		//ctx.fillStyle = "rgba(180,124, 20, 0.8)"; 
		ctx.clearRect(0,0,constants.MAX_X,constants.MAX_Y);
		ctx.fillStyle = controleur.modele.ship.color;
		ctx.beginPath();
		ctx.arc(x,y,constants.SHIP_SIZE_X,0,2*Math.PI,false);
		ctx.fill();
		ctx.closePath();
		
		controleur.modele.ship.selfCheck();
		
		ctx.font = 'normal 30px sans-serif';
		var i = "";
		date = new Date();
		
		ctx.fillStyle = "rgba(10,200, 200, 0.8)";
		i = "Temps: " + Math.floor((date.getTime() - controleur.startTime) / 1000) + "s";
		ctx.fillText(i, 20 , 30);
		
		ctx.fillStyle = "rgba(100,255, 0, 0.8)";
		i = "Score: " + Math.floor(controleur.modele.ship.hiscore);
		ctx.fillText(i, 20 , 60);
		
		ctx.fillStyle = "rgba(200,10, 0, 0.8)";
		i = "Multiplicateur: " + controleur.modele.ship.multi.toPrecision(5) + "X";
		ctx.fillText(i, 20 , 90);
		
		ctx.font = 'normal 30px sans-serif';
		
		ctx.fillStyle = "rgba(125,125,125, 0.8)";
		i = "Hi-score: " + Math.floor(controleur.modele.ship.lastHiScore);
		ctx.fillText(i, 20 , 150);
		
		ctx.fillStyle = "rgba(185,185, 185, 0.8)";
		i = "Phase: " + controleur.phase;
		ctx.fillText(i, 20 , 180);
		
		ctx.fillStyle = "rgba(200,200, 255, 0.8)";
		i = "Vitesse: " + controleur.modele.ship.speed;
		ctx.fillText(i, 20 , 210);
		
		ctx.fillStyle = "rgba(255,255, 255, 0.8)";
		i = "Vies: " + controleur.modele.ship.lives;
		ctx.fillText(i, 20 , 240);
		
		ctx.font = 'normal 15px sans-serif';
		
		ctx.fillStyle = "rgba(255,255, 255, 0.4)";
		i = "Case Sauvegarde: " + controleur.saveSlot;
		ctx.fillText(i, 20 , 270);
		
		if(controleur.modele.ship.shot){
			
			ctx.font = 'normal 30px sans-serif';
			
			ctx.fillStyle = "rgba(255,0, 0, 0.4)";
			i = "R�g�n�ration...";
			ctx.fillText(i, 20 , 300);
		}
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
				//console.log(liste[i].color);			
				liste[i].nextPoint();
				liste[i].collisionShip(controleur.modele.ship);
				liste[i].collisionMissile(controleur.modele.arrayMissilesJoueur, sizex, sizey);
				
				if(liste[i].y > constants.MAX_Y || liste[i].dead || liste[i].x > constants.MAX_X || liste[i].x < 0 || liste[i].y < 0){
					liste[i].death(controleur.modele.ship);
					liste.splice(i, 1);
				}
				}

		}
	}

}

Vue.prototype.afficheMultiShips= function(liste, sizex, sizey){
	var canvas = document.getElementById("canvas");
    if (canvas.getContext) {  
		var ctx = canvas.getContext("2d");
		
				if(liste.x != 0  && liste.y != 0){
				//console.log("winning");
				//console.log(liste.color + " " + liste.x + " " + liste.y);
				ctx.fillStyle = liste.color;
				ctx.beginPath();
				ctx.arc(liste.x, liste.y, sizex,0,2*Math.PI,false);
				ctx.fill();
				ctx.closePath();
				}
	}

}
	



Vue.prototype.affichePower= function(liste, sizex, sizey){
    var canvas = document.getElementById("canvas");
    if (canvas.getContext) {  
		var ctx = canvas.getContext("2d");
		
		var i = 0;
		for (i = 0; i < liste.length; i++){
			if(liste[i] != null){
				ctx.fillStyle = liste[i].color;
				ctx.beginPath();
				ctx.arc(liste[i].x, liste[i].y, sizex,0,2*Math.PI,false);
				ctx.fill();
				ctx.closePath();
				
				liste[i].nextPoint();
				liste[i].collisionShip(controleur.modele.ship);
				liste[i].collisionMissile(controleur.modele.arrayMissilesJoueur, sizex, sizey);
				
				if(liste[i].y > constants.MAX_Y || liste[i].dead || liste[i].x > constants.MAX_X || liste[i].x < 0 || liste[i].y < 0){
					liste[i].death(controleur.modele.ship);
					liste.splice(i, 1);
				}
			}
		}
	}
}

Vue.prototype.afficheMenu= function(score){
	var canvas = document.getElementById("canvas");
    if (canvas.getContext) {  
		var ctx = canvas.getContext("2d");
		canvas.oncontextmenu = function() {
			return false;  
		}
		//ctx.clearRect(0,0,700,500);
		ctx.clearRect(0,0,constants.MAX_X,constants.MAX_Y);
		ctx.fillStyle = "rgba(100,100, 255, 0.8)";
		ctx.font = 'normal 20px sans-serif';
		var g = "AWESOME SHOOTER";
		var h = "WASD ou fl�ches pour se d�placer, ";
		var i = "Espace/Souris-gauche pour tirer,";
		var j = "Shift/Souris-droit pour changer de mode";
		var k = "Cliquez pour d�buter une partie";
		var l = "(Escape en tout temps pour revenir, p pour pause)";
		
		//ctx.measureText(g);
		ctx.fillText(g, 100 , 100);
		ctx.fillText(h, 100 , 200);
		ctx.fillText(i, 100 , 300);
		ctx.fillText(j, 100 , 400);
		ctx.fillText(k, 100 , 500);
		ctx.fillText(l, 100 , 700);
		//ctx.fillText(i, 100 , 300);
		
		ctx.fillText("Hi-Score: " + Math.floor(score), 100 , 600);
	}

}

Vue.prototype.afficheMulti= function(liste){
    var canvas = document.getElementById("canvas");
    if (canvas.getContext) {
		var ctx = canvas.getContext("2d");
		
		//controleur.modele.ship.selfCheck();
		//console.log(liste);
		ctx.font = 'normal 30px sans-serif';
		var i = "";
		var hauteur = 500;
		var couleur = 100;
		
		ctx.fillStyle = "rgba(" + couleur + "," + couleur + "," + couleur + ", 0.9)";
		ctx.fillText("STATS:::MULTI", 20 , hauteur);
		hauteur += 30;
		ctx.fillText("0o0o0o0o0o0o0", 20 , hauteur);
		hauteur += 30;
		couleur += 20;
		
		for (x in liste){
		ctx.fillStyle = "rgba(" + couleur + "," + couleur + "," + couleur + ", 0.9)";
		//console.log(liste[x]);
			
			ctx.fillText(liste[x]["NOMJOUEUR"], 20 , hauteur);
			hauteur += 30;
			ctx.fillText(liste[x]["SCORE"], 20 , hauteur);
			hauteur += 30;
			//ctx.fillText(currentuser, 20 , hauteur);
			//hauteur += 30;
			
			if(liste[x]["NOMJOUEUR"] != currentuser){
			
			liste[x].x = liste[x]["X"];
			liste[x].y = liste[x]["Y"];
			liste[x].color = "rgba(" + couleur + "," + couleur + "," + couleur + ", 0.7)";
			console.log(liste[x].x);
			console.log(liste[x].y);
			controleur.vue.afficheMultiShips(liste[x], 20, 20);
			couleur += 40;
			}
		}
	}
}

Vue.prototype.afficheEndGame= function(liste){
    var canvas = document.getElementById("canvas");
    if (canvas.getContext) {
		var ctx = canvas.getContext("2d");
		ctx.clearRect(0,0,constants.MAX_X,constants.MAX_Y);
		//controleur.modele.ship.selfCheck();
		//console.log(liste);
		ctx.font = 'normal 30px sans-serif';
		var i = "";
		var hauteur = 400;
		var couleur = 100;
		
		ctx.fillStyle = "rgba(" + couleur + "," + couleur + "," + couleur + ", 0.9)";
		ctx.fillText("VOUS �TES MORT!", 20 , hauteur);
		hauteur += 30;
		ctx.fillStyle = "rgba(" + couleur + "," + couleur + "," + couleur + ", 0.9)";
		ctx.fillText("Appuyez sur quitter pour revenir au menu principal...", 20 , hauteur);
		hauteur += 70;
		
		ctx.fillStyle = "rgba(" + couleur + "," + couleur + "," + couleur + ", 0.9)";
		ctx.fillText("STATS:::MULTI", 20 , hauteur);
		hauteur += 30;
		ctx.fillText("0o0o0o0o0o0o0", 20 , hauteur);
		hauteur += 30;
		couleur += 20;
		
		for (x in liste){
		ctx.fillStyle = "rgba(" + couleur + "," + couleur + "," + couleur + ", 0.9)";
		//console.log(liste[x]);
			
			ctx.fillText(liste[x]["NOMJOUEUR"], 20 , hauteur);
			hauteur += 30;
			ctx.fillText(liste[x]["SCORE"], 20 , hauteur);
			hauteur += 30;
			//ctx.fillText(currentuser, 20 , hauteur);
			//hauteur += 30;
			
			if(liste[x]["NOMJOUEUR"] != currentuser){
			
			liste[x].x = liste[x]["X"];
			liste[x].y = liste[x]["Y"];
			liste[x].color = "rgba(" + couleur + "," + couleur + "," + couleur + ", 0.7)";
			console.log(liste[x].x);
			console.log(liste[x].y);
			controleur.vue.afficheMultiShips(liste[x], 20, 20);
			couleur += 40;
			}
		}
	}
}

