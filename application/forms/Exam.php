<?php
class Application_Form_Exam extends Zend_Form
{
	public function init()
	{
		$this->setName('exam');
		$id = new Zend_Form_Element_Hidden('idexams');
		$id->addFilter('Int');
		
		$name = new Zend_Form_Element_Text('name');
		$name->setLabel('Name')
    		->setRequired(true)
    		->addFilter('StripTags')
    		->addFilter('StringTrim')
    		->addValidator('NotEmpty');
		$dcreation = new Zend_Form_Element_Text('dcreation');
		$dcreation->setLabel('Date of creation')
    		->setRequired(true)
    		->addFilter('StripTags')
    		->addFilter('StringTrim')
    		->addValidator('NotEmpty')
			->addValidator('Date', false, array('YYYY-MM-dd HH:mm:ss'));
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		$this->addElements(array($id, $name, $dcreation, $submit));
	}
}