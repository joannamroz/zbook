
<!-- <div class="messageFormContainer"> -->


<!-- </div> -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="messageForm">
				<?php echo $this->Form->create('Message', array(
				                                            'class'=>'form-horizontal'
				                                            
				                              ));?>
				<div class="form-group">
				    <label for="inputTitle" class="col-sm-2 control-label add_author_input"></label>
				    <div class="col-sm-10">
				      <?php echo $this->Form->input('title', array('class' => 'form-control',
				            'label'=>false,
				            'placeholder'=>'Message:',
				            'type' => 'textarea',
				            'div'=>false
				        ));?>
				    </div>
				</div>                             
				<?php
				echo $this->Form->input('id', array('type' => 'hidden'));
				echo $this->Form->input('recipient_id', array('type' => 'hidden'));
				echo $this->Form->input('sender_id', array('type' => 'hidden'));?>
				<div class="form-group">
				    <div class="col-sm-offset col-sm-10">
				      <button type="submit" class="btn btn-default"><strong>Send</strong></button>
				    </div>
				</div>
			</div> <!-- messageForm -->
		</div> <!-- "col-md-6" -->
		<div class="col-md-6">
			<div class="row">
  				<div class="col-md-8">
					<div class="viewUserInfo">
						<h3><?php echo h($user_info['User']['fullname']);?></h3><span><?php echo '( '.h($user_info['User']['username']).' )'; ?></span>
					</div>
  				</div>
  				<div class="col-md-4">
		    		<div id="userPhoto">
						<div><?php echo $this->Html->image($user_info['User']['avatar']);?></div>
						<?php //echo $this->Html->link(
						    // 'Add as a Friend',
						    // array('controller' => 'friends', 'action' => 'addFriend',$user_info['User']['username']),
						    // array('id'=>'newFriend')
						    // ); 

						?>
						<?php if($isAFriend==0) { ?>
						<div id='newFriend' data-recipient-id="<?php echo $user_info['User']['id'];?>"><strong>Add as a friend</strong></div>
						<?php } else { ?>
						<div  class="friendAdded" ><strong>Request sent</strong></div>
						<?php
						} ?>
						
					</div>
		    	</div>
  			</div> <!-- row -->
				  	
	  	</div> <!-- "col-md-6" -->
	</div> <!-- row -->
</div>  <!-- container-fluid -->