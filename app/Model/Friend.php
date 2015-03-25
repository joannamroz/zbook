<?php

class Friend extends AppModel {
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
	public function  findUserFriendsByUserId($user_id){
		$user_friends = array();
		$friendsListId=	$this->find('all', array(
                    'conditions' => array(array('Friend.answered'=>'1','Friend.response'=>'1', 'OR' => array(
                        array('sender_id'=>$user_id),//nadawca jest nasz $id    
                            
                        array('recipient_id'=>$user_id)// lub jest odbiorcą wiadomosci  
                        )
                    ))
            ));
		foreach ($friendsListId as $key => $friend) {

			if($friend['Friend']['sender_id']===$user_id){
			$user_friends[]=$friend['Friend']['recipient_id'];
			}else if($friend['Friend']['recipient_id']===$user_id){
				$user_friends[]=$friend['Friend']['sender_id'];
			}
		}
		return $user_friends;
	}
}