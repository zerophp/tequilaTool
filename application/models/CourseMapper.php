<?php

class Application_Model_CourseMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Course');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Course $course)
    {
       // print_r($course);
        
        
        $data = array(
            'course'   => $course->getCourse(),
            'dini' => $course->getDini(),
            'dfini' => $course->getDfini(),
        );


        if (null === ($idcourses = $course->getIdCourses())) {
            unset($data['idcourses']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('idcourses = ?' => $idcourses ));
        }
    }

    public function find($id, Application_Model_Course $course)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        
        
        $course->setIdCourses($row->idcourses)
                  ->setCourse($row->course)
                  ->setDini($row->dini)
                  ->setDfini($row->dfini);
        
        return array($row->idcourses,$row->course,$row->dini,$row->dfini);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Course();
            $entry->setIdCourses($row->idcourses)
                  ->setCourse($row->course)
                  ->setDini($row->dini)
                  ->setDfini($row->dfini);
            $entries[] = $entry;
        }
        return $entries;
    }
}

