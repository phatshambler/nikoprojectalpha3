options = "";

window.onload = function () {
    options = new Options();
    
    options.lisMultipleCookies();
    options.creeMenu();
}

function Options(){
    this.masterkookie = { "Vitesse": 5, "Balles": 1, "Multiplicateur": 1, "Vies": 3 };
    if (!this.testMissingCookies) {
        this.creeBaseCookies();

    }

    //this.currentkookie = { "Vitesse" : 5, "Balles" : 1, "Multiplicateur" : 1, "Vies" : 3};
}


Options.prototype.lisMultipleCookies = function(){
    for (key in this.masterkookie){
        var i = lisCookie(key);
        if(i != null){
            this.masterkookie[key] = i;
        }
    }

}

Options.prototype.testMissingCookies = function () {
    for (key in this.masterkookie) {
        var i = lisCookie(key);
        if (i == null) {
            return false;
        }
    }
    return true;
}


Options.prototype.creeBaseCookies = function(){
    for(key in this.masterkookie){
        creeCookie(key, this.masterkookie[key]);
    }

}

Options.prototype.creeMenu = function () {
    var div = document.getElementById("divoptions");
    for (key in this.masterkookie) {

        div.innerHTML = div.innerHTML + "<p>" + key + " : " + this.masterkookie[key] + "</p>" + "<span class='xbold' onclick=options.add('" + key + "')> +</span>   <span>&#160;</span>    <span class='xbold' onclick=options.remove('" + key + "')> - </span>";
    }
}

Options.prototype.clean = function(){
    var div = document.getElementById("divoptions");
    div.innerHTML = "<p class='bold'>Options</p>";
}

Options.prototype.add = function (key) {
    console.log(key);

    if (parseInt(this.masterkookie[key]) < 10) {
        this.masterkookie[key] = parseInt(this.masterkookie[key]) + 1;
    }
    this.clean();
    this.creeMenu();
}

Options.prototype.remove = function (key) {
    console.log(key);

    if (parseInt(this.masterkookie[key]) > 1) {
        this.masterkookie[key] = parseInt(this.masterkookie[key]) - 1;
    }

    this.clean();
    this.creeMenu();
}


