var currentuser = "";

function updateUser()
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
	//console.log(xmlhttp.responseText);
	currentuser = xmlhttp.responseText;
	
	//controleur.listemulti = liste;
    }
  }
  
xmlhttp.open("POST", "getuser.php",true);
/* Effectue la requête en envoyant les données : */
xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
xmlhttp.send("var1=0");
}