<?php

namespace datatransfer\DAO;

use datatransfer\Domain\Plug;

class PlugDAO extends DAO
{

    /**
     * Return a list of all manufacturer.
     *
     * @return array A list of all manufacturer.
     */
    public function findAll() {
        $sql = "SELECT * FROM interface";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $plugs = array();
        foreach ($result as $row) {
            $plugId = $row['id'];
            $plugs[$plugId] = $this->buildDomainObject($row);
        }
        return $plugs;
    }

	/**
     * Return a plug.
     *
     * @param integer $plugid.
     *
     * @return array a plug.
     */
	public function findThePlugInfo($plugid){
		$sql = "select * from interface where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($plugid));
        $plug = $this->buildDomainObject($row);
        $theplug=array();
        $theplug[$plugid]=$plug;
        return $theplug;
	}


    /**
     * Creates an Manufacturer object based on a DB row.
     *
     * @param array $row The DB row containing Manufacturer data.
     * @return \MicroCMS\Domain\Manufacturer
     */
    protected function buildDomainObject($row) {
        $plug = new Plug();
        $plug->setId($row['id']);
        $plug->setTitle($row['name']);
        $plug->setBitrate($row['bitrate']);
        return $plug;
    }
}

