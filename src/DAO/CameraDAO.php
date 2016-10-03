<?php

namespace datatransfer\DAO;

use datatransfer\Domain\Camera;

class CameraDAO extends DAO
{
	/**
     * @var \datatransfer\DAO\ManufacturerDAO
     */
    private $manufacturerDAO;

    public function setManufacturerDAO(ManufacturerDAO $manufacturerDAO) {
        $this->manufacturerDAO = $manufacturerDAO;
    }

    /**
     * Return a list of all cameras for an manufacturer.
     *
     * @param integer $manufacturerId The manufacturer id.
     *
     * @return array A list of all cameras for the manufacturer.
     */
    public function findAllByManufacturer($manufacturerId) {
        // The associated manufacturer is retrieved only once
        $manufacturer = $this->manufacturerDAO->find($manufacturerId);

        // if manufacturerid is not selected by the SQL query
        // The article won't be retrieved during domain objet construction
        $sql = "SELECT id, name FROM camera WHERE idmanufacturer=?";
        $result = $this->getDb()->fetchAll($sql, array($manufacturerId));

        // Convert query result to an array of domain objects
        $cameras = array();
        foreach ($result as $row) {
            $cameraId = $row['id'];
            $camera = $this->buildDomainObject($row);
            // The associated manufacturer is defined for the constructed camera
            $camera->setManufacturer($manufacturer);
            $cameras[$cameraId] = $camera;
        }
        return $cameras;
    }

    /**
     * Creates an Camera object based on a DB row.
     *
     * @param array $row The DB row containing Camera data.
     * @return \datastransfer\Domain\Camera
     */
    protected function buildDomainObject($row) {
        $camera = new Camera();
        $camera->setId($row['id']);
        $camera->setTitle($row['name']);

        if (array_key_exists('idmanufacturer', $row)) {
            // Find and set the associated manufacturer
            $manufacturerId = $row['idmanufacturer'];
            $manufacturer = $this->manufacturerDAO->find($manufacturerId);
            $camera->setManufacturer($manufacturer);
        }
        
        return $camera;
    }

	public function find($id) {
        $sql = "select * from camera where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No camera matching id " . $id);
    }
    
}
