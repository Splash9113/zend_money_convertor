<?php

class Application_Model_CurrencyMapper
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
            $this->setDbTable('Application_Model_DbTable_Currency');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Currency $currency)
    {
        $data = array(
            'name'   => $currency->getName()
        );

        if (null === ($id = $currency->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $currency = new Application_Model_Currency();
        return $currency->setId($row->id)
            ->setName($row->name);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Currency();
            $entry->setId($row->id)
                ->setName($row->name);
            $entries[] = $entry;
        }
        return $entries;
    }
}

