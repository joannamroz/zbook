<?php

class Rating extends AppModel {
    public $validate = array(
        'rating' => array(
            'rule' => array('notEmpty',
                'message' => 'Choose rate from 1 to 10.')
        ),
        'favourited' => array(
            'rule' =>  array('notEmpty',
                'message' => '1 for favourited, 0 for Not')
        )
    );
    public $belongsTo = array(
        'Book' => array(
            'className' => 'Book'
        ),
        'User'=>array(
            'className'=>'User'
        )
    );

}