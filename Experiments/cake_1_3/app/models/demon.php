<?php

class Demon extends AppModel {
    var $name = 'Demon';
	
	var $validate = array( 
		
		'nom' => array( 'rule' => 'notEmpty'        ),
        'data' => array( 'rule' => 'notEmpty'        )
		);
}

?>