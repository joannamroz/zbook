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
    public function countUnread() {
    	$user_id=AuthComponent::user('id');

        $count_msg = $this->find('count', array(
        'conditions' => array('AND' => array(//oraz 
                    	array(
                    		'recipient_id'=>$user_id), //odbiorcą jest nasz $id 
                    	array(
                    		'is_read'=>'0') // lub jest odbiorcą wiadomosci    	
        				))));
        return $count_msg;
    }
}