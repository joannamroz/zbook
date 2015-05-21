<?php
class RatingsController extends AppController {

	public $helpers = array('Html', 'Form');

	
    public function view() {
        $this->set('ratings', $this->Rating->find('all'));
    }

    public function ajax_add() {

    	$this->layout=false;
    	$this->autoRender=false;
    	if ($this->request->is('post')) {

    		$this->Rating->create();
    		pr($this->request->data);
    		$this->request->data['user_id'] = $this->Auth->user('id');
            
    		if ($this->Rating->save($this->request->data)) {
                
                $ratings_data=$this->Rating->find('all', array(
                'fields' => array('AVG(Rating.note) AS AverageRating','COUNT(*) AS RatingAmount'),
                'conditions' => array('Rating.book_id'=>$this->request->data['book_id']) 
                ));

                $avg_rating=$ratings_data[0][0]['AverageRating']; 
                $rating_amount=$ratings_data[0][0]['RatingAmount'];
                $this->loadModel('Book');

                $book=array(
                    'id'=> $this->request->data['book_id'],
                    'avg_rating'=> $avg_rating,
                    'rating_amount'=>$rating_amount);

                $this->Book->save($book);

                
                return 1;

            } else{
            	return 0;
            }
    	} else {
    	}
    }

    public function ajax_favourite() {
    	
    	$this->layout=false;
    	$this->autoRender=false;
 
    	if ($this->request->is('post')) {
    		
    		$dane=$this->request->data;
    		
    		$dane['user_id'] = $this->Auth->user('id');
    		$wynik = $this->Rating->find('first', array("conditions"=> array("Rating.book_id"=>$dane["book_id"], "Rating.user_id"=>$dane["user_id"])));

    		if(count($wynik)){
    			$dane["id"] = $wynik["Rating"]["id"];
	    		if($wynik["Rating"]["favourited"]==0) {
	 				
	 				$dane['favourited']=1;

	    		} else {
	    			
	    			$dane['favourited']=0;
	    		}
	    		
	    		
	    		if ($this->Rating->save($dane)) {
	                
	                return $dane["favourited"];
	            } else{
	            	return "Error";
	            }
    		} else {
    			
    			$dane['favourited']=1;
    			if ($this->Rating->save($dane)) {
	             
	                return $dane["favourited"];
	            } else{
	            	return "Error";
	            }
    		}

    		
    	} else {
    	
    	}

    }

}