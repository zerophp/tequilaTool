<?php

class Application_Form_Examinations extends Zend_Form
{

    public function init()
    {

    	$this->setName('examination');
    	
    	$idexaminations = new Zend_Form_Element_Text('idexaminations');
    	$idexaminations->setLabel('idexaminations')
    	->setRequired(true)
    	->addFilter('StripTags')
    	->addFilter('StringTrim')
    	->addValidator('NotEmpty');

    	$courses_idcourses = new Zend_Form_Element_Text('courses_idcourses');
    	$courses_idcourses->setLabel('courses_idcourses')
    	->setRequired(true)
    	->addFilter('StripTags')
    	->addFilter('StringTrim')
    	->addValidator('NotEmpty');
    	
    	$exams_idexams = new Zend_Form_Element_Text('exams_idexams');
    	$exams_idexams->setLabel('exams_idexams')
    	->setRequired(true)
    	->addFilter('StripTags')
    	->addFilter('StringTrim')
    	->addValidator('NotEmpty');
    	
    	$dini = new Zend_Form_Element_Text('dini');
    	$dini->setLabel('dini')
    	->setRequired(true)
    	->addFilter('StripTags')
    	->addFilter('StringTrim')
    	->addValidator('NotEmpty')
		->addValidator('Date', false, array('YYYY-MM-dd HH:mm:ss'));
    	
    	$dfini = new Zend_Form_Element_Text('dfini');
    	$dfini->setLabel('dfini')
    	->setRequired(true)
    	->addFilter('StripTags')
    	->addFilter('StringTrim')
    	->addValidator('NotEmpty')
		->addValidator('Date', false, array('YYYY-MM-dd HH:mm:ss'));
    	
		$hash = new Zend_Form_Element_Hash('hash');
    	
    	$submit = new Zend_Form_Element_Submit('submit');
    	$submit->setAttrib('id', 'submitbutton');
    	$this->addElements(array($idexaminations,$courses_idcourses,$exams_idexams,$dini,$dfini,$hash,$submit));

    }
}
