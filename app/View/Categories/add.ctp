<h3>Add Category</h3>
<?php
echo $this->Form->create('Category', array(
                                            'class'=>'form-horizontal'
                                            
                              ));?>
<div class="form-group">
    <label for="inputName" class="col-sm-2 control-label add_author_input">Name:</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('name', array('class' => 'form-control shortInput',
            'label'=>false,
            'div'=>false
        ));?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 authorButton">
      <button type="submit" class="btn btn-default"><strong>Save</strong></button>
    </div>
</div>
 