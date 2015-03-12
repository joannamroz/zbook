<?php //pr($categories);?>
<?php 
if(count($categories)==0) {  ?>
	<h4>No positions for this category!</h4>
	<?php echo $this->Html->link(
    'Back to all categories',
    array('controller' => 'categories', 'action' => 'index'),
    array('class'=>'btn btn-primary')
    ); 

} else { ?>
	<h3><?php echo $categories[0]['Category']['name'];?></h3>

<?php 
	foreach ($categories as $key => $category) :?>
		<div class='div_books_container'>
	        <div class='div_book_cover'>
	            <div class='book_cover'><?php echo $this->Html->image($category['Book']['cover'], array('class'=>'book_img')); ?></div>

	        </div>
	        <div class='div_book_info'>
		            <h3><?php echo $this->Html->link($category['Book']['title'],
						array('controller' => 'books', 'action' => 'view', $category['Book']['id'])); ?></h3>
		    	<br>
		    	<?php if($category['Book']['avg_rating']!=0) { ?>
		        <div clas="rateContainer">
		            <div class="rateit" id="ratedBook" data-rateit-resetable="false"  data-rateit-step="1"  
		                data-rateit-ispreset="true" 
		                data-rateit-readonly="true"
		                data-rateit-min="0" data-rateit-max="10" data-rateit-value="<?php echo $category['Book']['avg_rating']; ?>">
		            </div>
		            <div class="rateRight">
		                <strong><?php echo $category['Book']['avg_rating'];?></strong><small><?php echo ' (Głosy:'.$category['Book']['rating_amount'].')';?></small>
		            </div>
		        </div>
		    	<?php 
		    	} else { ?>

			        <div class="rateit notrrated" id="rateBook" data-rateit-resetable="false" data-rateit-step="1"  data-rateit-ispreset="true" 
			            data-rateit-min="0" data-rateit-readonly="true" data-rateit-max="10" >
			        </div>

		    	<?php } ?>
		     
	    	</div>
	        
	   </div>
	<?php endforeach; ?>
	<?php echo $this->Html->link('Back to all categories',
    array('controller' => 'categories', 'action' => 'index'),
    array('class'=>'btn btn-primary')
    ); 

} ?>
