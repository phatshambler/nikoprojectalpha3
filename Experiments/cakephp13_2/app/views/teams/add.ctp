<!-- File: /app/views/posts/add.ctp -->	
	
<h1>Add Post</h1>
<?php
echo $this->Form->create('Team');
echo $this->Form->input('equipe');
echo $this->Form->input('resp');
echo $this->Form->input('notel');
echo $this->Form->input('paye');
echo $this->Form->end('Save Post');
?>

<?php echo $this->Html->link('Retour', array('controller' => 'teams', 'action' => 'index')); ?>