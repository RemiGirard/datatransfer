<?php

namespace datatransfer\DAO;

use datatransfer\Domain\Software;

class SoftwareDAO extends DAO
{

    /**
     * Return a list of all software.
     *
     * @return array A list of all software.
     */
    public function findAll() {
        $sql = "SELECT * FROM software";
        $result = $this->getDb()->fetchAll($sql);
        
        // Convert query result to an array of domain objects
        $softwares = array();
        foreach ($result as $row) {
            $softwareId = $row['id'];
            $softwares[$softwareId] = $this->buildDomainObject($row);
        }
        return $softwares;
    }

	/**
     * Return a software.
     *
     * @param integer $softwareid.
     *
     * @return array a software.
     */
	public function findTheSoftwareInfo($softwareid){
		$sql = "select * from software where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($softwareid));
        $software = $this->buildDomainObject($row);
        $thesoftware=array();
        $thesoftware[$softwareid]=$software;
        return $thesoftware;
	}


    /**
     * Creates an Software object based on a DB row.
     *
     * @param array $row The DB row containing Software data.
     * @return \datatransfer\Domain\software
     */
    protected function buildDomainObject($row) {
        $software = new Software();
        $software->setId($row['id']);
        $software->setTitle($row['name']);
        $software->setChecksource($row['checksource']);
        return $software;
    }
    
    public function find($id) {
        $sql = "select * from software where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No software matching id " . $id);
    }
}

