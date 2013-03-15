<?php
class Application_Form_Answer extends Zend_Form
{
    public function init()
    {
        $this->setName('answer');
        
        $idanswer = new Zend_Form_Element_Hidden('idanswer');
        $idanswer->addFilter('Int');
        
        $questions = new Application_Model_DbTable_Questions();
        $questions = $questions->fetchAll();

        $elements = array();
        
        foreach ($questions as $question)
        {
        	switch($question->answers_types_idanswers_types)
        	{
        		case '1':
        			$answers = array();
        			for($i = 1; $i <= 5; $i++)
        			{
        				$answerName = 'answer' . $i;
        				if($question->$answerName !== NULL)
        					$answers[] = $question->$answerName;
        			}
        			
        			
        			$aux = new Zend_Form_Element_Radio($question->idquestions);
        			$aux->setLabel($question->question)
	        			//->setRequired(true)
	        			->setMultiOptions($answers);
	        			//->addValidator('NotEmpty');
        			break;
        		case '2':
        			$answers = array();
        			for($i = 1; $i <= 5; $i++)
        			{
        			$answerName = 'answer' . $i;
        			if($question->$answerName !== NULL)
        				$answers[] = $question->$answerName;
        			}
        			 
        			 
        			$aux = new Zend_Form_Element_MultiCheckbox($question->idquestions);
        			$aux->setLabel($question->question)
        			//->setRequired(true)
        			->setMultiOptions($answers);
        			//->addValidator('NotEmpty');
        			break;
        		case '3':
        			$aux = new Zend_Form_Element_Text($question->idquestions);
        			$aux->setLabel($question->question);
        			//->setRequired(true)
        			//->addValidator('NotEmpty');
        			break;
        			
        	}
        	
        	$elements[] = $aux;
        }
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		
		$elements[] = $submit;
		
		$this->addElements($elements);
    }
}