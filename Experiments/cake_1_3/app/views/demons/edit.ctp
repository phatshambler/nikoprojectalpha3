<!-- File: /app/views/posts/edit.ctp -->
	
<h1>Edit Post</h1>
<?php
	echo $this->Form->create('Demon', array('action' => 'edit'));
	echo $this->Form->input('nom');
	echo $this->Form->input('data', array('rows' => '3'));
	echo $this->Form->input('id', array('type' => 'hidden')); 
	echo $this->Form->end('Save Post');
?>
