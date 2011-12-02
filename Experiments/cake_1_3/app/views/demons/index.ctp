<!-- File: /app/views/posts/index.ctp -->

<h1>Blog posts</h1>
<?php echo $this->Html->link('Add Demon', array('controller' => 'demons', 'action' => 'add')); ?>
<table>
	<tr>
		<th>Id</th>
		<th>Title</th>
		<th>Delete</th>
		<th>Data</th>
		<th>Created</th>
		<th>Edit</th>
	</tr>

	<!-- Here is where we loop through our $posts array, printing out post info -->

	<?php foreach ($demons as $post): ?>
	<tr>
		<td><?php echo $post['Demon']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($post['Demon']['nom'], 
array('controller' => 'demons', 'action' => 'view', $post['Demon']['id'])); ?>
		</td>
		<td>        <?php echo $this->Html->link('Delete', array('action' => 'delete', $post['Demon']['id']), null, 'Are you sure?')?>        </td>
		<td><?php echo $post['Demon']['data']; ?>
		<td><?php echo $post['Demon']['created']; ?>
		<td><?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Demon']['id']));?></td>
		</td>
		  
	</tr>
	<?php endforeach; ?>

</table>