<div>
	<div style="float:right"><?php echo $this->Html->image($user_info['User']['avatar'], array('class'=>'avatar_img'));?></div>
</div>
<br>
<div style="float:right">
	<p><strong> <?php echo h($user_info['User']['username']); ?></strong></p>
</div>
<br>
<div style="clear:both">
	<p><?php echo h($user_info['User']['fullname']);?></p>
</div>
<!-- <div class="messageFormContainer"> -->
<?php
echo $this->Form->create('Message');
echo $this->Form->input('body', array(
	'div'=>false,
	'label'=>false,
	'type' => 'textarea'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('recipient_id', array('type' => 'hidden'));
echo $this->Form->input('sender_id', array('type' => 'hidden'));
echo $this->Form->end('Send message');
?>
<!-- </div> -->


