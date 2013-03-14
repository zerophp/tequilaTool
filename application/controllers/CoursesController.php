<?php

class CoursesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {   
        
        $course = new Application_Model_CourseMapper();
        $this->view->entries = $course->fetchAll();
    }

    function addAction()
    {
    	$form = new Application_Form_Course();
    	$form->submit->setLabel('Add');
    	$this->view->form = $form;
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)) {
    			$course = $form->getValue('course');
    			$dini = $form->getValue('dini');
    			$dfini = $form->getValue('dfini');
    			
    			$courses = new Application_Model_Course($form->getValues());
    			$mapper  = new Application_Model_CourseMapper();
    			$mapper->save($courses);
    			return $this->_helper->redirector('index');
    			
    			
    		} else {
    			$form->populate($formData);
    		}
    	}
    }
    
    function editAction()
    {
    	$form = new Application_Form_Course();
    	$form->submit->setLabel('Save');
    	$this->view->form = $form;
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)) {
    		   		    
    		    $id  = $form->getValue('idcourses');
    			$course = $form->getValue('course');
    			$dini = $form->getValue('dini');
    			$dfini = $form->getValue('dfini');
    			$courses = new Application_Model_Course($form->getValues());
    			$mapper  = new Application_Model_CourseMapper();
    			$mapper->save($courses);
    			$this->_helper->redirector('index');
    		} else {
    			$form->populate($formData);
    		}
    	} else {
    		$id = $this->_getParam('idcourses', 0);
    		if ($id > 0) {
    		    $courses = new Application_Model_Course();
    		    
    		    
    			$mapper  = new Application_Model_CourseMapper();
	  			
   			 
    			$form->populate($mapper->find($id,$courses));
    		}
    	}
    }
    public function deleteAction()
    {
    	if ($this->getRequest()->isPost()) {
    		$del = $this->getRequest()->getPost('del');
    		if ($del == 'Yes') {
    			$id = $this->getRequest()->getPost('id');
    			$users = new Application_Model_DbTable_users();
    			$users->deleteUser($id);
    		}
    		$this->_helper->redirector('index');
    	} else {
    		$id = $this->_getParam('id', 0);
    		$users = new Application_Model_DbTable_users();
    		$this->view->user = $users->getUser($id);
    	}
    }
    

}



