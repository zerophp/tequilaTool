<?php

class Application_Model_ExaminationsMapper
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
            $this->setDbTable('Application_Model_DbTable_Examinations');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Examinations $examinations)
    {
        $data = array(
            'date'   => $examinations->getDate(),
        );

        if (null === ($idexaminations = $examinations->getId())) {
            unset($data['idexaminations']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('idexaminations = ?' => $idexaminations));
        }
    }

    public function find($idexaminations, Application_Model_Examinations $examinations)
    {
        $result = $this->getDbTable()->find($idexaminations);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $examinations->setId($row->idexaminations)
                  ->setDate($row->date);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Examinations();
            $entry->setId($row->idexaminations)
                  ->setDate($row->date);
            $entries[] = $entry;
        }
        return $entries;
    }
}

