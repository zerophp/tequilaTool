<?php
class Application_Form_User extends Zend_Form
{
    public function init()
    {
        $this->setName('user');
        
        $iduser = new Zend_Form_Element_Hidden('iduser');
        
        $iduser->addFilter('Int');
        
        $name = new Zend_Form_Element_Text('name');
		$name->setLabel('Name')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
        		->setOptions(array('class'=>'nameAg'))
				->setDecorators(array(array('ViewScript', array(
				    'viewScript' => 'forms/_element_text.phtml'
				))))
				;
		
		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('Email')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty')
				->addValidator('EmailAddress');
		
		$dbirth = new Zend_Form_Element_Text('dbirth');
		$dbirth->setLabel('Birthday')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');
		
		
		
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password')
				->setRequired(true)
				->addFilter('StripTags')
				->addFilter('StringTrim')
				->addValidator('NotEmpty');
		
	
		$status = new Zend_Form_Element_Radio('status_idstatus');
		$status->setLabel('Status')
		->setRequired(true)
		->setMultiOptions(array(1=>'Active', 2=>'Desactive', 3=>'Finish'))
		->addValidator('NotEmpty');
		
		
		
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		
		$this->addElements(array($iduser, $name, $email, $dbirth, $password, $status, $submit));
    }
}