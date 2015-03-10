<!-- File: /app/View/Books/index.ctp -->
<div>
<div style="float:left">
<h3>Authors:</h3>
</div>
<div style="float:right">


<?php echo $this->Html->link(
    'Add new',
    array('controller' => 'authors', 'action' => 'add'),
    array('class'=>'btn btn-default')
    );

?>

</div>
</div>
<table class="table table-bordered">
    <tr>
        <th>Lp. </th>
        <th>Fullname </th>
         <?php if (AuthComponent::user('role')=='admin') { ?>
            <th>Action </th>
         <?php } ?>
        <th>Created </th>
        <th>Modified</th>
    </tr>

    <!-- Here is where we loop through our $books array, printing out book info -->
    <?php $lp=1; ?>
    <?php foreach ($authors as $author): ?>
    <tr>
        <td><?php echo $lp; ?></td>
        <td>
            <?php echo $this->Html->link($author['Author']['fullname'],
array('controller' => 'authors', 'action' => 'view', $author['Author']['id'])); ?>
        </td>
        <?php if (AuthComponent::user('role')=='admin') { ?>
        <td>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $author['Author']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit',
                    array('action' => 'edit', $author['Author']['id'])
                );
            ?>

        </td>
        <?php } ?>
        <td><?php echo $author['Author']['created']; ?></td>
        <td><?php echo $author['Author']['modified']; ?></td>
    </tr>
    <?php $lp++ ?>
    <?php endforeach; ?>
    <?php unset($author); ?>
</table>