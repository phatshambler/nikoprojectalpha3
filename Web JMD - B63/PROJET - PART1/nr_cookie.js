/*	Nicolas Roy-Bourdages - 2011
*	Web avancé phase 1 - Space shooter
*/	

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