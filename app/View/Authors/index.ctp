<!-- File: /app/View/Books/index.ctp -->

<h2>Lista Autorów</h2>
<?php echo $this->Html->link(
    'Add Author',
    array('controller' => 'authors', 'action' => 'add')
); ?>
<table class="table table-bordered">
    <tr>
        <th>Id </th>
        <th>Fullname </th>
        <th>Action </th>
        <th>Created </th>
    </tr>

    <!-- Here is where we loop through our $books array, printing out book info -->

    <?php foreach ($authors as $author): ?>
    <tr>
        <td><?php echo $author['Author']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($author['Author']['fullname'],
array('controller' => 'authors', 'action' => 'view', $author['Author']['id'])); ?>
        </td>
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
        <td><?php echo $author['Author']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($author); ?>
</table>