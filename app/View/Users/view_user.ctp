
<?php //pr($user_info['User']['id']) ;?>
<?php //pr($userLibrary[0]);?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="row">	
	  			<div class="col-md-4">
			    	<div id="userPhoto">
						<div><?php echo $this->Html->image($user_info['User']['avatar']);?></div>
						<?php  
						if ($user_info['User']['id']!=AuthComponent::user('id')) {
							 if($isAFriend===0) { ?>
							<div id='newFriend' data-recipient-id="<?php echo $user_info['User']['id'];?>"><strong>Add as a friend</strong></div>
							<?php } else { ?>
							<div  class="friendAdded" ><strong>Friend</strong></div>
							<?php
							} 
						} ?>
					</div>
			    </div>
			    <div class="col-md-8">
					<div class="viewUserInfo">
						<?php echo h($user_info['User']['fullname']);?><span><?php echo '( '.h($user_info['User']['username']).' )'; ?></span>
					</div>
					<?php if ($user_info['User']['id']!=AuthComponent::user('id')) { ?>
					<div class="messageForm" id="msgFormViewUser">
						<?php echo $this->Form->create('Message', array(
						                                            'class'=>'form-horizontal'
						                                            
						                              ));?>
						<div class="form-group">
						    <label for="inputBody" class="col-sm-2 control-label add_author_input"></label>
						    <div class="col-sm-10">
						      <?php echo $this->Form->input('body', array('class' => 'form-control',
						      		'id'=>'messageSend',
						            'label'=>false,
						            'placeholder'=>'Press enter to send a message:',
						            'type' => 'textarea',
						            'div'=>false
						        ));?>
						    </div>
						</div>                             
						<?php
						echo $this->Form->input('id', array('type' => 'hidden'));
						echo $this->Form->input('recipient_id', array('type' => 'hidden', 'value'=>$user_info['User']['id']));
						echo $this->Form->input('sender_id', array('type' => 'hidden'));?>
						<div class="form-group">
						    <div class="col-sm-offset col-sm-10">
						      <button type="submit" class="btn btn-default"><strong>Send</strong></button>
						    </div>
						</div>
					</div> <!-- messageForm -->
					<?php } ?>	
	  			</div> <!-- col=md-8 -->
			</div> <!-- row -->

<div style="margin-top:50px">
<span >
	<strong><?php echo $this->Html->tag('span ', 'Friends', array('class' => 'friendsLinks redLink','id' =>'allFriends'));?> | <?php echo $this->Html->tag('span ', 'Mutual Friends', array('class' => 'friendsLinks','id' =>'mutual'));?>
	</strong>
</span>
</div>
<div class="friendsContainer" id="friendFriends" >
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6 col-md-12">
			<hr>
			<?php  foreach ($userFriends as $userFriend): ?>
				<?php if(AuthComponent::user('id')!=$userFriend['User']['id']) { ?>
						<div class="row friends" id="singleFriendInfo">
		   					<div class="col-xs-6 col-md-2"><?php echo $this->Html->image($userFriend['User']['avatar'], array('class'=>'friendImage'));?>
		   					</div>
							<div class="col-xs-6 col-md-5 friendName"><strong><?php echo $this->Html->link($userFriend['User']['fullname'], array('controller'=>'users', 'action'=>'view_user', $userFriend['User']['id']));?></strong>
							</div>
							<!-- <div class="col-xs-6 col-md-5">
								<div class="friendName"><button class="confirmBtn removeFriend" id="deleteFromFriendsBtn" data-sender-id="<?php //echo $userFriend['User']['id']; ?>">Remove from friends
								</button></div>
							</div>	 -->		
							
		  				</div>
		  			<?php }  
		  		
			endforeach; ?>	
			</div>
			<div class="col-xs-6 col-md-6"></div>
		</div>
	</div>
</div>


<div class="friendsContainer" id="mutualFriends"  style="display:none">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6 col-md-12" >
			<hr>
			<?php  foreach ($mutual as $mutual): 
				if($userFriend['User']['id']!=AuthComponent::user('id')) { ?>
					<div class="row friends" id="singleFriendInvitation">
			   				<div class="col-xs-6 col-md-2"><?php echo $this->Html->image($mutual['User']['avatar'], array('class'=>'friendImage'));?></div>
							<div class="col-xs-6 col-md-5 friendName"><strong><?php echo $this->Html->link($mutual['User']['fullname'], array('controller'=>'users', 'action'=>'view_user', $mutual['User']['id']));?></strong>
							</div>
			  		</div> 
				<?php }								
			endforeach; ?>	
								 
			</div>
			<div class="col-xs-6 col-md-6"></div>
		</div>
	</div>

</div> <!-- friendsContainer -->

		</div>
		<div class="col-md-6">
			<span >
				<strong><?php echo $this->Html->tag('span ', 'Highest rated ', array('class' => 'friendsLinks redLink','id' =>'highestRated'));?> | <?php echo $this->Html->tag('span ', ' All', array('class' => 'friendsLinks','id' =>'allUsersBooks'));?> | <?php echo $this->Html->tag('span','Favourited', array('class'=>'friendsLinks','id'=>'favourited'));?>
				</strong>
			</span>
			<hr>
			<div class="friendsBooks" id="highestNote">
				<?php  
				$licznik=0;
				foreach ($userLibrary as $key => $book) { 
					if($licznik<3) { ?>
						<div class="friendsBooksList">
							<div id="booksCover" ><?php echo $this->Html->image($book['Book']['cover'],array('class'=>'friendImage'));?></div>
							<div id="booksInfo" ><?php echo $book['Book']['title'];
									echo '</br>';
									echo $book['Book']['Author']['fullname'];
									echo '</br>';
									echo $book['Rating']['note'];
									echo '</br>';
									$licznik++; ?>
							</div>
						</div>
					<?php }
				}?>
				
			</div>
			<div class="friendsBooks" id="allFriendsBooks"  style="display:none">
				<?php  
				foreach ($userLibrary as $key => $book) { ?>
					<div class="friendsBooksList">
						<div id="booksCover" ><?php echo $this->Html->image($book['Book']['cover'],array('class'=>'friendImage'));?></div>
						<div id="booksInfo" ><?php echo $book['Book']['title'];
							echo '</br>';
							echo $book['Book']['Author']['fullname'];
							echo '</br>';
							echo $book['Rating']['note'];
							echo '</br>';?>
						</div>
					</div>	 
					<?php } ?>	
			</div>
			<div class="friendsBooks" id="favouritedFriendsBooks"	style="display:none">
			<?php  
				foreach ($userLibrary as $key => $book) {
					if($book['Rating']['favourited']!=0) { ?>
						<div class="friendsBooksList">
							<div id="booksCover" ><?php echo $this->Html->image($book['Book']['cover'],array('class'=>'friendImage'));?></div>
							<div id="booksInfo" ><?php echo $book['Book']['title'];
								echo '</br>';
								echo $book['Book']['Author']['fullname'];
								echo '</br>';
								echo $book['Rating']['note'];
								echo '</br>';?>
							</div>
						</div>	 
					<?php }	
				} ?>
			</div>
		</div>	
	</div>
</div>
