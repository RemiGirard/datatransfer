<?php

namespace datatransfer\Domain;

class Control 
{
    /**
     * Control id.
     *
     * @var integer
     */
    private $id;

    /**
     * Control title.
     *
     * @var string
     */
    private $title;
    
    /**
     * Control coefficient.
     *
     * @var \datatrasnfer\Domain
     */
    private $coefficient;
    
     /**
     * Associated software.
     *
     * @var \datatrasnfer\Domain
     */
    private $software;
    

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
    
     public function getCoefficient() {
        return $this->coefficient;
    }

    public function setCoefficient($coefficient) {
        $this->coefficient = $coefficient;
    }
    
    public function getSoftware() {
    	return $this->software;
    }
    
    public function setSoftware(Software $software) {
    	$this->software = $software;
    }
}
