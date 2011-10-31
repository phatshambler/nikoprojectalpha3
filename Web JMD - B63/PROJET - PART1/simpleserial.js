function SimpleSerial(){

}

SimpleSerial.prototype.saveState = function(){
	controleur.display = false;
	//var blue = JSON.decycle(controleur);
	var green = JSON.stringify(controleur);
	
	console.log(green);
	
	creeCookie("state" + controleur.saveSlot, green);
	
	
	controleur.display = true;
}

SimpleSerial.prototype.loadState = function(){
	controleur.display = false;
	
	var red = lisCookie("state" + controleur.saveSlot);
	//var raw = JSON.retrocycle();
	var raw = JSON.parse(red)
	
	var protoship = controleur.modele.ship.__proto__;
	raw["ship"].__proto__ = protoship;
	
	controleur.modele = new Modele(raw["ship"]);
	var k = new Constants(constants.MAX_X, constants.MAX_Y);
	constants = k;
	controleur.frame = parseInt(raw["phase"]) * 1000 + 1;
	
	//controleur.phase = parseInt(raw["phase"]);
	
	for (var i = 0; i < parseInt(raw["phase"]); i++){
		controleur.phasedeux();
	}
	
	
	
	controleur.display = true;
	
}



