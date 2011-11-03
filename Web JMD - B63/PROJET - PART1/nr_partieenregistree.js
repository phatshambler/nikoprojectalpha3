/*	Nicolas Roy-Bourdages - 2011
*	Web avancé phase 1 - Space shooter
*/	

ss = "";

window.onload = function () {
    ss = new Savedgames();
    console.log("kill");
    ss.read();
    ss.creeMenu();
}

function Savedgames(){

	this.savegamekookie = {};

}

Savedgames.prototype.creeMenu = function () {
    var div = document.getElementById("parties");
    for (key in this.savegamekookie) {
		var link = "jeu.html?game=" + key
        div.innerHTML = div.innerHTML + "<p><a href=\'" + link + "\'>" + key + " : " + this.savegamekookie[key] + "</a></p>";
    }
}

Savedgames.prototype.read = function(){

	for (var i = 0; i < 60; i++){
	
			var k = lisCookie("state"+i);
			if(k != null){
				var text = JSON.parse(k);
				this.savegamekookie["state"+i] = ".... Phase = " + text["phase"] + " Score = " + text["ship"].hiscore;
			}
		console.log(i);
		
	}


}

