<?php

namespace datatransfer\DAO;

use datatransfer\Domain\Formatbitrate;

class FramerateDAO extends DAO
{
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
     * @var \datatransfer\DAO\ResolutionDAO
     */
    private $resolutionDAO;

    public function setResolutionDAO(ResolutionDAO $resolutionDAO) {
        $this->resolutionDAO = $resolutionDAO;
    }

    /**
     * Return a list of all framerates for an media, a camera, a codec and a resolution.
     *
     * @param integer $cameraId The camera id.
     * @param integer $mediaId The media id.
     * @param integer $codecId The codec id.
     * @param integer $resolutionId The resolution id.
     *
     * @return array A list of all framerates for the camera, the media, the codec and he resolution.
     */
    public function findAllByCameraMediaCodecResolution($cameraId,$mediaId,$codecId,$resolutionId) {
        // The associated media, camera, codec and resolution are retrieved only once
		$camera = $this->cameraDAO->find($cameraId);
		$media = $this->mediaDAO->find($mediaId);
		$codec = $this->codecDAO->find($codecId);
		$resolution = $this->resolutionDAO->find($resolutionId);
        // if mediaid is not selected by the SQL query
        // The article won't be retrieved during domain objet construction
        $sql = "SELECT framerate.name, framerate.id
FROM cameramediaformat
    inner join format on cameramediaformat.idformat = format.id
    inner join framerate on format.idframerate = framerate.id
where cameramediaformat.idcamera = ? AND cameramediaformat.idmedia = ? AND format.idcodec = ? AND format.idresolution = ?";
        $result = $this->getDb()->fetchAll($sql, array($cameraId,$mediaId,$codecId,$resolutionId));

        // Convert query result to an array of domain objects
        $framerates = array();
        foreach ($result as $row) {
            $framerateId = $row['id'];
            $framerate = $this->buildDomainObject($row);
            // The associated media, camera, codec and resolution are defined for the constructed framerate
            $framerate->setCamera($camera);
            $framerate->setMedia($media);
            $framerate->setCodec($codec);
            $framerate->settheResolution($resolution);
            $framerates[$framerateId] = $framerate;
        }
        return $framerates;
    }

    /**
     * Creates an Framerate object based on a DB row.
     *
     * @param array $row The DB row containing Framerate data.
     * @return \datastransfer\Domain\Framerate
     */
    protected function buildDomainObject($row) {
        $framerate = new Formatbitrate();
        $framerate->setId($row['id']);
        $framerate->setTitle($row['name']);

        if (array_key_exists('idmedia', $row)) {
            // Find and set the associated media
            $mediaId = $row['idmedia'];
            $media = $this->mediaDAO->find($mediaId);
            $framerate->setMedia($media);
        }
        
        if (array_key_exists('idcamera', $row)) {
            // Find and set the associated camera
            $cameraId = $row['idcamera'];
            $camera = $this->cameraDAO->find($cameraId);
            $framerate->setCamera($camera);
        }
        
        if (array_key_exists('idcodec', $row)) {
            // Find and set the associated codec
            $codecId = $row['idcodec'];
            $codec = $this->codecDAO->find($codecId);
            $framerate->setCodec($codec);
        }
        
        if (array_key_exists('idresolution', $row)) {
            // Find and set the associated codec
            $resolutionId = $row['idresolution'];
            $resolution = $this->resolutionDAO->find($resolutionId);
            $framerate->settheResolution($resolution);
        }
        
        return $framerate;
    }

	public function find($id) {
        $sql = "select * from framerate where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No framerate matching id " . $id);
    }
    
}
