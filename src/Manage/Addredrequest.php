<?php

namespace datatransfer\Manage;

class Addredrequest 
{
    /**
     * idresmin.
     *
     * @var integer
     */
    private $idresmin;

    /**
     * idresmax.
     *
     * @var string
     */
    private $idresmax;
    
    /**
     * bits.
     *
     * @var \datatrasnfer\Manage
     */
    private $bits;
    
     /**
     * idformatstart.
     *
     * @var \datatrasnfer\Manage
     */
    private $idformatstart;
    
    /**
     * camera.
     *
     * @var \datatrasnfer\Manage
     */
    private $camera;
    
    /**
     * bitratemaxcam.
     *
     * @var \datatrasnfer\Manage
     */
    private $bitratemaxcam;
    
    /**
     * media1.
     *
     * @var \datatrasnfer\Manage
     */
    private $media1;
    
    /**
     * media3.
     *
     * @var \datatrasnfer\Manage
     */
    private $media2;
    
    /**
     * media3.
     *
     * @var \datatrasnfer\Manage
     */
    private $media3;
    
    /**
     * media4.
     *
     * @var \datatrasnfer\Manage
     */
    private $media4;
    
    /**
     * media5.
     *
     * @var \datatrasnfer\Manage
     */
    private $media5;
    
    /**
     * sourceinfo.
     *
     * @var \datatrasnfer\Manage
     */
    private $sourceinfo;
    
    /**
     * idres.
     *
     * @var \datatrasnfer\Manage
     */
    private $idres;
    
     /**
     * resdetail.
     *
     * @var \datatrasnfer\Manage
     */
    private $resdetail;
     /**
     * reswidth.
     *
     * @var \datatrasnfer\Manage
     */
    private $reswidth;
     /**
     * resheight.
     *
     * @var \datatrasnfer\Manage
     */
    private $resheight;
     /**
     * codecompression.
     *
     * @var \datatrasnfer\Manage
     */
    private $codeccompression;
     /**
     * idcod.
     *
     * @var \datatrasnfer\Manage
     */
    private $idcod;
     /**
     * calculdudebit.
     *
     * @var \datatrasnfer\Manage
     */
    private $calculdudebit;
     /**
     * idformat.
     *
     * @var \datatrasnfer\Manage
     */
    private $idformat;
     /**
     * idcodec.
     *
     * @var \datatrasnfer\Manage
     */
    private $idcodec;
     /**
     * idresolution.
     *
     * @var \datatrasnfer\Manage
     */
    private $idresolution;
     /**
     * idframerate.
     *
     * @var \datatrasnfer\Manage
     */
    private $idframerate;
     /**
     * sampling.
     *
     * @var \datatrasnfer\Manage
     */
    private $sampling;
     /**
     * bitrate.
     *
     * @var \datatrasnfer\Manage
     */
    private $bitrate;
     /**
     * bitratemax.
     *
     * @var \datatrasnfer\Manage
     */
    private $bitratemax;
     /**
     * source.
     *
     * @var \datatrasnfer\Manage
     */
    private $source;
     /**
     * idcamera.
     *
     * @var \datatrasnfer\Manage
     */
    private $idcamera;
     /**
     * idmedia.
     *
     * @var \datatrasnfer\Manage
     */
    private $idmedia;
    
    
    

    public function getIdresmin() {
        return $this->idresmin;
    }

    public function setIdresmin($idresmin) {
        $this->idresmin = $idresmin;
    }

    public function getIdresmax() {
        return $this->idresmax;
    }

    public function setIdresmax($idresmax) {
        $this->idresmax = $idresmax;
    }
    
   public function getBits() {
        return $this->bits;
    }

    public function setBits($bits) {
        $this->bits = $bits;
    }
    public function getIdformatstart() {
        return $this->idformatstart;
    }

    public function setIdformatstart($idformatstart) {
        $this->idformatstart = $idformatstart;
    }
	public function getCamera() {
        return $this->camera;
    }

    public function setCamera($camera) {
        $this->camera = $camera;
    }
    public function getBitratemaxcam() {
        return $this->bitratemaxcam;
    }

    public function setBitratemaxcam($bitratemaxcam) {
        $this->bitratemaxcam = $bitratemaxcam;
    }
    public function getMedia1() {
        return $this->media1;
    }

    public function setMedia1($media1) {
        $this->media1 = $media1;
    }
    public function getMedia2() {
        return $this->media2;
    }

    public function setMedia2($media2) {
        $this->media2 = $media2;
    }
    public function getMedia3() {
        return $this->media3;
    }

    public function setMedia3($media3) {
        $this->media3 = $media3;
    }
    
    public function getMedia4() {
        return $this->media4;
    }

    public function setMedia4($media4) {
        $this->media4 = $media4;
    }
    public function getMedia5() {
        return $this->media5;
    }

    public function setMedia5($media5) {
        $this->media5 = $media5;
    }
    public function getSourceinfo() {
        return $this->sourceinfo;
    }

    public function setSourceinfo($sourceinfo) {
        $this->sourceinfo = $sourceinfo;
    }
    
     public function setIdres($idres) {
        $this->idres = $idres;
    }
    public function getIdres() {
        return $this->idres;
    }
      public function setResdetail($resdetail) {
        $this->resdetail = $resdetail;
    }
    public function getResdetail() {
        return $this->resdetail;
    }
      public function setReswidth($reswidth) {
        $this->reswidth = $reswidth;
    }
    public function getReswidth() {
        return $this->reswidth;
    }
      public function setResheight($resheight) {
        $this->resheight = $resheight;
    }
    public function getResheight() {
        return $this->resheight;
    }
  public function setCodeccompression($codeccompression) {
        $this->codeccompression = $codeccompression;
    }
    public function getCodeccompression() {
        return $this->codeccompression;
    }
  public function setIdcod($idcod) {
        $this->idcod = $idcod;
    }
    public function getIdcod() {
        return $this->idcod;
    }
  public function setCalculdudebit($calculdudebit) {
        $this->calculdudebit = $calculdudebit;
    }
    public function getCalculdudebit() {
        return $this->calculdudebit;
    }
  public function setIdformat($idformat) {
        $this->idformat = $idformat;
    }
    public function getIdformat() {
        return $this->idformat;
    }
  public function setIdcodec($idcodec) {
        $this->idcodec = $idcodec;
    }
    public function getIdcodec() {
        return $this->idcodec;
    }
  public function setIdresolution($idresolution) {
        $this->idresolution = $idresolution;
    }
    public function getIdresolution() {
        return $this->idresolution;
    }
	  public function setIdframerate($idframerate) {
        $this->idframerate = $idframerate;
    }
    public function getIdframerate() {
        return $this->idframerate;
    }
      public function setSampling($sampling) {
        $this->sampling = $sampling;
    }
    public function getSampling() {
        return $this->sampling;
    }
  public function setBitrate($bitrate) {
        $this->bitrate = $bitrate;
    }
    public function getBitrate() {
        return $this->bitrate;
    }
      public function setBitratemax($bitratemax) {
        $this->bitratemax = $bitratemax;
    }
    public function getBitratemax() {
        return $this->bitratemax;
    }
      public function setSource($source) {
        $this->source = $source;
    }
    public function getSource() {
        return $this->source;
    }
      public function setIdcamera($idcamera) {
        $this->idcamera = $idcamera;
    }
    public function getIdcamera() {
        return $this->idcamera;
    }
      public function setIdmedia($idmedia) {
        $this->idmedia = $idmedia;
    }
    public function getIdmedia() {
        return $this->idmedia;
    }
}
