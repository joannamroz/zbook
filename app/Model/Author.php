<?php

class Author extends AppModel {
    public $validate = array(
        'fullname' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A fullname is required'
                )
        ),
        'born'=> array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A date of birth is required'
                )
        ),
        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A description is required'
                )
        ),
    );
    public $hasMany = array(
        'Book' => array(
            'className' => 'Book'
        )
    );
    
}