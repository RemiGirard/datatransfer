<?php

namespace datatransfer\DAO;

use datatransfer\Domain\Codec;

class CodecDAO extends DAO
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
     * Return a list of all codecs for an media and a camera.
     *
     * @param integer $cameraId The camera id.
     * @param integer $mediaId The media id.
     *
     * @return array A list of all codecs for the camera and the media.
     */
    public function findAllByCameraMedia($cameraId,$mediaId) {
        // The associated media and camera is retrieved only once
        
		$camera = $this->cameraDAO->find($cameraId);
		$media = $this->mediaDAO->find($mediaId);
        // if mediaid is not selected by the SQL query
        // The article won't be retrieved during domain objet construction
        $sql = "SELECT codec.name, codec.id
FROM cameramediaformat
    inner join format on cameramediaformat.idformat = format.id
    inner join codec on format.idcodec = codec.id
where cameramediaformat.idcamera = ? AND cameramediaformat.idmedia = ?
ORDER BY codec.name";
        $result = $this->getDb()->fetchAll($sql, array($cameraId,$mediaId));

        // Convert query result to an array of domain objects
        $codecs = array();
        foreach ($result as $row) {
            $codecId = $row['id'];
            $codec = $this->buildDomainObject($row);
            // The associated media and camera are defined for the constructed codec
            $codec->setCamera($camera);
            $codec->setMedia($media);
            $codecs[$codecId] = $codec;
        }
        return $codecs;
    }

    /**
     * Creates an Codec object based on a DB row.
     *
     * @param array $row The DB row containing Codec data.
     * @return \datastransfer\Domain\Codec
     */
    protected function buildDomainObject($row) {
        $codec = new Codec();
        $codec->setId($row['id']);
        $codec->setTitle($row['name']);

        if (array_key_exists('idmedia', $row)) {
            // Find and set the associated media
            $mediaId = $row['idmedia'];
            $media = $this->mediaDAO->find($mediaId);
            $codec->setMedia($media);
        }
        
        if (array_key_exists('idcamera', $row)) {
            // Find and set the associated camera
            $cameraId = $row['idcamera'];
            $camera = $this->cameraDAO->find($cameraId);
            $codec->setCamera($camera);
        }
        
        
        return $codec;
    }

	public function find($id) {
        $sql = "select * from codec where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No codec matching id " . $id);
    }
    
}
