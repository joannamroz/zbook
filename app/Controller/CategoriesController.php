<?php
class CategoriesController extends AppController {
	public $helpers = array('Html', 'Form');

	public function index() {
        $this->set('categories', $this->Category->find('all'));
    }
    public function add() {
    	if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Your category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your category.'));
        }
    }
    public function view($id=NULL) {
        if (!$id) {
            throw new NotFoundException(__('Invalid category'));
        }
        //zaladowanie dwoch modeli do ktorych chcemy miec dostep:comment oraz rating
        $this->loadModel('BookCategory');
        $this->loadModel('Author');
   
        $categories = $this->BookCategory->find('all', array(
                    'conditions'=> array('BookCategory.category_id'=>$id),
                    'contain' => array(
                        'BookCategory'=>array(
                            'Category'
                        ),
                        'Author'
                    )
            ));
        $this->set('categories', $categories);
    }
}
