<?php

class Team extends AppModel {
    var $name = 'team';
	
	var $validate = array(
	'equipe' => array(            
		'rule' => 'notEmpty'
		),        
	'resp' => array(
		'rule' => 'notEmpty'
		),
	'notel' => array(
		'rule' => 'notEmpty'
		),
	'paye' => array(
		'rule' => 'notEmpty'
		)
	);
}

?>