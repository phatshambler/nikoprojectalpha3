// fonctions de creation, de lecture et de suppression de cookie
function creeCookie(nom,valeur,jour) {
	if (jour) {
		// on peut donner le detail du moment de suppression automatique ici en jour
		var date = new Date();
		date.setTime(date.getTime()+(jour*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = nom+"="+valeur+expires+"; path=/";
}

function lisCookie(nom) {
	// comme un cookie est une chaine de texte unique on doit l'analyser
	// ce que nous faisons ici
	var nomCookie = nom + "=";
	var listeCookies = document.cookie.split(';');
	for(var i=0;i < listeCookies.length;i++) {
		var c = listeCookies[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nomCookie) == 0) return c.substring(nomCookie.length,c.length);
	}
	return null;
}

function effaceCookie(nom) {
	// pour supprimer on dit qu'on veut un certain nom (celui qu'on veut supprimer du
	// dans le passe... effacer par le fureteur à la prochaine verification
	creeCookie(nom,"",-1);
}
// fin des fonction de cookies


function Vue(parent){
	this.parent=parent;
	
}
Vue.prototype.affiche= function(x,y){
    var canvas = document.getElementById("airedejeu");  
    if (canvas.getContext) {  
		var ctx = canvas.getContext("2d");  
		ctx.clearRect(0,0,600,400);
		ctx.fillStyle = "rgba(180,124, 20, 0.8)"; 
		ctx.beginPath();
		ctx.arc(x,y,20,0,2*Math.PI,false)
		ctx.fill();
		ctx.closePath();
	}  
}

function Bille(){
	this.x=(Math.floor(Math.random()*580))+10;
	this.y=(Math.floor(Math.random()*380))+10;
}
Bille.prototype.bouge=function(){
	this.x=(Math.floor(Math.random()*580))+10;
	this.y=(Math.floor(Math.random()*380))+10;
}

function Modele(parent){
	this.parent=parent;
	this.billes=[new Bille()];
}


function Controleur(){
	this.vue=new Vue(this);
	this.modele=new Modele(this);
	this.vue.affiche(this.modele.billes[0].x,this.modele.billes[0].y);
}
Controleur.prototype.bouger = function() {  
  this.modele.billes[0].bouge();
  this.vue.affiche(this.modele.billes[0].x,this.modele.billes[0].y);
};
// fonctions du controleur qui appellent les fonctions generiques des cookies (voir en haut)
Controleur.prototype.ecrisBiscuit = function() {  
		c=prompt("Quel cookie?");
		if (c!=""){
			v=prompt("Quelle valeur?");
			if (v!=""){
				d=prompt("Quelle duree?","0");
				if (d!=""){
					d=parseInt(d);
				}else{
					d=0;
				}
				// demande un cookie du nom de p, valeur v, et duree d 
				//si d == 0 alors le cookie est efface a la fermeture de la page
				creeCookie(c,v,d);
			}
		}
	};
Controleur.prototype.lisBiscuit = function() {  
	p=prompt("Lire quel cookie?");
	if (p!=""){
		alert(lisCookie(p));
	}
};
Controleur.prototype.effaceBiscuit = function() {  
	p=prompt("Lire quel cookie?");
	if (p!=""){
		alert(effaceCookie(p));
	}
};

function demarreJeu(){
	if (controleur==""){
		controleur= new Controleur();
	}else{
		alert("Heu, c'est que j'existe déjà!");
	}
}

var controleur="";

