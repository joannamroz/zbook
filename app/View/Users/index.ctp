<h2>Users:</h2>
<?php //pr($users);?>
<div class="list-group">
	<?php $lp=1; ?>
	<?php  foreach ($users as $user ) :  
		if($user['User']['id']!=AuthComponent::user('id')) { ?>	
		<?php echo $this->Html->link($lp.'. '.$user['User']['fullname'].'  ('.$user['User']['username'].')', array('controller'=>'users','action'=>'view_user', $user['User']['id']),array('class' => 'list-group-item'));?> 
		<?php $lp++; 
		}
 	endforeach; ?>
</div>
