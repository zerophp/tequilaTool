<?php

class ExamController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
    }
    
    public function indexAction()
    {
        // action body
        $exams = new Application_Model_DbTable_Exams();
        $this->view->exams = $exams->fetchAll();
    }
    
    public function addAction()
    {
        $form = new Application_Form_Exam();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		$name = $form->getValue('name');
        		$dcreation = $form->getValue('dcreation');
        		$exams = new Application_Model_DbTable_Exams();
        		$exams->addExam($name, $dcreation);
        		$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        }
    }
    
    public function editAction()
    {
        $form = new Application_Form_Exam();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		$id = (int)$form->getValue('idexams');
        		$name = $form->getValue('name');
        		$dcreation = $form->getValue('dcreation');
        		$exams = new Application_Model_DbTable_Exams();
        		$exams->updateExam($id, $name, $dcreation);
        		$this->_helper->redirector('index');
        	} else {
        		$form->populate($formData);
        	}
        } else {
        	$id = $this->_getParam('idexams', 0);
        	if ($id > 0) {
        		$exams = new Application_Model_DbTable_Exams();
        		$form->populate($exams->getExam($id));
        	}
        }
    }
    
    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
        	$del = $this->getRequest()->getPost('del');
        	if ($del == 'Yes') {
        		$id = $this->getRequest()->getPost('idexams');
        		$exams = new Application_Model_DbTable_Exams();
        		$exams->deleteExam($id);
        	}
        	$this->_helper->redirector('index');
        } else {
        	$id = $this->_getParam('idexams', 0);
        	$exams = new Application_Model_DbTable_Exams();
        	$this->view->exam = $exams->getExam($id);
        }
    }
    
}