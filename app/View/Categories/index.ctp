<?php //pr($categories);?> <?php //die(); ?>


<h3>Categories:</h3>

<ol>
<?php foreach ($categories as $key => $category) :?>
	<li data-id="<?php echo $category['Category']['id'] ;?>"><?php echo $this->Html->link($category['Category']['name'],array('action'=>'view', $category['Category']['id']) );?></li>
	<?php endforeach ?>
</ol>

<?php echo $this->Html->link(
    'Add category',
    array('controller' => 'categories', 'action' => 'add'),
    array('class'=>'btn btn-primary')
    ); 

?>
