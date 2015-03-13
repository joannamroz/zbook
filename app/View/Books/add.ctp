<h3>Add Book</h3>
<?php
echo $this->Form->create('Book', array(
                                            'class'=>'form-horizontal'
                                            
                              ));?>
<div class="form-group">
    <label for="inputTitle" class="col-sm-2 control-label add_author_input">Title:</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('title', array('class' => 'form-control shortInput',
            'label'=>false,
            'div'=>false
        ));?>
    </div>
</div>
<div class="form-group">
    <label for="inputAuthor" class="col-sm-2 control-label add_author_input">Author:</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('author_id', array('options' => $authors,
        'class' => 'use_select2 shortInput',
            'label'=>false,
            'div'=>false,
            'multiple'=>false
        ));?>
    </div>
</div>
<div class="form-group">
    <label for="inputCategories" class="col-sm-2 control-label add_author_input">Categories:</label>
    <div class="col-sm-10">
      <?php echo $this->Form->input('BookCategories.category_id', array('options' => $categories,
        'class' => 'use_select2 shortInput',
            'label'=>false,
            'div'=>false,
            'multiple'=>true
        ));?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 authorButton ">
      <button type="submit" class="btn btn-default"><strong>Save book</strong></button>
    </div>
</div>
                      

