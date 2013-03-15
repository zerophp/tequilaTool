<?php

class ExaminationsController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
	    $examinations = new Application_Model_DbTable_Examinations();
		$resultSet = $examinations->fetchAll();
		$this->view->Examinations = $resultSet;
	}

	public function addAction()
	{
		$form = new Application_Form_Examinations();
		$form->submit->setLabel('Add');
		$this->view->form = $form;
		 
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				
				$idexaminations = $form->getValue('idexaminations');
				$courses_idcourses = $form->getValue('courses_idcourses');
				$exams_idexams = $form->getValue('exams_idexams');
				$dini = $form->getValue('dini');
				$dfini = $form->getValue('dfini');
				
				$exModel = new Application_Model_DbTable_Examinations();
				$exModel->addExamination($idexaminations,$courses_idcourses,$exams_idexams,$dini,$dfini);
				$this->_helper->redirector('index');
			} else {
				$form->populate($formData); 
			}
		}
	}
	
	public function editAction()
	{
		$form = new Application_Form_Examinations();
		$form->submit->setLabel('Save');
		$this->view->form = $form;
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				
				$idexaminations = $form->getValue('idexaminations');
				$courses_idcourses = $form->getValue('courses_idcourses');
				$exams_idexams = $form->getValue('exams_idexams');
				$dini = $form->getValue('dini');
				$dfini = $form->getValue('dfini');
				
				$exModel = new Application_Model_DbTable_Examinations();
				$exModel->updateExamination($idexaminations,$courses_idcourses,$exams_idexams,$dini,$dfini);
				$this->_helper->redirector('index');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('id', 0);
			if ($id > 0) {
				$exModel = new Application_Model_DbTable_Examinations();
				$form->populate($exModel->getExamination($id));
			}
		}
	}
	
	
	public function deleteAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');
			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('id');
				$exModel = new Application_Model_DbTable_Examinations();
				$exModel->deleteExamination($id);
			}
			$this->_helper->redirector('index');
		} else {
			$id = $this->_getParam('id', 0);
			$exModel = new Application_Model_DbTable_Examinations();			
			$this->view->examination = $exModel->getExamination($id);			
		}
	}
	
}

