<?php
class QuestionController extends Zend_Controller_Action
{


	public function init()
	{
		/* Initialize action controller here */
	    
	}

    function indexAction()
    {
        $questions = new Application_Model_DbTable_Questions();
        $this->view->questions = $questions->fetchAll();
    }


    function addAction()
    {
        $form = new Application_Form_Question();
        //$questions = new Application_Model_DbTable_Questions();
        $form->submit->setLabel('Add');
        //$form->idexam->setMultiOptions($questions->selectOptionsExams());
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
        $formData = $this->getRequest()->getPost();
        if ($form->isValid($formData)) {
                  
            $question = $form->getValue('question');
            $answer1 = $form->getValue('answer1');
            $answer2 = $form->getValue('answer2');
            $answer3 = $form->getValue('answer3');
            $answer4 = $form->getValue('answer4');
            $answer5 = $form->getValue('answer5');
            $solution = $form->getValue('solution');
            $answers_types_idanswers_types = $form->getValue('answers_types_idanswers_types'); 
            $exams_idexams = $form->getValue('exams_idexams');
            
            $questions = new Application_Model_DbTable_Questions();
            $questions->addQuestion($question, $answer1,$answer2,$answer3,$answer4,$answer5,$solution,$answers_types_idanswers_types,$exams_idexams);
            $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
                }
        }
    }

function editAction()
{
    $form = new Application_Form_Question();
    $form->submit->setLabel('Save');
    $this->view->form = $form;
    if ($this->getRequest()->isPost()) {
        $formData = $this->getRequest()->getPost();
        if ($form->isValid($formData)) {
        $idquestions = (int)$form->getValue('idquestions');
        $question = $form->getValue('question');
        $answer1 = $form->getValue('answer1');
        $answer2 = $form->getValue('answer2');
        $answer3 = $form->getValue('answer3');
        $answer4 = $form->getValue('answer4');
        $answer5 = $form->getValue('answer5');
        $solution = $form->getValue('solution');
        $answers_types_idanswers_types = $form->getValue('answers_types_idanswers_types'); 
        $exams_idexams = $form->getValue('exams_idexams');
        $questions = new Application_Model_DbTable_Questions();
        $questions->updateQuestion($idquestions, $question, $answer1,$answer2,$answer3,$answer4,$answer5,$solution,$answers_types_idanswers_types,$exams_idexams);
        $this->_helper->redirector('index');
        } else {
        $form->populate($formData);
        }
        } else {
        $idquestions = $this->_getParam('idquestions', 0);
        if ($idquestions > 0) {
        $questions = new Application_Model_DbTable_Questions();
        $form->populate($questions->getQuestion($idquestions));
        }
    }
}
public function deleteAction()
{
if ($this->getRequest()->isPost()) {
$del = $this->getRequest()->getPost('del');
if ($del == 'Yes') {
$idquestions = $this->getRequest()->getPost('idquestions');
$questions = new Application_Model_DbTable_Questions();
$questions->deleteQuestion($idquestions);
}
$this->_helper->redirector('index');
} else {
$idquestions = $this->_getParam('idquestions', 0);
$questions = new Application_Model_DbTable_Questions();
$this->view->question = $questions->getQuestion($idquestions);
}
}
}