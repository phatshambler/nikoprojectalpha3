function EnemyA(x,y){
	
	this.x = x;
	this.y = y;

}

EnemyA.prototype = new MetaObject(300, 10, "rgba(125,250,200,0.9)", 3);
EnemyA.constructor = EnemyA;


function EnemyB(x,y){
	this.x = x;
	this.y = y;
}

EnemyB.prototype = new MetaObject(200, 10, "rgba(125,250,250,0.9)", 5);
EnemyB.constructor = EnemyB;


function EnemyC(x,y){
	this.x = x;
	this.y = y;
}

EnemyC.prototype = new MetaObject(200, 10, "rgba(10,125,250,0.9)", 4);
EnemyC.constructor = EnemyC;