<?php //pr($messages) ;?>
<?php //pr($recipient);?>

<div class="conversationView">
	
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
