<?php

class Application_Model_DbTable_Examinations extends Zend_Db_Table_Abstract
{
    protected $_name = 'examinations';

    public function getExamination($id)
    {
    	$id = (int)$id;
    	$row = $this->fetchRow('idexaminations = ' . $id);
    	if (!$row) {
    		throw new Exception("Could not find row $id");
    	}
    	return $row->toArray();
    }
    
    public function addExamination($idexaminations,$courses_idcourses,$exams_idexams,$dini,$dfini)
    {
    	$data = array(
    			'idexaminations' => $idexaminations,
    			'courses_idcourses' => $courses_idcourses,
    			'exams_idexams' => $exams_idexams,
    			'dini' => $dini,
    			'dfini' => $dfini,
    	);
    	$this->insert($data);
    }

    public function updateExamination($idexaminations,$courses_idcourses,$exams_idexams,$dini,$dfini)
    {
    	$data = array(
    			'courses_idcourses' => $courses_idcourses,
    			'exams_idexams' => $exams_idexams,
    			'dini' => $dini,
    			'dfini' => $dfini,
    	);
    	$this->update($data, 'idexaminations = '. (int)$idexaminations);
    }
    
    public function deleteExamination($id)
    {
    	$this->delete('idexaminations =' . (int)$id);
    }
       
}
