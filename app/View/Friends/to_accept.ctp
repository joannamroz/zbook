<?php //pr($friends);?>

<h3>Requests</h3>
<div class="containerFriendLinks">
	<span ><strong><?php echo $this->Html->link(' your friends ',array('controller'=>'friends','action'=>'friend_list'),array('class' => 'friendsLinks')
					);?> | <?php echo $this->Html->link(' invitations ', array('controller'=>'friends', 'action'=>'to_accept'),array('class' => 'friendsLinks','id' =>'invitations'));?></strong></span>
</div>
<hr/>
<div class="friendsContainer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6 col-md-8">
			<?php  foreach ($friends as $friend): ?>
			  <div class="row friends">
			    <div class="col-xs-6 col-md-2"><?php echo $this->Html->image($friend['Sender']['avatar'], array('class'=>'friendImage'));?></div>
				<div class="col-xs-6 col-md-5 friendName"><strong><?php echo $this->Html->link($friend['Sender']['fullname'], array('controller'=>'users', 'action'=>'view_user', $friend['Sender']['id']));?></strong></div>
				<div class="col-xs-6 col-md-5"><div class="friendName"><button class="confirmBtn" id="addFriendBtn">Confirm</button><button class="confirmBtn" id="deleteRequestBtn">Delete request</button></div></div>
			  </div>
			<?php endforeach; ?>	
			</div>
			<div class="col-xs-6 col-md-4"></div>
		</div>
	</div>
			
</div>