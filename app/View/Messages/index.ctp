<?php //pr($messages);?>
<div id='messageContainer'>
	<div class='messageBox'>
		<div class='messageIcon'><div class='messageIconBig'></div></div>
		<div class='messageBoxText'>Your chats:</div>
	</div>
	<?php  foreach ($messages as $message): ?>
		<div class='singleMessage'>	
		<?php 	

			if($message['Message']['recipient_id']==AuthComponent::user('id'))	{ ?>
				<div class='messageContainerAvatar'><?php echo $this->Html->image($message['Sender']['avatar'],array('class'=>'userMessageImg')); ?></div>
	        <div class='messageContainerContent'>
	        	<div class='messageContainerSender'><?php echo ucfirst($message['Sender']['username']); ?>
	        	</div>
	        	<?php $msg=ucfirst($message['Message']['body']) ?>
	        	<div class='senderContent'><?php echo String::truncate(
    $msg,22,array('ellipsis' => ' [Read more]','exact' => false)); ?>
	        	</div>
	        	<div class='senderContentLonger'><?php echo $this->Html->link(h($msg),array('controller'=>'messages','action'=>'conversations',$message['Message']['sender_id'])); ?>
	        	</div>
	        </div>
	        <div class='messageContainerAnswer'><div class='messageIconAnswer'><i class="fa fa-share fa-2x"></i></div></div>
	        <?php
			} else { ?>
				<div class='messageContainerAvatar'><?php echo $this->Html->image($message['Recipient']['avatar'],array('class'=>'userMessageImg')); ?></div>
	        <div class='messageContainerContent'>
	        	<div class='messageContainerSender'><?php echo ucfirst($message['Recipient']['username']); ?>
	        	</div>
	        	<?php $msg=ucfirst($message['Message']['body']) ?>
	        	<div class='senderContent'><?php echo String::truncate(
    $msg,22,array('ellipsis' => ' [Read more]','exact' => false)); ?>
	        	</div>
	        	<div class='senderContentLonger'><?php echo $this->Html->link(h($msg),array('controller'=>'messages','action'=>'conversations',$message['Message']['recipient_id'])); ?>
	        	</div>
	        </div>
	        <div class='messageContainerAnswer'><div class='messageIconAnswer'><?php echo $this->Html->link('<i class="fa fa-share fa-2x"></i>',array('controller'=>'messages','action'=>'conversations',$message['Message']['recipient_id']),array('escape'=>false)); ?></div></div>
	        <?php 
			} ?>
	        	        	        
	</div>
	<?php endforeach; ?>
</div>


