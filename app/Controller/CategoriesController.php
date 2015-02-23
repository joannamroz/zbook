<?php
class CategoriesController extends AppController {
	public $helpers = array('Html', 'Form');

	public function view() {
        $this->set('categories', $this->Category->find('all'));
    }
    public function add() {
    	if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Your category has been saved.'));
                return $this->redirect(array('action' => 'view'));
            }
            $this->Session->setFlash(__('Unable to add your category.'));
        }
    }
    public function edit() {

    }
}
