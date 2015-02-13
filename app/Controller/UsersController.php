<?php


// app/Controller/UsersController.php
App::uses('AppController', 'Controller');
App::uses('Author', 'Model');
App::uses('Book', 'Model');
App::uses('Rating', 'Model');


class UsersController extends AppController {

    //var $layout='';
     public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add', 'logout');
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
    // app/Controller/UsersController.php

   

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    public function user_book(){
        $this->loadModel('Rating');

        $this->layout='zbook';
        $user_id=$this->Auth->user('id');

        //http://book.cakephp.org/2.0/en/models/model-attributes.html
        //jest to atrybut modelu ktory jesli robimy find na tym modelu to pobierzemy glebsze relacje
        //jak jest user-books-author to majac 0 i 1 dojedziemy tylko do books i user a majac 2 to jeszcze do authora

        $this->Rating->recursive = 2;
        $user_books=$this->Rating->find('all', array('conditions'=>array('Rating.user_id'=>$user_id)));
        //pr($user_books);
        $this->set('user_books', $user_books);
    }

}