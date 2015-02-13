<?php
class RatingsController extends AppController {

	public $helpers = array('Html', 'Form');

	
    public function view() {
        $this->set('ratings', $this->Rating->find('all'));
    }

    public function ajax_add() {

    	$this->layout=false;
    	$this->autoRender=false;
    	pr('tekst z ajax add controller!');
    	if ($this->request->is('post')) {
    		var_dump("tak to jest post!");

    		$this->Rating->create();
    		pr($this->request->data);
    		$this->request->data['user_id'] = $this->Auth->user('id');
            
    		pr($this->request->data);
    		if ($this->Rating->save($this->request->data)) {
                
                //gdy juz mamy zapisane dane z ajaxa czyli id ksiazki i note to znajdujemy wszystkie noty i uzywamy
                //funkcji avg aby otrzymac srednia ocen o danym id ksiazki 
                $ratings_data=$this->Rating->find('all', array(
                'fields' => array('AVG(Rating.note) AS AverageRating','COUNT(*) AS RatingAmount'),
                'conditions' => array('Rating.book_id'=>$this->request->data['book_id']) 
                ));

                $avg_rating=$ratings_data[0][0]['AverageRating']; //tu mamy w arayu wiec aby sie dostac do pojedynczego elementu
                $rating_amount=$ratings_data[0][0]['RatingAmount']; //tu mamy w arayu wiec aby sie dostac do pojedynczego elementu
                $this->loadModel('Book');

                //$this->Book->read(null, $this->request->data['book_id']);
                //tu ustawiamy pod kolumne'avg_rating' z tabeli ratings otrzymana srednia
                //$this->Book>set('avg_rating', $avg_rating[0][0]['AverageRating'] );

                $book=array(
                    'id'=> $this->request->data['book_id'],
                    'avg_rating'=> $avg_rating,
                    'rating_amount'=>$rating_amount);

                //zapisujemy zmiany czyli updatujemy
                $this->Book->save($book);

                
                return 1;

            } else{
            	return 0;
            }
    	} else {
    		pr('hola hola to nie post');
    	}
    }

    public function ajax_favourite() {
    	
    	//to jest ustawienie layoutu by nie zwracało całego htmla
    	$this->layout=false;
    	$this->autoRender=false;

    	//spr czy dane sa wyslane postem 
    	if ($this->request->is('post')) {
    		
    		//przypisujemy do zmiennej $dane dane ktore zostaly wyslane formularzem
    		$dane=$this->request->data;
    		

    		$dane['user_id'] = $this->Auth->user('id');
    		$wynik = $this->Rating->find('first', array("conditions"=> array("Rating.book_id"=>$dane["book_id"], "Rating.user_id"=>$dane["user_id"])));

    		if(count($wynik)){
    			$dane["id"] = $wynik["Rating"]["id"];
	    		if($wynik["Rating"]["favourited"]==0) {
	 				
	 				$dane['favourited']=1;
	    		//pr($dane);

	    		} else {
	    			
	    			$dane['favourited']=0;
	    		}
	    		
	    		//pr($wynik);
		
	    		
	    		if ($this->Rating->save($dane)) {
	                //$this->Session->setFlash(__('Your book has been saved.'));
	                return $dane["favourited"];
	            } else{
	            	return "Error";
	            }
    		} else {
    			//przypadek gdy nie ma nic w rating 
    			//pr($dane);
    			$dane['favourited']=1;
    			if ($this->Rating->save($dane)) {
	                //$this->Session->setFlash(__('Your book has been saved.'));
	                return $dane["favourited"];
	            } else{
	            	return "Error";
	            }
    		}

    		//pr($dane);

    		
    	} else {
    		//pr('hola hola to nie post');
    	}

    }

}