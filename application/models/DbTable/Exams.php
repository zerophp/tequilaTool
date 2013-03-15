<?php

class Application_Model_DbTable_Exams extends Zend_Db_Table_Abstract
{
    protected $_name = 'exams';

    public function getExam($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('idexams = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }
    
    public function addExam($name, $dcreation)
    {
        $data = array(
        'name' => $name,
        'dcreation' => $dcreation,
        );
        $this->insert($data);
    }
    
    public function updateExam($id, $name, $dcreation)
    {
        $data = array(
        'name' => $name,
        'dcreation' => $dcreation,
        );
        $this->update($data, 'idexams = '. (int)$id);
    }
    
    public function deleteExam($id)
    {
        $this->delete('idexams =' . (int)$id);
    }
}