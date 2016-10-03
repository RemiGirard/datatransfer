<?php

namespace datatransfer\DAO;

use datatransfer\Domain\Control;

class ControlDAO extends DAO
{
	/**
     * @var \datatransfer\DAO\SoftwareDAO
     */
    private $softwareDAO;

    public function setSoftwareDAO(SoftwareDAO $softwareDAO) {
        $this->softwareDAO = $softwareDAO;
    }

    /**
     * Return a list of all controls for an software.
     *
     * @param integer $softwareId The software id.
     *
     * @return array A list of all controls for the software.
     */
    public function findAllBySoftware($softwareId) {
        // The associated software is retrieved only once
        $software = $this->softwareDAO->find($softwareId);

        // if softwareid is not selected by the SQL query
        // The article won't be retrieved during domain objet construction
        $sql = "SELECT control.id, control.name, control.coefficient FROM softwarecontrol
        inner join control on softwarecontrol.idcontrol = control.id
         WHERE idsoftware=?";
        
        $result = $this->getDb()->fetchAll($sql, array($softwareId));

        // Convert query result to an array of domain objects
        $controls = array();
        foreach ($result as $row) {
            $controlId = $row['id'];
            $control = $this->buildDomainObject($row);
            // The associated software is defined for the constructed control
            $control->setSoftware($software);
            $controls[$controlId] = $control;
        }
        return $controls;
    }

    /**
     * Creates an Control object based on a DB row.
     *
     * @param array $row The DB row containing Control data.
     * @return \datastransfer\Domain\Control
     */
    protected function buildDomainObject($row) {
        $control = new Control();
        $control->setId($row['id']);
        $control->setTitle($row['name']);
        $control->setCoefficient($row['coefficient']);        
        return $control;
    }

	public function find($id) {
        $sql = "select * from control where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No control matching id " . $id);
    }
    
}
