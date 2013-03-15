<?php

class AnswerController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$form = new Application_Form_Answer();
    	$form->submit->setLabel('Enviar');
    	$form->setAction('answer/add');
    	$this->view->form = $form;
    }
    
    public function addAction()
    {
        $form = new Application_Form_Answer();     
        
        if ($this->getRequest()->isPost()) {
        	$formData = $this->getRequest()->getPost();
        	if ($form->isValid($formData)) {
        		
        	    // FIXME Set AI to idanswer
        	    // FIXME Set iduser
        		// FIXME Set idexamination
        		foreach ($formData as $key => $value)
        		{
        			if($key == 'submit')
        				continue;
        			
        			$answer = new Application_Model_DbTable_Answer();
        			if(is_array($value))
        			{
        				$value = implode(',', $value);
        			}
        			
        			$data = array(
        					'questions_idquestions' => $key,
        					'users_idusers' => '1',
        					'answer' => $value,
        					'examinations_idexaminations' => '1'
        			);
        			
        			$answer->addAnswerArray($data);
        			// FIXME ?
        			$this->_helper->redirector('index');
        		}
        	} else {
        		$form->populate($formData);
        	}
        }
    }
    
    // TODO Acabar
    /*public function showAction()
    {
    	$data = array();
    	$answers = new Application_Model_DbTable_Answer();
    	// FIXME ids
    	$answers = $answers->fetchAll('users_idusers=1 AND examinations_idexaminations=1');
    	foreach ($answers as $answer)
    	{
    		
    		$questions = new Application_Model_DbTable_Questions();
    		$questions = $questions->fetchAll('idquestions=' . $answer->questions_idquestions);
    		
    		print_r($questions);
    		die();
    		
    		$data[]['question'] = $questions->question;
    		$data[]['solution'] = $questions->solution;
    		$data[]['answer'] = $answer->answer;
    	}
    	
    	
    	
    	
    	
    	
    	
    	$this->answers = $data;
    	
       /*	$form = new Application_Form_Answer();
    	$form->submit->setLabel('Enviar');
    	$form->setAction('answer/add');
    	$this->view->form = $form;*/
    //}

}

