<?php

class Application_Model_DbTable_Courses extends Zend_Db_Table_Abstract
{
    protected $_name = 'courses';
    
    
    public function deleteCourse($idcourses)
    {
    	$this->delete('idcourses =' . (int)$idcourses);
    }
    
    public function getCourse($idcourses)
    {
    	$idcourses = (int)$idcourses;
    	$row = $this->fetchRow('idcourses = ' . $idcourses);
    	if (!$row) {
    		throw new Exception("Could not find row $idcourses");
    	}
    	return $row->toArray();
    }
    
    public function addCourse($course, $description, $dini, $dfini)
    {
    	$data = array(
    			'course'   => $course,
           		'dini' => $dini,
            	'dfini' => $dfini,
        		'description' => $description,
    	);
    	$this->insert($data);
    }
    
    public function updateCourse($idcourses, $course, $description, $dini, $dfini)
    {
    	$data = array(
    			'course' => $course,
           		'dini' => $dini,
            	'dfini' => $dfini,
        		'description' => $description,
    	);
    	$this->update($data, 'idcourses = '. (int)$idcourses);
    }
}
