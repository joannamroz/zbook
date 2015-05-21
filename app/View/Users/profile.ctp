
<div style="float:left; margin-top:20px">
<p><?php echo $this->Html->image($user_data['User']['avatar'], array('class'=>'user_img'))?></p>
<p><?php echo 'Username: '. h($user_data['User']['username'])?></p>
<p><?php echo 'Fullname: '.h($user_data['User']['fullname'])?></p>


<p><?php echo $this->Html->link('Change avatar',array(
						'controller' => 'users', 'action' => 'edit_avatar', $user_data['User']['id']),
					    array(
					    	'class'=>'btn btn-default changeAvatar')
					    ); ?></p>
</div>
