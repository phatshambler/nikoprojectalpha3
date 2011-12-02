<!-- File: /app/views/posts/add.ctp -->	
	
<h1>Add Post</h1>
<?php
echo $this->Form->create('Demon');
//echo $this->Form->input('id');
//echo $this->Form->input('id');
//echo "chat";
echo $this->Form->input('nom');
echo $this->Form->input('data', array('rows' => '4'));
echo $this->Form->end('Save Post');
?>