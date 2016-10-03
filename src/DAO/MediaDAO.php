<?php

namespace datatransfer\DAO;

use datatransfer\Domain\Media;

class MediaDAO extends DAO
{
	/**
     * @var \datatransfer\DAO\CameraDAO
     */
    private $cameraDAO;

    public function setCameraDAO(CameraDAO $cameraDAO) {
        $this->cameraDAO = $cameraDAO;
    }

    /**
     * Return a list of all medias for an camera.
     *
     * @param integer $cameraId The camera id.
     *
     * @return array A list of all medias for the camera.
     */
    public function findAllByCamera($cameraId) {
        // The associated manufacturer is retrieved only once
        $camera = $this->cameraDAO->find($cameraId);

        // if cameraid is not selected by the SQL query
        // The camera won't be retrieved during domain objet construction
        $sql = "SELECT DISTINCT media.name, media.id FROM cameramediaformat INNER JOIN media ON cameramediaformat.idmedia = media.id WHERE idcamera=?";
        $result = $this->getDb()->fetchAll($sql, array($cameraId));

        // Convert query result to an array of domain objects
        $medias = array();
        foreach ($result as $row) {
            $mediaId = $row['id'];
            $media = $this->buildDomainObject($row);
            // The associated camera is defined for the constructed media
            $media->setCamera($camera);
            $medias[$mediaId] = $media;
        }
        return $medias;
    }

    /**
     * Creates an Media object based on a DB row.
     *
     * @param array $row The DB row containing Media data.
     * @return \datastransfer\Domain\Media
     */
    protected function buildDomainObject($row) {
        $media = new Media();
        $media->setId($row['id']);
        $media->setTitle($row['name']);

        if (array_key_exists('idcamera', $row)) {
            // Find and set the associated manufacturer
            $cameraId = $row['idcamera'];
            $camera = $this->cameraDAO->find($cameraId);
            $media->setCamera($camera);
        }
        
        return $media;
    }

	public function find($id) {
        $sql = "select * from media where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No media matching id " . $id);
    }

}
