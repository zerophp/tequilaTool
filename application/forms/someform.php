<?php

class Client_Form_Client extends Zend_Form 
{
	 
	public function init() 
	{

		$this->setName('client');
		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');
		$id->removeDecorator('label');
		
		$company_types_id = new Zend_Form_Element_Select('company_types_id');
		$company_types_id->setLabel('Type')
			->setRequired(true)
			->addValidator('NotEmpty', true)
			->setmultiOptions($this->_selectOptionsCompanyTypes())
			->setAttrib('maxlength', 200)
			->setAttrib('size', 1)
			->setAttrib("class","toolboxdrop")
			->setDecorators(array(array('ViewScript', array(
					'viewScript' => 'forms/_element_select.phtml'))))
			;
			
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setValue('Guardar')
			->setAttrib('id', 'submitbutton')
			->setDecorators(array(array('ViewScript', array(
				'viewScript' => 'forms/_element_submit.phtml'))))
			->setAttrib('class', 'btn')
			->removeDecorator('label')
			;
			
		$this->addElements(array($id,$company_types_id,$submit));
	 }
		
	protected function _selectOptionsCompanyTypes() 
	{
		$sql = "SELECT id,name
                 FROM company_types
                 ORDER BY name";
		$db = Zend_Registry::get('db');
		$result = $db->fetchPairs($sql);
		return $result;
	}
		
}