<?php

class Author extends AppModel {
    public $validate = array(
        'fullname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A fullname is required'
                )
        )
    );
    public $hasMany = array(
        'Book' => array(
            'className' => 'Book'
            //'conditions' => array('Recipe.approved' => '1'),
            //'order' => 'Recipe.created DESC'
        )
    );
    
}