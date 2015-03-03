<!-- div class="conversationView" id="conversationContainer">
	<div class="allConversation" > -->
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
<!-- 	</div>
</div> -->
		