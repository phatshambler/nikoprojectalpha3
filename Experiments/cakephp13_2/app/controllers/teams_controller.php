<?php
class TeamsController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'teams';

	function index() {
		$this->set('teams', $this->Team->find('all'));
	}
	
	function view($id = null) {        
		$this->Team->id = $id;
		$this->set('team', $this->Team->read());    }
		
	function add() {        
		if (!empty($this->data)) {
			if ($this->Team->save($this->data)) {
				$this->Session->setFlash('Your post has been saved.');
				
				$this->redirect(array('action' => 'index'));            
			}
			else{
				$this->Session->setFlash('Human Error.');
			}
		}    
	}
	
	function special() {
	
	
	}
}
?>