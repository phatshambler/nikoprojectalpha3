function EnemyA(x,y){
	
	this.x = x;
	this.y = y;

}

EnemyA.prototype = new MetaObject(300, 10, "rgba(180,124, 20, 0.8)", 2);
EnemyA.constructor = EnemyA;


function EnemyB(x,y){
	this.x = x;
	this.y = y;
}

EnemyB.prototype = new MetaObject(200, 10, "rgba(125,125,250,0.9)", 3);
EnemyB.constructor = EnemyB;
