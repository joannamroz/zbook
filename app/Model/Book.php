<?php

class Book extends AppModel {


//uzywamay containable http://book.cakephp.org/2.0/en/core-libraries/behaviors/containable.html
    public $actsAs = array('Containable');

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
    public $hasMany = array(
        'BookCategory' => array(
            'className' => 'BookCategory',

            //ustawiamy dependent na true aby wszystkie rekordy zwiazane z danym modelem byly usuwane wraz z dana pozycja
            //czyli usuwajac ksiazke chcemy aby powiazane z nia dane np z Ratingu tez zostaly wykasowane z bazy
            'dependent' => true
        ),
        'Rating' => array(
            'className' => 'Rating',
            'dependent' => true
        )
    );
    
}