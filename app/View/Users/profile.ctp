<?php 
//pr($user_id);?>

<?php //pr($user_message);?>
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



<!-- <div id='messageContainer'>
	<div class='messageBox'>
		<div class='messageIcon'><div class='messageIconBig'></div></div>
		<div class='messageBoxText'>Message box:</div>
	</div>
	<?php  //foreach ($user_message as $message): ?>
		<div class='singleMessage'>				
	        <div class='messageContainerAvatar'><?php //echo $this->Html->image($message['Sender']['avatar'],array('class'=>'userMessageImg')); ?></div>
	        <div class='messageContainerContent'>
	        	<div class='messageContainerSender'><?php //echo ucfirst($message['Sender']['username']); ?>
	        	</div>
	        	<?php //$message=ucfirst($message['Message']['body']) ?>
	        	<div class='senderContent'><?php //echo String::truncate($message,22,array('ellipsis' => ' [Read more]','exact' => false)); ?>
	        	</div>
	        	<div class='senderContentLonger'><?php //echo h($message); ?>
	        	</div>
	        </div>
	        <div class='messageContainerAnswer'><div class='messageIconAnswer'><i class="fa fa-share fa-2x"></i></div></div>	        	        
	</div>
	<?php //endforeach; ?>
</div>
 -->
