<?php //pr($messages);?>
<?php 
//foreach($messages as $message) { ?>
	
<?php 
//} ?>
<div class="conversationView">
	<div class="messagesForm">
	<?php echo $this->Form->create('Message'); ?>
		<fieldset >
		<?php
			echo $this->Form->input('body', array(
				'div'=>false,
				'label'=>false,
				'id'=>'msgBodyInput',
				'placeholder'=>'Message: '));
			// echo $this->Form->input('id', array('type' => 'hidden'));
			echo $this->Form->input('recipient_id', array('type' => 'hidden', 'value'=>$recipient_id));
			// echo $this->Form->input('sender_id', array('type' => 'hidden'));
			
		?>
		<button type="button" class="btn btn-default" id="messageButton" style="margin-left:15px">Send message</button> 
		 <?php echo $this->Form->end(); ?>
		</fieldset>
		
	</div>
	<div class="allConversation" id="singleConversation">
		<?php
			
		foreach($messages as $message) : ?>
			<?php 
			if($message['Sender']['id']==AuthComponent::user('id')) { ?>
				<div class="mineMessage">
					<div class="fullnameCreated">
						<div class="fullnameMsg">
							<p><strong><?php echo h($message['Sender']['fullname']);?></strong><span class="greySpan"><?php echo " (".h($message['Sender']['username']).")";?></span></p>
						</div>
						<div class="createdMsg">
							<p><?php echo  $message['Message']['created']?></p>
						</div>
					</div>
					<div class="contentMsg">
					<p><?php echo h($message['Message']['body']);?></p>
					</div>
				</div>
			<?php
			} else { ?>
				<div class="strangeMessage">
					<div class="fullnameCreated">
						<div class="fullnameMsg">
							<p><strong><?php echo h($message['Sender']['fullname']);?></strong><span class="greySpan"><?php echo " (".h($message['Sender']['username']).")";?></span></p>
						</div>
						<div class="createdMsg">
							<p><?php echo  $message['Message']['created']?></p>
						</div>
					</div>
					<div class="contentMsg">
					<p><?php echo h($message['Message']['body']);?></p>
					</div>
				</div>
			<?php	} ?>

		<?php endforeach;?> 
		 <span class="clear"></span>
	</div>

</div>

