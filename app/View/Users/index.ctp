<h2>Users:</h2>

<div class="list-group">
	<?php $lp=1; ?>
	<?php  foreach ($users as $user ) :  ?>
	<?php echo $this->Html->link($lp.'. '.$user['User']['fullname'].'  ('.$user['User']['username'].')', array('controller'=>'users','action'=>'view_user', $user['User']['id']),array('class' => 'list-group-item'));?> 
	<?php $lp++; 
 	endforeach; ?>
</div>
