<?php

class Application_Form_Status extends Zend_Form
{
	public function init()
	{
		$this->setName('status');
		
		$idstatus = new Zend_Form_Element_Hidden('idstatus');
		$idstatus->addFilter('Int');
		$status = new Zend_Form_Element_Text('status');
		$status->setLabel('status')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('idstatus', 'submitbutton');
		
		$this->addElements(array($idstatus, $status, $submit));
	}
}