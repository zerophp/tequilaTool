<?php

class Application_Model_DbTable_Status extends Zend_Db_Table_Abstract
{
    protected $_name = 'status';

    public function getStatus($idstatus)
    {
        $idstatus = (int)$idstatus;
        $row = $this->fetchRow('idstatus = ' . $idstatus);
        if (!$row) {
        throw new Exception("Could not find row $idstatus");
        }
        return $row->toArray();
    }
     
    public function addStatus($status)
    {
        $data = array(
           'status' => $status
        );
        $this->insert($data);
    }
    
    public function updateStatus($idstatus, $status)
    {
        $data = array(
            'status' => $status
        );
        $this->update($data, 'idstatus = '. (int)$idstatus);
    }
    
    public function deleteStatus($idstatus)
    {
        $this->delete('idstatus =' . (int)$idstatus);
    }
}
