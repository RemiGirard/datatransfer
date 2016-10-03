<?php

namespace datatransfer\Domain;

class Plug 
{
    /**
     * Plug id.
     *
     * @var integer
     */
    private $id;

    /**
     * Plug title.
     *
     * @var string
     */
    private $title;
    
    /**
     * Plug bitrate.
     *
     * @var string
     */
    private $bitrate;

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
    
    public function getbitrate() {
        return $this->bitrate;
    }

    public function setBitrate($bitrate) {
        $this->bitrate = $bitrate;
    }
}
