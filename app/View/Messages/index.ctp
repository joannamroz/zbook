<?php //pr($messages);?>
<div class="container">
  <div class="row">

	<div class="col-md-6">
		<div id='messageContainer'>
			<div class='messageBox'>
				<div class='messageIcon'><div class='messageIconBig'></div></div>
				<div class='messageBoxText'>Your chats:</div>
			</div>
			<?php  foreach ($messages as $message): ?>
				<?php if($message['Message']['recipient_id']==AuthComponent::user('id')){

						$id_user_oposite=$message['Message']['sender_id'];
					} else { 
						$id_user_oposite=$message['Message']['recipient_id'];
					
					} ?>
			<div class="singleMessage" data-recipient-id="<?php echo $id_user_oposite ;?>"> 
			<?php 	

				if($message['Message']['recipient_id']==AuthComponent::user('id'))	{ ?>
					<div class='messageContainerAvatar'><?php echo $this->Html->image($message['Sender']['avatar'],array('class'=>'userMessageImg')); ?></div>
		        <div class='messageContainerContent'>
		        	<div class='messageContainerSender'><?php echo ucfirst(h($message['Sender']['username'])); ?>
		        	</div>
		        	<?php $msg=ucfirst(h($message['Message']['body'])) ?>
		        	<?php if ($message['Message']['is_read']==0) { ?>
		        		<div class='senderContent not_read'>
						<?php echo String::truncate($msg,20,array('ellipsis' => '[ ...more]','exact' => false)); ?>
						</div>
					<?php 
		        	} else { ?>
		        		<div class='senderContent'>
						<?php echo String::truncate($msg,20,array('ellipsis' => '[ ...more]','exact' => false)); ?>
						</div>
		        	<?php } ?>
		        	<div class='senderContentLonger'><?php echo h($msg); ?>
		        	</div>
		        </div>
		      		    
		        <?php
				} else { ?>
					<div class='messageContainerAvatar'><?php echo $this->Html->image($message['Recipient']['avatar'],array('class'=>'userMessageImg')); ?></div>
		        <div class='messageContainerContent'>
		        	<div class='messageContainerSender'><?php echo ucfirst(h($message['Recipient']['username'])); ?>
		        	</div>
		        	<?php $msg=ucfirst(h($message['Message']['body'])) ?>
		        	<div class='senderContent'><?php echo String::truncate(
	    $msg,20,array('ellipsis' => ' [ ...more]','exact' => false)); ?>
		        	</div>
		        	<div class='senderContentLonger'><?php echo h($msg); ?>
		        	</div>
		        </div>
		        
		        <?php 
				} ?>
        	        	        
			</div> <!-- singleMessage -->
	<?php endforeach; ?>
		</div> <!-- messageContainer -->

	</div> <!-- col-md-4 -->

  	<div class="col-md-6">
  		<div class="messagesForm">
		<?php echo $this->Form->create('Message'); ?>
			<fieldset >
			<?php
				echo $this->Form->input('body', array(
					'div'=>false,
					'label'=>false,
					'id'=>'msgBodyInput',
					'placeholder'=>'Message: ',
					'type' => 'textarea'));
				// echo $this->Form->input('id', array('type' => 'hidden'));
				echo $this->Form->input('recipient_id', array('type' => 'hidden'));
				// echo $this->Form->input('sender_id', array('type' => 'hidden'));
				
			?>
			<button type="button" class="btn btn-default" id="messageButton" style="margin-left:15px">Send message</button> 
			 <?php echo $this->Form->end(); ?>
			</fieldset>
		
		</div> <!-- messagesForm -->

		<div id='zbiornik_na_kontent_z_ajaxa'> </div>

	</div> <!-- col-md-8 -->

  </div> <!-- row -->
</div> <!-- container -->





