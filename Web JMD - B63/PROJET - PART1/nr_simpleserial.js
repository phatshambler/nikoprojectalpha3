/*	Nicolas Roy-Bourdages - 2011
*	Web avancé phase 1 - Space shooter
*/	

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
	
	if(raw != "" && raw != null){
		var protoship = controleur.modele.ship.__proto__;
		raw["ship"].__proto__ = protoship;
	
		controleur.modele = new Modele(raw["ship"]);
		constants = new Constants(constants.MAX_X, constants.MAX_Y);
		//constants = defaultconstants;
		setSize();
		
		controleur.date = new Date();
		controleur.startTime = controleur.date.getTime();
		
		controleur.frequencyP = 1;
		controleur.frequencyE = 1;
		
		controleur.frame = parseInt(raw["phase"]) * 1000 + 1;
		controleur.phase = 0;
	
	
	for (var i = 0; i < parseInt(raw["phase"]); i++){
		controleur.phasedeux();
	}
	}
	
	
	controleur.display = true;
	
}



