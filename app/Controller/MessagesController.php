<?php
class MessagesController extends AppController {
	public $helpers = array('Html', 'Form');

	public function index() {
		 $user_id=$this->Auth->user('id');
         $messages = $this->Message->find('all', array(
         			//'group' => array(
         				//pogrupuj według albo tam gdzie recipient_id albo sender_id ma to samo id co zalogowany user
         			//	'Message.recipient_id, Message.sender_id' 
         			//),
                    'conditions' => array('OR' => array(
                    	array(
                    		'sender_id'=>$user_id
                    		),
                    	array(
                    		'recipient_id'=>$user_id
                    		)
                    	)
                        
                    ),
                    'order' => array('Message.created' => 'desc')
            ));
        $related_messages=array();
    	foreach ($messages as $key => $message) {
    		if($message['Message']['sender_id']==$user_id){
    			if (!isset($related_messages[  $message['Message']['recipient_id'] ] )) {
    				$related_messages[  $message['Message']['recipient_id']  ]=$message;
    			}	
    		}
    		if($message['Message']['recipient_id']==$user_id){
    			if (!isset($related_messages[  $message['Message']['sender_id']  ])) {
    				$related_messages[  $message['Message']['sender_id']  ]=$message;
    			}
    		}
        		
        }
        $this->set('messages',$related_messages);

    }
    public function conversations($id = null) {
    	$user_id=$this->Auth->user('id');
        $messages = $this->Message->find('all', array(
                    'conditions' => array('OR' => array(array('sender_id'=>$user_id,'recipient_id'=>$id), array('sender_id'=>$id,'recipient_id'=>$user_id))
                        
                    ),
                    'order' => array('Message.created' => 'desc')
            ));
        $this->set('messages',$messages);

        if (isset($this->request->data['Message'])) {
            
        	$this->Message->create();
        	$data_to_save=$this->request->data;
            
        	$data_to_save['Message']['sender_id']=$this->Auth->user('id');
        	$data_to_save['Message']['recipient_id']=$id;
			
        	if ($this->Message->save($data_to_save)) {
                    $this->Session->setFlash(__('The message has been send.'));
                    return $this->redirect(array('action' => 'conversations', $id));
                } else {
                    $this->Session->setFlash(__('The messages cannot be send. Please, try again.'));
                }              
        }
        $this->set('recipient_id',$id);

    }
	public function ajax_send() {
       $this->layout=false;

		if ($this->request->is('post')) {
			
    		$this->Message->create();
    		
    		$this->request->data['sender_id'] = $this->Auth->user('id');
			
    		if ($this->Message->save($this->request->data)) {
    			$id_message = $this->Message->id;

    			$message = $this->Message->find('first', array('conditions'=>array('Message.id'=>$id_message)));
            
    			$this->set('message',$message);
               
                return 1;
            } else{
            	return 0;
            }
    	} else {
    		pr('It is not a message!');
		}
	}

    public function ajax_view_conversation(){

        $this->layout=false;


        $recipient_id=$this->request->data['recipient_id'];

        $user_id=$this->Auth->user('id');
        $messages = $this->Message->find('all', array(
                    'conditions' => array('OR' => array(array('sender_id'=>$user_id,'recipient_id'=>$recipient_id), array('sender_id'=>$recipient_id,
                        'recipient_id'=>$user_id))
                        
                    ),
                    'order' => array('Message.created' => 'desc')
            ));

        $this->set('recipient', $recipient_id);
        $this->set('messages', $messages);
        
        foreach ($messages as $message) {

            $message['Message']['is_read']=1;
            $this->Message->save($message);
        }

    }
}
