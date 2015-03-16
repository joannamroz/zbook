<div class="container">
  <div class="row">

	<div class="col-md-8">
		<div class="">

			<?php //pr($haveNote);die(); ?>
			<?php //pr($book);die(); ?>
			<?php //pr($usersRatings); ?>
			<div class="row">
			  	<div class="col-md-4">
					<div >
						<div><?php echo $this->Html->image($book['Book']['cover']);?></div>
					</div>

						<p class="addCover"><?php echo $this->Html->link('Add cover',array(
						'controller' => 'books', 'action' => 'set_cover', $book['Book']['id']),
					    array(
					    	'class'=>'btn btn-default')
					    ); ?></p>
				
				</div>

				<div class="col-md-8">
					<div class="">
						<h3><strong><?php echo '<cite>'.h($book['Book']['title']).'</cite>'; ?> </strong><i id="heart" class="fa fa-heart
								<?php 

								if( count($haveNote)>0) {
									if($haveNote[0]['Rating']['favourited']==1) { 
										echo 'highlight'; 
									} 
								} 

							?>" ></i>
						</h3>

						<?php //pr($id_book); ?>
						<h3><?php echo  $this->Html->link(h($book['Author']['fullname']), array('controller'=>'authors', 'action'=>'view', $book['Author']['id']));?></h3>
							<?php
							if (!empty($book['BookCategory'])) { ?>

							  		<?php echo $this->Html->link('Categories: ',array('controller'=>'categories','action'=>'index'));
							  		$book_categories=$book['BookCategory'];
							  		//pr($book_categories);
							  		foreach ($book_categories as $key => $category) {
							  			echo '<span class="label label-warning">'.h($category['Category']['name']).' </span>&nbsp; '  ;
							  		} ?>
							  		
							<?php
							}  else  { ?>
							    <h4> <?php echo 'Category: -' ?></h4>    

							<?php } ?>

							<p><small style="color:lightgrey">Created: <?php echo $book['Book']['created']; ?></small></p>

							<div class="viewBookRatingContainer">
								<?php 
								//jeśli otworzysz książkę która ma juz oceny      
								if( count($haveNote)>0) { ?>
									<div><span class="star-box-rating-label">Your rating:</span>
										<div class="rateit viewBook" id="ratedBook" data-rateit-resetable="false"  data-rateit-step="1"  
											data-rateit-ispreset="true" 
											data-rateit-readonly="true"
											data-rateit-min="0" data-rateit-max="10" data-rateit-value="<?php echo $haveNote[0]['Rating']['note']; ?>">
										</div>
									</div>
									<div><span class="star-box-rating-label">Ratings:</span>
										<div class="rateit" id="ratedBook" data-rateit-resetable="false"  data-rateit-step="1"  
											data-rateit-ispreset="true" 
											data-rateit-readonly="true"
											data-rateit-min="0" data-rateit-max="10" data-rateit-value="<?php echo $haveNote[0]['Book']['avg_rating']; ?>">
										</div>
										<div class="rateRight">
					            		</div>
									</div>
								<?php 
								//jesli otworzysz ksiazke ktora nie ma oceny
								} else { ?>

									<div class="rateit" id="rateBook" data-rateit-resetable="false" data-rateit-step="1"  data-rateit-ispreset="true" 
									    data-rateit-min="0" data-rateit-max="10" >
									</div>

								<?php } ?>

							</div> <!-- viewBookRatingContainer -->
							<div>

			<?php echo $this->Form->create('Comment'); ?>
				<fieldset >
					
				<?php
					echo $this->Form->input('body', array('id'=>'bodyComment','label'=>false, 'placeholder'=>'Comment: '));
					
				?>    

				<!-- nie potrzebny bo dodajemy klikajac na klawisz enter -->
				<!-- <button type="button" class="btn btn-default" id="commentButton">Send comment</button>  -->

				 <?php echo $this->Form->end(); ?>
				</fieldset>
				
					<br>
					<br>
				<div id='commentsContainer' >
					<?php  foreach ($comments as $comment):
					//pr($comment);die();
					?> 
					<div><em><?php echo '<q> '.h($comment['Comment']['body']).' </q>' ;?></em></div>
					<p><?php echo h($comment['User']['fullname']) ?> <small><em><?php echo $comment['Comment']['created']?></em></small></p>
					<?php endforeach; ?>

				</div>
		</div> <!-- commentsForm -->

						</div><!--  viewBookInfo -->
					</div>
				</div>
		</div> <!-- viewBookContainer -->



	</div>
	<?php if(count($usersRatings)!=0) { ?>
	  	<div class="col-md-4">
			<div class="">
				<div class=""><h4><?php echo 'Oceniło '.(count($usersRatings)).' użytkowników:';?></h4></div>
					<?php foreach ($usersRatings as $userRating) : ?>
						<div>
							<div>
								<h4><?php echo $this->Html->link($userRating['User']['username'], array('controller'=>'users', 'action'=>'view_user', $userRating['User']['id']));?></h4>
							</div>
							
							<div class=" ">
	                			<strong><?php echo ' '.h($userRating['Rating']['note']).' ';?></strong>
	                			<div class="rateit viewBook left" id="ratedBook" data-rateit-resetable="false"  data-rateit-step="1"  
									data-rateit-ispreset="true" data-rateit-readonly="true"
									data-rateit-min="0" data-rateit-max="10" data-rateit-value="<?php echo h($userRating['Rating']['note']); ?>">
								</div>
	            			</div>
						</div>
					<?php endforeach; ?>
				
				</div>	
			 </div>	
		</div>
	<?php } ?>

  </div>
</div>

<script> 

	var book_id=<?php echo $id_book; ?>;

</script>
