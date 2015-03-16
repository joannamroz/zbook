<?php //pr($friendsAccepted);?>

<h3 id="headerFriends">Invitations</h3>
<div class="containerFriendLinks" >
	<span ><strong><?php echo $this->Html->tag('span ', 'your friends', array('class' => 'friendsLinks','id' =>'friends'));?> | <?php echo $this->Html->tag('span ', 'invitations', array('class' => 'friendsLinks','id' =>'invitations'));?></strong></span>
</div>
<hr/>
<div class="friendsContainer" id="friendsList" style="display:none">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6 col-md-8">
			<?php  foreach ($friendsAccepted as $friendAccepted): ?>
			
			  <div class="row friends" id="singleFriendInfo">
			    <div class="col-xs-6 col-md-2"><?php echo $this->Html->image($friendAccepted['Sender']['avatar'], array('class'=>'friendImage'));?></div>
				<div class="col-xs-6 col-md-5 friendName"><strong><?php echo $this->Html->link($friendAccepted['Sender']['fullname'], array('controller'=>'users', 'action'=>'view_user', $friendAccepted['Sender']['id']));?></strong></div>
				<div class="col-xs-6 col-md-5"><div class="friendName"><button class="confirmBtn removeFriend" id="deleteFromFriendsBtn" data-sender-id="<?php echo $friendAccepted['Sender']['id']; ?>">Remove from friends</button></div></div>
			  </div>
			<?php endforeach; ?>	
			</div>
			<div class="col-xs-6 col-md-4"></div>
		</div>
	</div>
			
</div>
<div class="friendsContainer" id="invitationsList"  >
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6 col-md-8" >
			<?php  foreach ($friendsInvitations as $friendInvitations): ?>
			  <div class="row friends" id="singleFriendInvitation">
			    <div class="col-xs-6 col-md-2"><?php echo $this->Html->image($friendInvitations['Sender']['avatar'], array('class'=>'friendImage'));?></div>
				<div class="col-xs-6 col-md-5 friendName"><strong><?php echo $this->Html->link($friendInvitations['Sender']['fullname'], array('controller'=>'users', 'action'=>'view_user', $friendInvitations['Sender']['id']));?></strong></div>
				<div class="col-xs-6 col-md-5"><div class="friendName"><button class="confirmBtn confirmFriend" id="confirmFriendBtn" data-sender-id="<?php echo $friendInvitations['Sender']['id']; ?>">Confirm</button><button class="confirmBtn deleteRequest" id='deleteRequestBtn' data-sender-id="<?php echo $friendInvitations['Sender']['id']; ?>">Delete request</button></div></div>
			  </div>
			<?php endforeach; ?>	
			</div>
			<div class="col-xs-6 col-md-4"></div>
		</div>
	</div>
			
</div>