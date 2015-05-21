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
       
        $books = $this->Book->find('all', array(
        	'conditions' => array('Book.author_id' => $id)
        ));
           
        $this->set('books', $books);
       
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
	            return $this->redirect(array('action' => 'view',$id));
	        }
	        $this->Session->setFlash(__('Unable to update your author.'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $author;
	    }
       
	}
	public function add_photo($id = null) {
		
        $this->Author->id = $id;
        if ($this->request->is('post'))  {
            
            $filename = $this->request->data['Author']['photo']['name'];
           

            
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            $name_hash = md5(uniqid(rand(), true)).'.'.$ext;
          
            if (!is_dir('img/authors_photo')) {
                mkdir('img/authors_photo');
            }
            $destination='img/authors_photo/'.$name_hash;
            
            if (move_uploaded_file($this->data['Author']['photo']['tmp_name'], $destination)) {
               
                $this->Session->setFlash('File uploaded successfuly.');
                $author_update['id'] = $id;
                $author_update['photo'] = '/'.$destination;
                
                $this->Author->save($author_update);

            } else {
                $this->Session->setFlash('errr while saving file');
            }
           return $this->redirect(array('action' => 'view',$id)); 
        }
	}

}