<h1>
<?php echo $team['Team']['id']?></h1>
<p><small>Created: 
<?php echo $team['Team']['equipe']?>
</small></p><p><?php echo $team['Team']['resp']?>
</p>

<?php echo $this->Html->link('Retour', array('controller' => 'teams', 'action' => 'index')); ?>