
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
Controleur.prototype.bouger = function()  
{  
  this.modele.billes[0].bouge();
  this.vue.affiche(this.modele.billes[0].x,this.modele.billes[0].y);
};

function demarreJeu(){
	if (controleur==""){
		controleur= new Controleur();
		alert("Voici votre nouveau Controleur "+controleur);
	}else{
		alert("Heu, c'est que j'existe déjà!");
	}
}

controleur="";
