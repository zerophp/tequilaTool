<?php

class StatusController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {   
        
        $statuss = new Application_Model_DbTable_Status();
        $this->view->statuss = $statuss->fetchAll();
    }

    function addAction()
    {
    	$form = new Application_Form_Status();
    	$form->submit->setLabel('Add');
    	$this->view->form = $form;
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)) {
    			$status = $form->getValue('status');
    			
    			$statuss = new Application_Model_DbTable_Status();

    			$statuss->addStatus($status);
    			return $this->_helper->redirector('index');
    			
    			
    		} else {
    			$form->populate($formData);
    		}
    	}
    }
    
    function editAction()
    {
    	$form = new Application_Form_Status();
    	$form->submit->setLabel('Save');
    	$this->view->form = $form;
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)) {
    		   		    
    		    $idstatus  = $form->getValue('idstatus');
    			$status = $form->getValue('status');
    			
    			$statuss= new Application_Model_DbTable_Status();
    			$statuss->updateStatus($idstatus, $status);

    			$this->_helper->redirector('index');
    		} else {
    			$form->populate($formData);
    		}
    	} else {
    		$idstatus = $this->_getParam('idstatus', 0);
    		if ($idstatus > 0) {
    		    $statuss = new Application_Model_DbTable_Status();
   			 
    			$form->populate($statuss->getStatus($idstatus));
    		}
    	}
    }
    public function deleteAction()
    {
    	if ($this->getRequest()->isPost()) {
    		$del = $this->getRequest()->getPost('del');
    		if ($del == 'Yes') {
    			$idstatus = $this->getRequest()->getPost('idstatus');
    			$statuss = new Application_Model_DbTable_Status();
    			$statuss->deleteStatus($idstatus);
    		}
    		$this->_helper->redirector('index');
    	} else {
    		$idstatus = $this->_getParam('idstatus', 0);
    		$statuss = new Application_Model_DbTable_Status();
    		$this->view->status = $statuss->getStatus($idstatus);
    	}
    }
    

}
