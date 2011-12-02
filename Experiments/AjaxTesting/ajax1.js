function ajax()
{
    var xhr=null;
    
    if (window.XMLHttpRequest) { 
        xhr = new XMLHttpRequest();
    }
  
    //on d�finit l'appel de la fonction au retour serveur
    xhr.onreadystatechange = function() { alert_ajax(xhr); };
    
    //on appelle le fichier reponse.txt
    xhr.open("GET", "reponse.xml", true);
    xhr.send(null);
}

function alert_ajax(xhr)
{
	var docXML= xhr.responseXML;
	var items = docXML.getElementsByTagName("donnee")
	//on fait juste une boucle sur chaque �l�ment "donnee" trouv�
	for (i=0;i<items.length;i++)
	{
		alert (items.item(i).firstChild.data);
	}
}