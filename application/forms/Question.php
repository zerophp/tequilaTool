<?php
class Application_Form_Question extends Zend_Form
{
    public function init()
    {
        $this->setName('question');
        
        $idquestions = new Zend_Form_Element_Hidden('idquestions');
        $idquestions->addFilter('Int');
        
        $question = new Zend_Form_Element_Text('question');
		$question->setLabel('Question')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
//         		->setOptions(array('class'=>'nameAg'))
// 				->setDecorators(array(array('ViewScript', array(
// 				    'viewScript' => 'forms/_element_text.phtml'
// 				))))
				;
		
		$answer1 = new Zend_Form_Element_Text('answer1');
		$answer1->setLabel('Answer1')
				->addFilter('StripTags')
				->addFilter('StringTrim');
		$answer2 = new Zend_Form_Element_Text('answer2');
		$answer2->setLabel('Answer2')
		->addFilter('StripTags')
		->addFilter('StringTrim');
		$answer3 = new Zend_Form_Element_Text('answer3');
		$answer3->setLabel('Answer3')
		->addFilter('StripTags')
		->addFilter('StringTrim');
		$answer4 = new Zend_Form_Element_Text('answer4');
		$answer4->setLabel('Answer4')
		->addFilter('StripTags')
		->addFilter('StringTrim');
		$answer5 = new Zend_Form_Element_Text('answer5');
		$answer5->setLabel('Answer5')
		->addFilter('StripTags')
		->addFilter('StringTrim');
		
		$solution = new Zend_Form_Element_Text('solution');
		$solution->setLabel('Solution')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$type = new Zend_Form_Element_Select('answers_types_idanswers_types');
		$type->setLabel('Type')
		->setRequired(true)
		->setMultiOptions(array(1=>'Simple', 2=>'Multiple', 3=>'Text'))
		->addValidator('NotEmpty');
		
		$idexam = new Zend_Form_Element_Select('exams_idexams');
		$questions = new Application_Model_DbTable_Questions();
		$idexam->setLabel('Exam')
		->setRequired(true)
		->setMultiOptions($questions->selectOptionsExams())
		->addValidator('NotEmpty');
		

		
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		
// 		echo '<pre>';
// 		print_r(array($idquestions, $question, $answer1, $answer2,
// 		        				$answer3, $answer4, $answer5, 
// 		                        $solution, $type, $idexam, $submit));
// 		echo '<pre>';
// 		die;
		
		$this->addElements(array($idquestions, $question, $answer1, $answer2,
		        				$answer3, $answer4, $answer5, 
		                        $solution, $type, $idexam, $submit));
    }
}
