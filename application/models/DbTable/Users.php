<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{
    protected $_name = 'users';

    public function getUser($iduser)
    {
        $iduser = (int)$iduser;
        $row = $this->fetchRow('idusers = ' . $iduser);
        if (!$row) {
        throw new Exception("Could not find row $iduser");
        }
        return $row->toArray();
    }
    
    public function addUser($user)
    {
        $data = array(
           'name' => $user->getName(),
           'email' => $user->getEmail(),
           'dbirth' => $user->getDbirth(),
           'password' => $user->getPassword(),
           'status_idstatus' => $user->getStatus(),
        );
        $this->insert($data);
    }
    
    public function updateUser($user)
    {
        $data = array(
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'dbirth' => $user->getDbirth(),
            'password' => $user->getPassword(),
            'status_idstatus' => $user->getStatus(),
        );
               
        $this->update($data, 'idusers = '. (int)$user->getIduser());
    }
    
    public function deleteUser($id)
    {
        $this->delete('idusers =' . (int)$id);
    }
}
