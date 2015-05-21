<?php
App::uses('Author', 'Model');
App::uses('Comment', 'Model');
App::uses('Rating', 'Model');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;


class BooksController extends AppController {

    public $helpers = array('Html', 'Form');

    public function index() {


        $this->Book->recursive= 2;
    
        $books = $this->Book->find('all', array(
                    'contain' => array(
                        'BookCategory'=>array(
                            'Category'
                        ),
                        'Author'
                    ),
                    'order' => array('Book.created' => 'desc')
            ));
        
        $this->set('books', $books);

    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid book'));
        }
       
        $this->loadModel('Comment');
        $this->loadModel('Rating');
        
        $book = $this->Book->find('first', array(
                    'conditions'=> array('Book.id'=>$id),
                    'contain' => array(
                        'BookCategory'=>array(
                            'Category'
                        ),
                        'Author'
                    )
            ));

        if (!$book) {

            throw new NotFoundException(__('Invalid book'));
        }
        
        if ($this->request->is('post')) {

            //Sprawdzamy czy jest ustawione data['Rating'] // przypadek gdy klikniemy save note
            if (isset($this->request->data['Rating'])) {

                $this->request->data['Rating']['user_id'] = $this->Auth->user('id');

                $this->request->data['Rating']['book_id'] = $id;
        
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

             
            if (isset($this->request->data['Comment'])) {
                           
                $this->request->data['Comment']['user_id'] = $this->Auth->user('id');
                $this->request->data['Comment']['book_id'] = $id;

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
        
        $usersRatings=$this->Rating->find('all', array('conditions'=>array('book_id'=>$id)));
        $this->set('usersRatings', $usersRatings);

        $this->set('id_book', $id);
        $this->set('haveNote', $haveNote);
        $this->set('book', $book);
        $this->set('comments',$comments);
    }
     public function add() {

        if ($this->request->is('post')) {

            $this->Book->create();
    
            if ($this->Book->save($this->request->data)) {

                $last_inserted_book_id = $this->Book->id;
      
                $book_categories=$this->request->data['BookCategories']['category_id'] ;
                
                foreach($book_categories as $book_category) {

                    $category_to_save['book_id'] = $last_inserted_book_id;

                    $category_to_save['category_id'] = $book_category;

                    $this->loadModel('BookCategory');

                    $this->BookCategory->create();

                    $this->BookCategory->save($category_to_save);

                }
                $this->Session->setFlash(__('Your book has been saved.'));

                return $this->redirect(array('action' => 'index'));
            }

            $this->Session->setFlash(__('Unable to add your book.'));
        }

        
        $this->loadModel('Author');

 
        $authors = $this->Author->find('list', array(
            'fields' => array('Author.id', 'Author.fullname')
        ));

        $this->set('authors', $authors);
        $this->loadModel('Category');
        
        $categories=$this->Category->find('list', array(
            'fields'=> array('Category.name')
                    ));
        $this->set('categories',$categories);
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
            $this->loadModel('BookCategory');
            $this->BookCategory->deleteAll(array('BookCategory.book_id' => $id), false);
            if ($this->Book->save($this->request->data)) {
                $book_categories=$this->request->data['BookCategories']['category_id'];
       
                foreach($book_categories as $book_category) {

                    $category_to_save['book_id'] = $id;
                    $category_to_save['category_id'] = $book_category;

                    $this->BookCategory->create();

                    $this->BookCategory->save($category_to_save);

                }
               
                $this->Session->setFlash(__('Your book has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your book.'));
        }

        if (!$this->request->data) {
            $this->request->data = $book;
        }

        $this->loadModel('Author');
            $authors = $this->Author->find('list', array(
                'fields' => array('Author.id', 'Author.fullname')
            ));
            $this->set('authors',$authors);

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
            $this->set('selected',$selected);
        
	}

	public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        $this->loadModel('BookCategory');
        $this->loadModel('Author');

        if ($this->Book->delete($id)) {

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
        $this->Book->id = $id;
        if ($this->request->is('post'))  {
            $filename = $this->request->data['Book']['cover']['name'];
            
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
            $name_hash = md5(uniqid(rand(), true)).'.'.$ext;
           
            if (!is_dir('img/covers')) {
                mkdir('img/covers');
            }
            $destination='img/covers/'.$name_hash;
            
            if (move_uploaded_file($this->data['Book']['cover']['tmp_name'], $destination)) {
                
                $this->Session->setFlash('File uploaded successfuly.');
                $book_update['id'] = $id;
                $book_update['cover'] = '/'.$destination;
                $this->Book->save($book_update);

            } else {
                $this->Session->setFlash('errr while saving file');
            }
           return $this->redirect(array('action' => 'view',$id)); 
        }
    } 
}