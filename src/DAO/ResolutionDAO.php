<?php

namespace datatransfer\DAO;

use datatransfer\Domain\Resolution;

class ResolutionDAO extends DAO
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
     * Return a list of all resolutions for an media, a camera and a codec.
     *
     * @param integer $cameraId The camera id.
     * @param integer $mediaId The media id.
     * @param integer $codecId The codec id.
     *
     * @return array A list of all resolutions for the camera, the media and the codec.
     */
    public function findAllByCameraMediaCodec($cameraId,$mediaId,$codecId) {
        // The associated media, camera and codec are retrieved only once
		$camera = $this->cameraDAO->find($cameraId);
		$media = $this->mediaDAO->find($mediaId);
		$codec = $this->codecDAO->find($codecId);
        // if mediaid is not selected by the SQL query
        // The article won't be retrieved during domain objet construction
        $sql = "SELECT resolution.name, resolution.id, resolution.detail
FROM cameramediaformat
    inner join format on cameramediaformat.idformat = format.id
    inner join resolution on format.idresolution = resolution.id
where cameramediaformat.idcamera = ? AND cameramediaformat.idmedia = ? AND format.idcodec = ?";
        $result = $this->getDb()->fetchAll($sql, array($cameraId,$mediaId,$codecId));

        // Convert query result to an array of domain objects
        $resolutions = array();
        foreach ($result as $row) {
            $resolutionId = $row['id'];
            $resolution = $this->buildDomainObject($row);
            // The associated media, camera and codec are defined for the constructed resolution
            $resolution->setCamera($camera);
            $resolution->setMedia($media);
            $resolution->setCodec($codec);
            $resolutions[$resolutionId] = $resolution;
        }
        return $resolutions;
    }

    /**
     * Creates an Resolution object based on a DB row.
     *
     * @param array $row The DB row containing Resolution data.
     * @return \datastransfer\Domain\Resolution
     */
    protected function buildDomainObject($row) {
        $resolution = new Resolution();
        $resolution->setId($row['id']);
        $resolution->setTitle($row['name']);
        $resolution->setDetail($row['detail']);

        if (array_key_exists('idmedia', $row)) {
            // Find and set the associated media
            $mediaId = $row['idmedia'];
            $media = $this->mediaDAO->find($mediaId);
            $resolution->setMedia($media);
        }
        
        if (array_key_exists('idcamera', $row)) {
            // Find and set the associated camera
            $cameraId = $row['idcamera'];
            $camera = $this->cameraDAO->find($cameraId);
            $resolution->setCamera($camera);
        }
        
        if (array_key_exists('idcodec', $row)) {
            // Find and set the associated codec
            $codecId = $row['idcodec'];
            $codec = $this->codecDAO->find($codecId);
            $resolution->setCodec($codec);
        }
        
        return $resolution;
    }

	public function find($id) {
        $sql = "select * from resolution where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No resolution matching id " . $id);
    }
    
}
