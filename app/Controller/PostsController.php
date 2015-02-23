<?php
class PostsController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {

        // pr($this->Auth);
        // pr($this->Auth->user('id'));
            // pr($this->Auth->user());//die();
    	$posty=$this->Post->find('all');
    	//pr($posty);
    	//przypisanie do zmiennej 'posts' pobranych wszystkich postow z bazy 
        $this->set('postyy', $posty);
    }
    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }
    public function add() {
        if ($this->request->is('post')) {
            // pr($this->request->data);
           $this->request->data['Post']['user_id'] = $this->Auth->user('id');
            // pr($this->request->data);die();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your post.'));
        }
    }

    public function edit($id = null) {
    	if (!$id) {
        	throw new NotFoundException(__('Invalid post'));
    	}

    	$post = $this->Post->findById($id);
    	if (!$post) {
        		throw new NotFoundException(__('Invalid post'));
   		}

    	if ($this->request->is(array('post', 'put'))) {
        	$this->Post->id = $id;

        		if ($this->Post->save($this->request->data)) {
            		$this->Session->setFlash(__('Your post has been updated.'));
            			return $this->redirect(array('action' => 'index'));
        		}
        	$this->Session->setFlash(__('Unable to update your post.'));
    		}

    	if (!$this->request->data) {
        	$this->request->data = $post;
    	}
	}
	public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id)) {
            $this->Session->setFlash(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
    }
    public function isAuthorized($user) {

        // pr('tutaj autorajzd');
        // pr($user);
        // pr($this);die();
        // All registered users can add posts
            //pr($user);die();
        if ($this->action === 'add') {
            return true;

        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}