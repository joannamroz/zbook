<?php 
//pr($user_id);?>
<?php 
//pr($user_data);?>
<p><?php echo 'Username: '. $user_data['User']['username']?></p>
<p><?php echo 'Fullname: '.$user_data['User']['fullname']?></p>
<p><?php echo 'Profile photo: '.$this->Html->image($user_data['User']['avatar'], array('class'=>'user_img'))?></p>