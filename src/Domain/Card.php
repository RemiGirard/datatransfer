<?php

namespace datatransfer\Domain;

class Card 
{
    /**
     * Card id.
     *
     * @var integer
     */
    private $id;

    /**
     * Card title.
     *
     * @var string
     */
    private $title;
    
    /**
     * Card writebitrate.
     *
     * @var string
     */
    private $writebitrate;
    
    /**
     * Card readbitrate.
     *
     * @var string
     */
    private $readbitrate;
    
    /**
     * Card size.
     *
     * @var string
     */
    private $capacity;
    
     /**
     * Associated media.
     *
     * @var \datatransfer\Domain
     */
    private $media;

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
    
    public function getWritebitrate() {
        return $this->writebitrate;
    }

    public function setWritebitrate($writebitrate) {
        $this->writebitrate = $writebitrate;
    }
    
    public function getReadbitrate() {
        return $this->readbitrate;
    }

    public function setReadbitrate($readbitrate) {
        $this->readbitrate = $readbitrate;
    }
    
    public function getCapacity() {
        return $this->capacity;
    }

    public function setCapacity($capacity) {
        $this->capacity = $capacity;
    }
    
    public function getMedia() {
    	return $this->media;
    }
    
    public function setMedia(Media $media) {
    	$this->media = $media;
    }
    
}
