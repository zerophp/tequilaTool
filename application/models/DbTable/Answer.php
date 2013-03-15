<?php

class Application_Model_DbTable_Answer extends Zend_Db_Table_Abstract
{
    protected $_name = 'answers';
    
    public function getAnswer($id)
    {
    	$id = (int)$id;
    	$row = $this->fetchRow('idanswer = ' . $id);
    	if (!$row) {
    		throw new Exception("Could not find row $id");
    	}
    	return $row->toArray();
    }
    
    public function addAnswer($users_idusers, $examinations_idexaminations, $answer, $questions_idquestion)
    {
    	$data = array(
    			'users_idusers' => $users_idusers,
    			'examinations_idexaminations' => $examinations_idexaminations,
    			'answer' => $answer,
    			'questions_idquestions' => $questions_idquestion,
    	);
    	$this->addAnswerArray($data);
    }
    
    public function addAnswerArray(array $data)
    {
    	$this->insert($data);
    }
    
    public function updateUser($id, $name, $email, $password, $address, $description, $pets, $genders_idgender, $cities_idcity, $photo)
    {
    	$data = array(
    			'name' => $name,
    			'email' => $email,
    			'password' => $password,
    			'address' => $address,
    			'description' => $description,
    			'pets' => $pets,
    			'photo' => $photo,
    			'genders_idgender' => $genders_idgender,
    			'cities_idcity' => $cities_idcity,
    			'roles_idrole' => '9',
    	);
    	$this->update($data, 'iduser = '. (int)$id);
    	die();
    }
    
    public function deleteUser($id)
    {
    	$this->delete('iduser =' . (int)$id);
    }
}
