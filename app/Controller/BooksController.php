<?php
App::uses('Author', 'Model');
App::uses('Comment', 'Model');
App::uses('Rating', 'Model');

class BooksController extends AppController {

    public $helpers = array('Html', 'Form');

    public function index() {
        $this->Book->recursive= 2;

    
        //pobierz wszystkie ksiazki gdzie contain(a wraz z nimi) =>book category, author i w bookcategory jeszcze 'category'
       // $books = $this->Book->find('all', array('contain' => false));->pobierze tylko zawartosc Book bez associated models
        $books = $this->Book->find('all', array(
                    'contain' => array(
                        'BookCategory'=>array(
                            'Category'
                        ),
                        'Author'
                    )
            ));
        //wyslanie/ustawienie zmiennej $books do widoku tak aby byly dostepne pod nazwa 'books' a w view jako $books
        $this->set('books', $books);
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid book'));
        }
        //zaladowanie dwoch modeli do ktorych chcemy miec dostep:comment oraz rating
        $this->loadModel('Comment');
        $this->loadModel('Rating');
        
        //do zmiennej $book przypisujemy dane z wyszukiwania dla danego id ksiazki przypisanych kategorii oraz autora
        $book = $this->Book->find('first', array(
                    'conditions'=> array('Book.id'=>$id),
                    'contain' => array(
                        'BookCategory'=>array(
                            'Category'
                        ),
                        'Author'
                    )
            ));

        //jesli zmienna $book jest pusta
        if (!$book) {

            throw new NotFoundException(__('Invalid book'));
        }
        

        // UwAGA ponizsza funkcja zwraca id zalogowanego uzytkownika 
        // $id_usera_zalogowanego = $this->Auth->user('id')

        //przypadek gdy wysyłamy formularz/klikamy submit albo save note 06.02.2015 Mateusz 
        if ($this->request->is('post')) {

           // pr($this->request->data);
            //die();

            //Sprawdzamy czy jest ustawione data['Rating'] // przypadek gdy klikniemy save note
            if (isset($this->request->data['Rating'])) {

                //do pola ['Rating']['user_id'] w tablicy $this->request->data() przypisujemy id uzytkownika z auth component(czyli obecnie zalogowanego)
                $this->request->data['Rating']['user_id'] = $this->Auth->user('id');

                //do pola ['Rating']['book_id'] tablicy z requesta przypisujemy podane $id ksiazki krora przegladamy
                $this->request->data['Rating']['book_id'] = $id;
                //pr($this->request->data['Rating']);

                //do zmiennej $ocena przypisujemy dane z pola ['Rating']['note']
                $ocena = $this->request->data['Rating']['note'];

                //spr czy ocena znajduje sie w przedziale miedzy 1 a 10 wlącznie
                if ($ocena >0 && $ocena <11){

                    //jeśli tak tworzymy nowy obiekt Rating
                     $this->Rating->create();

                     //spr czy uda nam sie zapisac do Ratingu dane z posta->($this->request->data)
                    if ($this->Rating->save($this->request->data)) {

                        $this->Session->setFlash(__('The rating has been saved.'));

                        //po udanej próbie zapisania danych nastepuje przekierwonie do obecnego controllera i zawartego w nim widoku view dla danego $id
                        return $this->redirect(array('action' => 'view',$id));
                    } else {
                        $this->Session->setFlash(__('The rating could not be saved. Please, try again.'));
                    }   
                } else {
                        $this->Session->setFlash(__('The rating could not be saved. Wrong value.'));
                    }   

               

            }

             //Sprawdzamy czy jest ustawione data['Comment'] // przypadek gdy dodajemy komentarz
            if (isset($this->request->data['Comment'])) {
                //pr($this->request->data);
                           
                $this->request->data['Comment']['user_id'] = $this->Auth->user('id');
                $this->request->data['Comment']['book_id'] = $id;

                //pr($this->request->data);die();
                $this->Comment->create();
                if ($this->Comment->save($this->request->data)) {
                    $this->Session->setFlash(__('The comment has been saved.'));
                    return $this->redirect(array('action' => 'view',$id));
                } else {
                    $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
                }              
            }

        }
        //do $comments przypisujemy wszystkie dane gdzie w tabeli Comment pole book_id jest takie samo jak nasze $id 
        //i wyswietlamy je wedlug tabeli created , desc->od najnowszej, asc-> najstarszej
        $comments = $this->Comment->find('all', array('conditions'=>array('book_id'=>$id), 'order' => array('Comment.created' => 'desc')));
        
        //do $haveNote przypisujemy wszystkie dane z tablei Rating gdzie book_id  jest takie samo jak nasze $id
        //oraz gdzie w polu user_id jest to samo co w componencie Auth->user('id') czyli id z sesji danego zalogowanego usera
        $haveNote = $this->Rating->find('all', array('conditions'=>array('book_id'=>$id, 'user_id'=>$this->Auth->user('id')))) ; 
        //pr($haveNote);
        //die();

        //pod zmienna w widoku books/view dostepna jako $id_book przypisujemy nasze $id
        $this->set('id_book', $id);
        //j.w.
        $this->set('haveNote', $haveNote);
        $this->set('book', $book);
        $this->set('comments',$comments);
    }
     public function add() {

        //spr czy zostaly wprowadzone dane i wysłane postem
        if ($this->request->is('post')) {

            //tworzymy obiekt ksiązki
            $this->Book->create();
            //pr($this->request->data); die();

            //do obiektu 'ksiązka'zapisujemy przesłane postem dane
            if ($this->Book->save($this->request->data)) {

                //przypisujemy id ksiazki która podgladamy jako ostatnio dodaną ksiażke 
                $last_inserted_book_id = $this->Book->id;
                // pr($last_inserted_book_id);die();
                //pr($this->request->data);die();

                //do zmiennej  $book_categories przypisujemy dane z posta z pola:['BookCategories']['category_id']
                $book_categories=$this->request->data['BookCategories']['category_id'] ;
                //pr($book_categories);die();

                //przechodzimy po wszystkich polach $book_categories -może być kilka kategorii
                foreach($book_categories as $book_category) {

                    //tworzymy tymczasowa zmienna $category_to_save['book_id'] i do niej przypisujemy id ksiażki którą edytowalismy
                    $category_to_save['book_id'] = $last_inserted_book_id;

                    //podobnie, przypisujemy kategorie z $book_category
                    $category_to_save['category_id'] = $book_category;

                    //ladujemy model BookCategory aby moc go updatowac
                    $this->loadModel('BookCategory');

                    //tworzymy obiekt BookCategory
                    $this->BookCategory->create();

                    //zapisujemy do BookCategory nasze dane do zapisania
                    $this->BookCategory->save($category_to_save);

                }
                //ustwiamy komunikat o powodzeniu zapisania ksiązki
                $this->Session->setFlash(__('Your book has been saved.'));

                //przekierowanie do widoku index
                return $this->redirect(array('action' => 'index'));
            }

            //ust komunikat o niepowodzeniu dodania ksiazki
            $this->Session->setFlash(__('Unable to add your book.'));
        }

        
        
        //załadowanie modelu Authors
        $this->loadModel('Author');

        
        //pobranie listy autorow na potrzeby pola select
        $authors = $this->Author->find('list', array(
            'fields' => array('Author.id', 'Author.fullname')
        ));

        //wyslanie do widoku pobranych autorow zapisanych w $authors ktore beda dostepne pod nazwa z 'authors'->$authors
        $this->set('authors', $authors);
        //pr($authors);
        $this->loadModel('Category');
        
        $categories=$this->Category->find('list', array(
            'fields'=> array('Category.name')
                    ));
        $this->set('categories',$categories);
        //pr($categories);
    }
    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid book'));
        }

        $book = $this->Book->findById($id);
        if (!$book) {
            throw new NotFoundException(__('Invalid book'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Book->id = $id;
            //pr($this->request->data);die();
            $this->loadModel('BookCategory');
            $this->BookCategory->deleteAll(array('BookCategory.book_id' => $id), false);
            if ($this->Book->save($this->request->data)) {
                 //do zmiennej  $book_categories przypisujemy dane z posta z pola:['BookCategories']['category_id']
                $book_categories=$this->request->data['BookCategories']['category_id'];
       
                //przechodzimy po wszystkich polach $book_categories - moze byc kilka kategorii
                foreach($book_categories as $book_category) {

                    // Tworzymy nową zmienna  $category_to_save i pod indeks ['book_id'] przypisujemy indeks ostatnio dodanej ksiazki
                    $category_to_save['book_id'] = $id;
                    //podobnie, przypisujemy kategorie z $book_category
                    $category_to_save['category_id'] = $book_category;

                    //ladujemy model BookCategory 
                    //$this->loadModel('BookCategory');->przeniesione wyżej by moc wyczyscic dane 

                    //torzymy obiekt BookCategory
                    $this->BookCategory->create();

                    //zapisujemy do BookCategory nasze dane do zapisania
                    $this->BookCategory->save($category_to_save);

                }
               // pr($this->request->data);die();
                //$data_to_save['book_id']=$this->Book->id;
                
                $this->Session->setFlash(__('Your book has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your book.'));
        }

        //przypadek gdy w poscie brak danych->przypisanie starej wartosci z $book
        if (!$this->request->data) {
            $this->request->data = $book;
        }

        $this->loadModel('Author');
        //pobranie listy autorów na potrzeby pola select
            $authors = $this->Author->find('list', array(
                'fields' => array('Author.id', 'Author.fullname')
            ));
            $this->set('authors',$authors);
            //pr($authors);

        $this->loadModel('Category');
            $categories=$this->Category->find('list', array(
                'fields'=>array('Category.name')
            ));
            $this->set('categories',$categories);

        $this->loadModel('BookCategory');
            $selected=$this->BookCategory->find('list', array(
                    'fields'=>array('category_id'),
                    'conditions'=>array(
                       'BookCategory.book_id'=>$id 
                    )
                ));
        //pr($selected);
            $this->set('selected',$selected);
        
	}

	public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        $this->loadModel('BookCategory');
        $this->loadModel('Author');

        //skasowanie ksiazki o danym $id
        if ($this->Book->delete($id)) {

            //deleteAll  skasuje wszystkie rekordy z innych tabeli zwiazane z danym $id ksiazki
            $this->BookCategory->deleteAll(array('BookCategory.book_id' => $id), false);
            $this->Session->setFlash(
                __('The book with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The book with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
    }
    public function set_cover($id = null) {
        //pr($id);die();
        $this->Book->id = $id;
        if ($this->request->is('post'))  {
            //pr($this->request->data);
            $filename = $this->request->data['Book']['cover']['name'];
            //pr($filename);

            //do zmiennej $ext pobieramy funkcje pathinfo rozszerzenei pliku
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            //pr($ext);
            // do zmiennej name_hash wpisujemy losowy "hash" ktorym bedzie nowa nazwa nazsego pliczku I doklejamy kropke oraz rozszerzenie zeby powstala dobra nazwa pliczku
            $name_hash = md5(uniqid(rand(), true)).'.'.$ext;
            //pr($name_hash);die();
            //spr czy jest katalog covers i jeśli nie ma to go tworzymy mkdir:)
            if (!is_dir('img/covers')) {
                mkdir('img/covers');
            }
            $destination='img/covers/'.$name_hash;
            //pr($destination);
            if (move_uploaded_file($this->data['Book']['cover']['tmp_name'], $destination)) {
                // save message to session 
                $this->Session->setFlash('File uploaded successfuly.');
                $book_update['id'] = $id;
                $book_update['cover'] = '/'.$destination;
                //pr($book_update);die();
                $this->Book->save($book_update);

            } else {
                $this->Session->setFlash('errr while saving file');
            }
            
        }
    }
}