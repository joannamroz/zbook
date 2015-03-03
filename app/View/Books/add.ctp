<!-- File: /app/View/Posts/add.ctp -->

<h2>Add Book</h2>

<?php echo $this->Form->create('Book', array(
                                            'class'=>'form'
                                            
                              ));?>
<div class="form-group">
    <label for="inputTitle">Title</label>
   
      <?php echo $this->Form->input('title',
      		 array ('class' => 'form-control',
            'label'=>false,
            'div'=>false
        ));?>

</div>  
<div class="form-group">
    <label for="inputAuthor">Author</label>
    
          <?php echo $this->Form->input('author_id',
      		 array (
      		'options' => $authors,
      		'class' => 'use_select2 categories_select',
            'label'=>false,
            'multiple' => false,
            'div'=>false
        ));?>
  
</div> 
<div class="form-group">
    <label for="inputCategories">Categories</label>
    
        <?php echo $this->Form->input('BookCategories.category_id',
      		 array (
      		'options' => $categories,
      		'class' => 'use_select2 categories_select',
            'label'=>false,
            'multiple' => true,
            'div'=>false
        ));?>
    
</div>
<div class="form-group">
    
      <button type="submit" class="btn btn-default">Save book</button>
   
</div>                             

