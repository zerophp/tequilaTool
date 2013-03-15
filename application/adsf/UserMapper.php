<?php

class Application_Model_GuestbookMapper
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
            $this->setDbTable('Application_Model_DbTable_Users');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_User $user)
    {
        $data = array(
                
            'iduser' => $user->getIduser(), 
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'dbirth' => $user->getDbirth(),
            'password' => $user->getPassword(),
            'status_idstatus' => $user->getStatus()
                
                );

        if (null === ($id = $user->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('iduser = ?' => $id));
        }
    }

    public function find($id, Application_Model_User $user)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $user->setIduser($iduser)
                   ->setName($row->name)
                   ->setEmail($row->email)
                  ->setdbirth($row->dbirth)
                  ->setPassword($row->password)
                  ->setStatus($row->status);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Guestbook();
            $entry->setId($row->id)
            ->setName($row->name)
            ->setEmail($row->email)
            ->setdbirth($row->dbirth)
            ->setPassword($row->password)
            ->setStatus($row->status);

            $entries[] = $entry;
        }
        return $entries;
    }
}

