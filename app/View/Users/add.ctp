
<h3>Register now</h3>

<?php echo $this->Form->create('User', array(
                                            'class'=>'form-horizontal'
                                            
                              ));?>
<div class="form-group">
    <label for="inputFullname" class="col-sm-2 control-label">Fullname</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('fullname', array('class' => 'form-control',
            'label'=>false,
            'div'=>false
        ));?>
    </div>
</div>
<div class="form-group">
    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('email', array('class' => 'form-control',
            'label'=>false,
            'div'=>false
        ));?>
    </div>
</div>
<div class="form-group">
    <label for="inputUsername" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('username', array('class' => 'form-control',
            'label'=>false,
            'div'=>false
        ));?>
    </div>
</div>
<div class="form-group">
    <label for="inputDateOfBirth" class="col-sm-2 control-label">Date of birth</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('date_of_birth', array('class' => 'form-control date_of_birth',
            'dateFormat' => 'DMY',
            'minYear' => date('Y') - 90,
            'maxYear' => date('Y') - 18,
            'label'=>false,
            'div'=>false         
        ));?>
    </div>
</div>
<div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('password', array('class' => 'form-control',
            'label'=>false,
            'div'=>false,
            'type'=>'password'
        ));?>
    </div>
</div>
<div class="form-group">
    <label for="inputPassword2" class="col-sm-2 control-label">Repeat password</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('password', array('class' => 'form-control',
            'label'=>false,
            'div'=>false,
            'type'=>'password'
        ));?>
    </div>
</div>
<div class="form-group">
    <label for="inputGender" class="col-sm-2 control-label">Gender</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('gender', array('class' => 'form-control',
            'label'=>false,
            'div'=>false,
            'options' => array('male'=>'Male','female'=>'Female')
        ));?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Register</button>
    </div>
</div>
