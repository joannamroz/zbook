<?php

class Book extends AppModel {
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        )
        
    );
    public $belongsTo = array(
        'Author' => array(
            'className' => 'Author'
        )
    );

}