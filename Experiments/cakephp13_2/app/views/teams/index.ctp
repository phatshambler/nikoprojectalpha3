<h1>TEAMS!</h1>
<?php echo $this->Html->link('Add team', array('controller' => 'teams', 'action' => 'add')); ?>
<table>
	<tr>
		<th>Id</th>
		<th>Equipe</th>
		<th>Responsable</th>
		<th>Telephone</th>
		<th>Paye?</th>
	</tr>

	<!-- Here is where we loop through our $teams array, printing out team info -->

	<?php foreach ($teams as $team): ?>
	<tr>
		<td><?php echo $team['Team']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($team['Team']['equipe'], 
array('controller' => 'teams', 'action' => 'view', $team['Team']['id'])); ?>
		</td>
		<td><?php echo $team['Team']['resp']; ?></td>
		<td><?php echo $team['Team']['notel']; ?></td>
		<td><?php echo $team['Team']['paye']; ?></td>
	</tr>
	<?php endforeach; ?>

</table>

<?php echo $this->Html->link('Special view!', array('controller' => 'teams', 'action' => 'special')); ?>

<?php echo $this->Html->link('Retour', array('controller' => 'teams', 'action' => 'index')); ?>