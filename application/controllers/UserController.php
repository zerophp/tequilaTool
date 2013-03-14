<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $users = new Application_Model_DbTable_Users();
        $this->view->users = $users->fetchAll();
    }
    
    public function addAction()
    {
        $form = new Application_Form_User();     
        $form->submit->setLabel('Add');        
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        	    
        		$name = $form->getValue('name');
        		$email = $form->getValue('email');
        		$dbirth = $form->getValue('dbirth');
        		$password = $form->getValue('password');
        		$status = $form->getValue('status_idstatus');
        		
        		$user = new Application_Model_User();
        		$user->setName($name);
        		$user->setEmail($email);
        		$user->setDbirth($dbirth);
        		$user->setPassword($password);
        		$user->setStatus($status);
        		        		
        		$users = new Application_Model_DbTable_Users();
        		$users->addUser($user);        		
        		$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        }
    }
    
    public function editAction()
    {
        $form = new Application_Form_User();
        
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        	    
        	    $iduser =  $form->getValue('iduser');
        		$name = $form->getValue('name');
        		$email = $form->getValue('email');
        		$dbirth = $form->getValue('dbirth');
        		$password = $form->getValue('password');
        		$status = $form->getValue('status_idstatus');
        		
        		$user = new Application_Model_User();
        		$user->setIduser($iduser);
        		$user->setName($name);
        		$user->setEmail($email);
        		$user->setDbirth($dbirth);
        		$user->setPassword($password);
        		$user->setStatus($status);
        		
        		$users = new Application_Model_DbTable_Users();
        		$users->updateUser($user);
        		$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        } else {
        	$id = $this->_getParam('iduser', 0);
        	if ($id > 0) {
        		$users = new Application_Model_DbTable_Users();
        		$form->populate($users->getUser($id));
        	}
        }
    }
    
    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
        	$del = $this->getRequest()->getPost('del');
        	if ($del == 'Yes') {
        		$iduser = $this->getRequest()->getPost('iduser');
        		$users = new Application_Model_DbTable_Users();
        		$users->deleteUser($iduser);
        	}
        	$this->_helper->redirector('index');
        } else {
        	$iduser = $this->_getParam('iduser', 0);
        	$users = new Application_Model_DbTable_Users();
        	$this->view->user = $users->getUser($iduser);
        }
    }


}

