<h2>Edit Author</h2>
<?php // pr($author);
echo $this->Form->create('Author', array(
                                            'class'=>'form-horizontal'
                                            
                              ));?>
<div class="form-group">
    <label for="inputFullname" class="col-sm-2 control-label add_author_input">Fullname:</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('fullname', array('class' => 'form-control',
            'label'=>false,
            'div'=>false
        ));?>
    </div>
</div>   
<div class="form-group">
    <label for="inputBorn" class="col-sm-2 control-label add_author_input">Born:</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('born', array('class' => 'form-control dataType',
            'dateFormat' => 'DMY',
            'minYear' => date('Y') - 300,
            'maxYear' => date('Y') - 0,
            'label'=>false,
            'div'=>false         
        ));?>
    </div>
</div>
<div class="form-group">
    <label for="inputIsDead" class="col-sm-2 control-label add_author_input">Is dead:</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('is_dead', array('class' => 'form-control',
      		'id'=>'isDead',
            'label'=>false,
            'div'=>false
        ));?>
    </div>
</div>
<div class="form-group died">
    <label for="inputDied" class="col-sm-2 control-label add_author_input">Died:</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('died', array('class' => 'form-control dataType',
            'dateFormat' => 'DMY',
            'minYear' => date('Y') - 300,
            'maxYear' => date('Y') - 0,
            'label'=>false,
            'div'=>false         
        ));?>
    </div>
</div>
<?php //pr($this->request->data['Author']['is_dead']); ?>
<?php if($this->request->data['Author']['is_dead']!=0) { ?>
	<div class="form-group">
	    <label for="inputDied" class="col-sm-2 control-label add_author_input">Died:</label>
	    <div class="col-sm-10">
	      <?php echo $this->Form->input('died', array('class' => 'form-control dataType',
	            'dateFormat' => 'DMY',
	            'minYear' => date('Y') - 300,
	            'maxYear' => date('Y') - 0,
	            'label'=>false,
	            'div'=>false         
	        ));?>
	    </div>
	</div>
<?php } ?>
<div class="form-group">
    <label for="inputDescription" class="col-sm-2 control-label add_author_input">Descripion:</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('description', array('class' => 'form-control',
            'label'=>false,
            'div'=>false
        ));?>
    </div>
</div>       
<div class="form-group">
    <div class="col-sm-10">
      <?php echo $this->Form->input('id', array('type'=>'hidden'
        ));?>
    </div>
</div> 
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 authorButton">
      <button type="submit" class="btn btn-default"><strong>Save author</strong></button>
    </div>
</div>