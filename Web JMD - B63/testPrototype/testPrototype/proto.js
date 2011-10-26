
function Forme(options) {
    this.couleur = options["couleur"]|| "mauve";
    this.posX = options["posX"] || 0;
    this.posY = options["posY"] || 0;
    this.vitesse = options["vitesse"] || 0;
}
Forme.prototype.getVitesse=function(){
	return this.vitesse*this.vitesse;
	
}
Forme.prototype.getCouleur=function(){
	return this.couleur;
}

function Joueur(options) {
    this.taille = options["taille"];
    this.vies = options["vies"];
    this.direction = options["direction"];
    this.posX = options["posX"] || this.posX;
   
}
Joueur.prototype = new Forme({"couleur":"red", "posX":250,"posY":550,"vitesse":10});
Joueur.prototype.constructor = Joueur;

function AutreJoueur(options) {
    this.taille = options["taille"];
    this.vies = options["vies"];
    this.direction = options["direction"];
}
AutreJoueur.prototype = new Forme({"couleur":"yellow", "posX":250,"posY":550,"vitesse":10});
AutreJoueur.prototype.constructor = AutreJoueur;
AutreJoueur.prototype.getVitesse=function(){
	return this.vitesse/2;
}

function test(){
	var j1=new Joueur({"taille":6,"vies":5,"direction":4});
	var j2=new Joueur({"taille":60,"vies":50,"direction":40,"posX":3000});
	var j3=new AutreJoueur({"taille":600,"vies":500,"direction":400});
	alert("J1 couleur posX et vitesse "+j1.getCouleur()+", "+j1.posX+", "+j1.getVitesse());
	alert("J2 couleur posX et vitesse "+j2.getCouleur()+", "+j2.posX+", "+j2.getVitesse());
	alert("J3 couleur posX et vitesse "+j3.getCouleur()+", "+j3.posX+", "+j3.getVitesse());

	var j4=new Forme({"posX":-1000,"posY":500,"vitesse":400000000});
	alert("J4 couleur posX et vitesse "+j4.getCouleur()+", "+j4.posX+", "+j4.getVitesse());

}