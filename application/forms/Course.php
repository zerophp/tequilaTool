<?php

class Application_Form_Course extends Zend_Form
{
	public function init()
	{
		$this->setName('courses');
		$id = new Zend_Form_Element_Hidden('idcourses');
		$id->addFilter('Int');
		$course = new Zend_Form_Element_Text('course');
		$course->setLabel('Course')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');
		$description = new Zend_Form_Element_Text('description');
		$description->setLabel('Description')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');
		$dini = new Zend_Form_Element_Text('dini');
		$dini->setLabel('Date Init')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('Date')
		->addValidator('Date', false, array('YYYY-MM-dd HH:mm'));
		$dfini = new Zend_Form_Element_Text('dfini');
		$dfini->setLabel('Date End')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('Date')
		->addValidator('Date', false, array('YYYY-MM-dd HH:mm'));
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('iduser', 'submitbutton');
		
		$this->addElements(array($id, $course, $description, $dini, $dfini, $submit));
	}
}