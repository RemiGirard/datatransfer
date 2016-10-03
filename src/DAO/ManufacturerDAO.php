<?php

namespace datatransfer\DAO;

use datatransfer\Domain\Manufacturer;

class ManufacturerDAO extends DAO
{
    /**
     * Return a list of all manufacturer.
     *
     * @return array A list of all manufacturer.
     */
    public function findAll() {
        $sql = "SELECT * FROM manufacturer";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $manufacturers = array();
        foreach ($result as $row) {
            $manufacturerId = $row['id'];
            $manufacturers[$manufacturerId] = $this->buildDomainObject($row);
        }
        return $manufacturers;
    }


    /**
     * Creates an Manufacturer object based on a DB row.
     *
     * @param array $row The DB row containing Manufacturer data.
     * @return \MicroCMS\Domain\Manufacturer
     */
    protected function buildDomainObject($row) {
        $manufacturer = new Manufacturer();
        $manufacturer->setId($row['id']);
        $manufacturer->setTitle($row['name']);
        return $manufacturer;
    }
    
    /**
     * Returns an manufacturer matching the supplied id.
     *
     * @param integer $id
     *
     * @return \datatransfer\Domain\Manufacturer|throws an exception if no matching manufacturer is found
     */
    public function find($id) {
        $sql = "select * from manufacturer where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No manufacturer matching id " . $id);
    }

}
