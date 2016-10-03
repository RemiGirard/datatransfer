<?php

namespace datatransfer\DAO;

use datatransfer\Domain\Volume;

class VolumeDAO extends DAO
{

    /**
     * Return a list of all volume.
     *
     * @return array A list of all volume.
     */
    public function findAll() {
        $sql = "SELECT * FROM volume";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $volumes = array();
        foreach ($result as $row) {
            $volumeId = $row['id'];
            $volumes[$volumeId] = $this->buildDomainObject($row);
        }
        return $volumes;
    }

 	/**
     * Return a volume.
     *
     * @param integer $volumeid.
     *
     * @return array a volume.
     */
	public function findTheVolumeInfo($volumeid){
		$sql = "select * from volume where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($volumeid));
        $volume = $this->buildDomainObject($row);
        $thevolume=array();
        $thevolume[$volumeid]=$volume;
        return $thevolume;
	}


    /**
     * Creates an Volume object based on a DB row.
     *
     * @param array $row The DB row containing Volume data.
     * @return \MicroCMS\Domain\Volume
     */
    protected function buildDomainObject($row) {
        $volume = new Volume();
        $volume->setId($row['id']);
        $volume->setTitle($row['name']);
        $volume->setWritebitrate($row['writebitrate']);
        $volume->setReadbitrate($row['readbitrate']);
        
        return $volume;
    }
}

