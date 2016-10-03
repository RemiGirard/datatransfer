<?php

namespace datatransfer\Domain;

class Camera 
{
    /**
     * Camera id.
     *
     * @var integer
     */
    private $id;

    /**
     * Camera title.
     *
     * @var string
     */
    private $title;
    
     /**
     * Associated manufacturer.
     *
     * @var \datatrasnfer\Domain
     */
    private $manufacturer;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function getManufacturer() {
    	return $this->manufacturer;
    }
    
    public function setManufacturer(Manufacturer $manufacturer) {
    	$this->manufacturer = $manufacturer;
    }
}
