<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Registration'); ?></legend>
        <?php 
        echo $this->Form->input('fullname');
        echo $this->Form->input('email');
        echo $this->Form->input('username');

        echo $this->Form->input('password');
        echo $this->Form->input('password2');
        echo $this->Form->input('gender', array(
            'options' => array('male' => 'Male', 'female' => 'Female')
        ));

        // echo $this->Form->input('role', array(
        //     'options' => array('admin' => 'Admin', 'author' => 'Author')
        // ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>