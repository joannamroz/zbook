<?php
App::uses('Author', 'Model');
App::uses('Comment', 'Model');
App::uses('Rating', 'Model');

class BooksController extends AppController {

    //var $layout='logged_in_layout';
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('books', $this->Book->find('all'));
    }



    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid book'));
        }

        $this->loadModel('Comment');
        $this->loadModel('Rating');
        $book = $this->Book->findById($id);
        if (!$book) {
            throw new NotFoundException(__('Invalid book'));
        }
        

        // UwAGA ponizsza funkcja zwraca id zalogowanego uzytkownika :) bardzo przydatne Asia jest piękna i słodziak :D
        // $id_usera_zalogowanego_piekna_asia = $this->Auth->user('id')

        //przypadek gdy wysyłamy formularz/klikamy submit albo save note 06.02.2015 Mateusz 
        if ($this->request->is('post')) {

           // pr($this->request->data);
            //die();

            //Sprawdzamy czy jest ustawione data['Rating'] // przypadek gdy klikniemy save note
            if (isset($this->request->data['Rating'])) {
                $this->request->data['Rating']['user_id'] = $this->Auth->user('id');
                $this->request->data['Rating']['book_id'] = $id;
                //pr('tutaj zapisujemy rating');
                //pr($this->request->data['Rating']);

                $ocena = $this->request->data['Rating']['note'];
                if ($ocena >0 && $ocena <11){
                     $this->Rating->create();
                    if ($this->Rating->save($this->request->data)) {
                        $this->Session->setFlash(__('The rating has been saved.'));
                        return $this->redirect(array('action' => 'view',$id));
                    } else {
                        $this->Session->setFlash(__('The rating could not be saved. Please, try again.'));
                    }   
                } else {
                        $this->Session->setFlash(__('The rating could not be saved. Wrong value.'));
                    }   

               

            }

             //Sprawdzamy czy jest ustawione data['Comment'] // przypadek gdy dodajemy comentarz
            if (isset($this->request->data['Comment'])) {
                pr('tutaj zapisujemy formularz z comment');
                pr($this->request->data);
               
                          
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

        $comments = $this->Comment->find('all', array('conditions'=>array('book_id'=>$id), 'order' => array('Comment.created' => 'desc')));
        
        $haveNote = $this->Rating->find('all', array('conditions'=>array('book_id'=>$id, 'user_id'=>$this->Auth->user('id')))) ; 
        //pr($haveNote);
        //die();



        $this->set('id_book', $id);
        $this->set('haveNote', $haveNote);
        $this->set('book', $book);
        $this->set('comments',$comments);
    }
     public function add() {

        if ($this->request->is('post')) {
            $this->Book->create();
            if ($this->Book->save($this->request->data)) {
                $this->Session->setFlash(__('Your book has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your book.'));
        }
        //załadowanie modelu Authors
        $this->loadModel('Author');
        //pobranie listy autorów na potrzeby pola select
            $authors = $this->Author->find('list', array(
                'fields' => array('Author.id', 'Author.fullname')
            ));
            $this->set('authors', $authors);
            //pr($authors);
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
            if ($this->Book->save($this->request->data)) {
                $this->Session->setFlash(__('Your book has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your book.'));
        }

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
	}

	public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Book->delete($id)) {
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
}