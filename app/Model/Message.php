<?php
class Message extends AppModel {
    public $validate = array(
        'body' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A content is required'
                )
        )
    );

    public $belongsTo = array(
		'Recipient' => array(
			'className' => 'User',
			'foreignKey' => 'recipient_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Sender' => array(
			'className' => 'User',
			'foreignKey' => 'sender_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		));
    
}