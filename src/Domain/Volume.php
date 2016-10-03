<?php

namespace datatransfer\Domain;

class Volume 
{
    /**
     * Volume id.
     *
     * @var integer
     */
    private $id;

    /**
     * Volume title.
     *
     * @var string
     */
    private $title;
    
    /**
     * Volume writebitrate.
     *
     * @var string
     */
    private $writebitrate;
    
    /**
     * Volume readbitrate.
     *
     * @var string
     */
    private $readbitrate;

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
}
