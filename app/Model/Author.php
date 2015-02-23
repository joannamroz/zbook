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
        )
    );
    
}