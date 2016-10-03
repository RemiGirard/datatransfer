<?php

namespace datatransfer\DAO;

use datatransfer\Domain\Formatbitrate;

class FormatbitrateDAO extends DAO
{
	  /**
     * @var \datatransfer\DAO\ResolutionDAO
     */
    private $resolutionDAO;

    public function setResolutionDAO(ResolutionDAO $resolutionDAO) {
        $this->resolutionDAO = $resolutionDAO;
    }
	/**
     * @var \datatransfer\DAO\MediaDAO
     */
    private $mediaDAO;

    public function setMediaDAO(MediaDAO $mediaDAO) {
        $this->mediaDAO = $mediaDAO;
    }
    
    /**
     * @var \datatransfer\DAO\CameraDAO
     */
    private $cameraDAO;

    public function setCameraDAO(CameraDAO $cameraDAO) {
        $this->cameraDAO = $cameraDAO;
    }
    
    /**
     * @var \datatransfer\DAO\CodecDAO
     */
    private $codecDAO;

    public function setCodecDAO(CodecDAO $codecDAO) {
        $this->codecDAO = $codecDAO;
    }
    
  

    /**
     * Return a list of all formatbitrates for an media, a camera, a codec and a resolution.
     *
     * @param integer $cameraId The camera id.
     * @param integer $mediaId The media id.
     * @param integer $codecId The codec id.
     * @param integer $resolutionId The resolution id.
     *
     * @return array A list of all formatbitrates for the camera, the media, the codec and he resolution.
     */
    public function findAllByCameraMediaCodecResolution($cameraId,$mediaId,$codecId,$resolutionId) {
        // The associated media, camera, codec and resolution are retrieved only once
		$camera = $this->cameraDAO->find($cameraId);
		$media = $this->mediaDAO->find($mediaId);
		$codec = $this->codecDAO->find($codecId);
		$resolution = $this->resolutionDAO->find($resolutionId);
        // if mediaid is not selected by the SQL query
        // The article won't be retrieved during domain objet construction
        $sql = "SELECT format.bitrate
FROM cameramediaformat
    inner join format on cameramediaformat.idformat = format.id
where cameramediaformat.idcamera = ? AND cameramediaformat.idmedia = ? AND format.idcodec = ? AND format.idresolution = ?";
        $result = $this->getDb()->fetchAll($sql, array($cameraId,$mediaId,$codecId,$resolutionId));

        // Convert query result to an array of domain objects
        $formatbitrates = array();
        foreach ($result as $row) {
            $formatbitrateId = $row['bitrate'];
            $formatbitrate = $this->buildDomainObject($row);
            // The associated media, camera, codec and resolution are defined for the constructed formatbitrate
            $formatbitrate->setCamera($camera);
            $formatbitrate->setMedia($media);
            $formatbitrate->setCodec($codec);
            $formatbitrate->settheResolution($resolution);
            $formatbitrates[$formatbitrateId] = $formatbitrate;
        }
        return $formatbitrates;
    }

    /**
     * Creates an Formatbitrate object based on a DB row.
     *
     * @param array $row The DB row containing Formatbitrate data.
     * @return \datastransfer\Domain\Formatbitrate
     */
    protected function buildDomainObject($row) {
        $formatbitrate = new Formatbitrate();
        $formatbitrate->setId($row['bitrate']);
        $formatbitrate->setTitle($row['bitrate']);

        if (array_key_exists('idmedia', $row)) {
            // Find and set the associated media
            $mediaId = $row['idmedia'];
            $media = $this->mediaDAO->find($mediaId);
            $formatbitrate->setMedia($media);
        }
        
        if (array_key_exists('idcamera', $row)) {
            // Find and set the associated camera
            $cameraId = $row['idcamera'];
            $camera = $this->cameraDAO->find($cameraId);
            $formatbitrate->setCamera($camera);
        }
        
        if (array_key_exists('idcodec', $row)) {
            // Find and set the associated codec
            $codecId = $row['idcodec'];
            $codec = $this->codecDAO->find($codecId);
            $formatbitrate->setCodec($codec);
        }
        
        if (array_key_exists('idresolution', $row)) {
            // Find and set the associated codec
            $resolutionId = $row['idresolution'];
            $resolution = $this->resolutionDAO->find($resolutionId);
            $formatbitrate->settheResolution($resolution);
        }
        
        return $formatbitrate;
    }

    
}
