<?php

namespace datatransfer\Domain;

class Codec 
{
    /**
     * Codec id.
     *
     * @var integer
     */
    private $id;

    /**
     * Codec title.
     *
     * @var string
     */
    private $title;    
    
     /**
     * Associated media.
     *
     * @var \datatransfer\Domain
     */
    private $media;
    
     /**
     * Associated camera.
     *
     * @var \datatransfer\Domain
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
    
    public function getMedia() {
    	return $this->media;
    }
    
     public function getCamera() {
    	return $this->camera;
    }
    
    public function setMedia(Media $media) {
    	$this->media = $media;
    }
    
    public function setCamera(Camera $camera) {
    	$this->camera = $camera;
    }
}
