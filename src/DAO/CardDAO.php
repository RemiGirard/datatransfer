<?php

namespace datatransfer\DAO;

use datatransfer\Domain\Card;

class CardDAO extends DAO
{
	/**
     * @var \datatransfer\DAO\MediaDAO
     */
    private $mediaDAO;

    public function setMediaDAO(MediaDAO $mediaDAO) {
        $this->mediaDAO = $mediaDAO;
    }

    /**
     * Return a list of all cards for a media.
     *
     * @param integer $mediaId The media id.
     *
     * @return array A list of all cards for the media.
     */
    public function findAllByMedia($mediaId) {
        // The associated media is retrieved only once
        
		$media = $this->mediaDAO->find($mediaId);
        // if mediaid is not selected by the SQL query
        // The media won't be retrieved during domain objet construction
        $sql = "SELECT card.id, card.name, card.writebitrate, card.readbitrate, card.capacity
				FROM card
				WHERE card.idmedia= ?";
        $result = $this->getDb()->fetchAll($sql, array($mediaId));

        // Convert query result to an array of domain objects
        $cards = array();
        foreach ($result as $row) {
            $cardId = $row['id'];
            $card = $this->buildDomainObject($row);
            // The associated media are defined for the constructed card
            $card->setMedia($media);
            $cards[$cardId] = $card;
        }
        return $cards;
    }
    
    /**
     * Return a card.
     *
     * @param integer $cardid.
     *
     * @return array a card.
     */
	public function findTheCardInfo($cardid){
		$sql = "select * from card where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($cardid));
        $card = $this->buildDomainObject($row);
        $thecard=array();
        $thecard[$cardid]=$card;
        return $thecard;
	}


    /**
     * Creates an Card object based on a DB row.
     *
     * @param array $row The DB row containing Card data.
     * @return \datastransfer\Domain\Card
     */
    protected function buildDomainObject($row) {
        $card = new Card();
        $card->setId($row['id']);
        $card->setTitle($row['name']);
        $card->setWritebitrate($row['writebitrate']);
        $card->setReadbitrate($row['readbitrate']);
        $card->setCapacity($row['capacity']);

        if (array_key_exists('idmedia', $row)) {
            // Find and set the associated media
            $mediaId = $row['idmedia'];
            $media = $this->mediaDAO->find($mediaId);
            $card->setMedia($media);
        }
        
        
        return $card;
    }

	public function find($id) {
        $sql = "select * from card where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No card matching id " . $id);
    }
    
}
