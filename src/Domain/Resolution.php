<?php

namespace datatransfer\Domain;

class Resolution 
{
    /**
     * Resolution id.
     *
     * @var integer
     */
    private $id;

    /**
     * Resolution title.
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
    
    /**
     * Associated codec.
     *
     * @var \datatransfer\Domain
     */
    private $codec;
    
     /**
     * Associated detail.
     *
     * @var string
     */
    private $detail;

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
    
	public function getCodec() {
    	return $this->codec;
    }
    
    public function setMedia(Media $media) {
    	$this->media = $media;
    }
    
    public function setCamera(Camera $camera) {
    	$this->camera = $camera;
    }
    
    public function setCodec(Codec $codec) {
    	$this->codec = $codec;
    }
	public function getDetail() {
    	return $this->detail;
    }
    public function setDetail($detail) {
    	$this->detail = $detail;
    }

}
