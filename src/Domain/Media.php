<?php

namespace datatransfer\Domain;

class Media 
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
    private $camera;

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
    
    public function getCamera() {
    	return $this->camera;
    }
    
    public function setCamera(Camera $camera) {
    	$this->camera = $camera;
    }
}
