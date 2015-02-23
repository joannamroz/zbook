<?php //pr($categories);?>


<h3>Categories:</h3>
<ol>
<?php foreach ($categories as $key => $category) :?>
	<li><?php echo $category['Category']['name'] ;?></li>
	<?php endforeach ?>
</ol>

<?php echo $this->Html->link(
    'Add category',
    array('controller' => 'categories', 'action' => 'add'),
    array('class'=>'btn btn-primary')
    ); 

?>