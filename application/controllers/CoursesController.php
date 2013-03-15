<?php

class CoursesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {   
        
        $course = new Application_Model_DbTable_Courses();
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
    			$description = $form->getValue('description');
    			$dini = $form->getValue('dini');
    			$dfini = $form->getValue('dfini');
    			$courses = new Application_Model_DbTable_Courses();
    			$courses->addCourse($course, $description, $dini, $dfini);
    			$this->_helper->redirector('index');
    			} else {
    				$form->populate($formData);
    	}
    }
    }
    
    public function editAction()
    {
    	$form = new Application_Form_Course();
    	$form->submit->setLabel('Save');
    	$this->view->form = $form;
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)) {
    			$idcourses = (int)$form->getValue('idcourses');
    			$course = $form->getValue('course');
    			$description = $form->getValue('description');
    			$dini = $form->getValue('dini');
    			$dfini = $form->getValue('dfini');
    			$courses = new Application_Model_DbTable_Courses();
    			$courses->updateCourse($idcourses, $course, $description, $dini, $dfini);
    			$this->_helper->redirector('index');
    		} else {
    			$form->populate($formData);
    		}
    	} else {
    		$idcourses = $this->_getParam('idcourses', 0);
    		if ($idcourses > 0) {
    			$courses = new Application_Model_DbTable_Courses();
    			$form->populate($courses->getCourse($idcourses));
    		}
    	}
    }
    
    
	public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
        	$del = $this->getRequest()->getPost('del');
        	if ($del == 'Yes') {
        		$idcourses = $this->getRequest()->getPost('idcourses');
        		$courses = new Application_Model_DbTable_Courses();
        		$courses->deleteCourse($idcourses);
        	}
        	$this->_helper->redirector('index');
        } else {
        	$idcourses = $this->_getParam('idcourses', 0);
        	$courses = new Application_Model_DbTable_Courses();
        	$this->view->course = $courses->getCourse($idcourses);
        }
    }
    

}



