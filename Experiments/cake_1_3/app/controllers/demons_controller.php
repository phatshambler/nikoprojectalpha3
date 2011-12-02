<?php
class DemonsController extends AppController {
	var $helpers = array ('Html','Form');
	var $name = 'Demons';
	var $components = array('Session');
	
	function index() {
		$this->set('demons', $this->Demon->find('all'));
	}
	function view($id = null) {        
		$this->Demon->id = $id;        
		$this->set('demon', $this->Demon->read());    
	}
	
	function add() {        
	if (!empty($this->data)) {            
		if ($this->Demon->save($this->data)) {  
			$this->Session->setFlash('Your post has been saved.');
			$this->redirect(array('action' => 'index'));
            }        
		}    
	}
	function delete($id) {
	if ($this->Demon->delete($id)) {
		$this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
		$this->redirect(array('action' => 'index'));
	}
	}
	function edit($id = null) {
	$this->Demon->id = $id;
	if (empty($this->data)) {
		$this->data = $this->Demon->read();
	} else {
		if ($this->Demon->save($this->data)) {
			$this->Session->setFlash('Your post has been updated.');
			$this->redirect(array('action' => 'index'));
		}
	}
}

}


?>