<?php

class Post extends AppModel {
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
    /**
  	* Metoda sprawdzajaca czy uzytkownik o danym id($user_id) jest wlascicielem posta o danym id($post_id)
  	*/
    public function isOwnedBy($post_id, $user_id) {
    	pr('id posta '.$post_id);
    	pr('id uzytkownika '.$user_id);
    	//die();
    	//$warunek = array('id'=> $post_id)
    	//  $this->field($nazwa_pola, $warunek );
    	//$pole = $this->field('title', array('id' => $post_id, 'user_id' => $user_id)) ;//!== false;
		//pr($pole);
    	$pole_id =  $this->field('id', array('id'=>$post_id, 'user_id' => $user_id));
    	if ($pole_id !== false) {
    		pr('ludek ma dostep');
    	} else {
    		pr('ludek nie ma dostepu');
    	}
		return $pole_id !== false;

		//die();
	}
}