<?php
class AuthorsController extends AppController {

	public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('authors', $this->Author->find('all'));
    }
    public function add() {
        if ($this->request->is('post')) {
            $this->Author->create();
            if ($this->Author->save($this->request->data)) {
                $this->Session->setFlash(__('Your author has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your author.'));
        }
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid author'));
        }

        $author = $this->Author->findById($id);
        if (!$author) {
            throw new NotFoundException(__('Invalid author'));
        }
        $this->loadModel('Book');
        //pobranie listy autorów na potrzeby pola select
        $books = $this->Book->find('all', array(
        	'conditions' => array('Book.author_id' => $id))
            	//array('fields' => array('title', 'id'))
        );
           // pr($books);die();
        $this->set('books', $books);
        //pr($books);
        $this->set('author', $author);
    }
    public function delete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }

	    if ($this->Author->delete($id)) {
	        $this->Session->setFlash(
	            __('The author with id: %s has been deleted.', h($id))
	        );
	    } else {
	        $this->Session->setFlash(
	            __('The author with id: %s could not be deleted.', h($id))
	        );
	    }

	    return $this->redirect(array('action' => 'index'));
	}
	public function edit($id = null) {
	    if (!$id) {
	        throw new NotFoundException(__('Invalid author'));
	    }

	    $author = $this->Author->findById($id);
	    if (!$author) {
	        throw new NotFoundException(__('Invalid author'));
	    }

	    if ($this->request->is(array('post', 'put'))) {
	        $this->Author->id = $id;
	        if ($this->Author->save($this->request->data)) {
	            $this->Session->setFlash(__('Your author has been updated.'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your author.'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $author;
	    }
	}

}