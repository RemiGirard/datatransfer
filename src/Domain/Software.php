<?php

namespace datatransfer\Domain;

class Software 
{
    /**
     * Software id.
     *
     * @var integer
     */
    private $id;

    /**
     * Software title.
     *
     * @var string
     */
    private $title;
    
    
    /**
     * Software checksource.
     *
     * @var string
     */
    private $checksource;


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
    
    public function getChecksource() {
        return $this->checksource;
    }

    public function setChecksource($checksource) {
        $this->checksource = $checksource;
    }
}
