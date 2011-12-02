function request04(f){

var xhr_object = null;

if(window.XMLHttpRequest) // Firefox
   xhr_object = new XMLHttpRequest();
else if(window.ActiveXObject) // Internet Explorer
   xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
else { // XMLHttpRequest non supporté par le navigateur
   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
   return;
}

var method   = "POST";
var filename = "strings2.php";
var s1       = f.elements["string1"].value;
var s2       = f.elements["string2"].value;
var data     = null;

if(s1 != "" && s2 != "")
   data = "s1="+s1+"&s2="+s2;

if(method == "GET" && data != null) {
   filename += "?"+data;
   data      = null;
}

xhr_object.open(method, filename, true);

xhr_object.onreadystatechange = function() {
   if(xhr_object.readyState == 4) {
      var tmp = xhr_object.responseText.split(":");
      if(typeof(tmp[1]) != "undefined") {
         f.elements["string1_r"].value = tmp[1];
         f.elements["string2_r"].value = tmp[2];
      }
      alert(tmp[0]);
   }
}

if(method == "POST")
   xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

xhr_object.send(data);
}