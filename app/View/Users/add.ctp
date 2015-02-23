<!-- app/View/Users/add.ctp -->
<h3>Register now</h3>
<?php echo $this->Form->create('User', array(
                                            'class'=>'form-horizontal'
                                            
                              ));?>
<?php                              
        echo $this->Form->input('fullname');
        echo $this->Form->input('email');
        echo $this->Form->input('username');
        echo $this->Form->input('date_of_birth', array(
            'dateFormat' => 'DMY',
            'minYear' => date('Y') - 90,
            'maxYear' => date('Y') - 18));
        echo $this->Form->input('password');
        echo $this->Form->input('password2');
        echo $this->Form->input('gender', array(
            'options' => array('male' => 'Male', 'female' => 'Female')
        ));

        // echo $this->Form->input('role', array(
        //     'options' => array('admin' => 'Admin', 'author' => 'Author')
        // ));
    ?>

<?php echo $this->Form->end(__('Submit')); ?>
