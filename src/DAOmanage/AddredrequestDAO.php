<?php

namespace datatransfer\DAOmanage;

use datatransfer\Manage\Addredrequest;

class AddredrequestDAO extends DAOmanage
{
	
	 /**
     * Add a format into the database.
     *
     * @param \datatransfer\Manage\addREDrequest $addREDrequest The format to save
     */
    public function addFormat(addREDrequest $addREDrequest) {
        $formatData = array(
            'id' => $addREDrequest->getIdformat(),
            'idcodec' => $addREDrequest->getIdcodec(),
            'idresolution' => $addREDrequest->getIdresolution(),
            'idframerate' => $addREDrequest->getIdframerate(),
            'sampling' => $addREDrequest->getSampling(),
            'bitrate' => $addREDrequest->getBitrate(),
            'bitratemax' => $addREDrequest->getBitratemax(),
            'source' => $addREDrequest->getSource()
            );
            $this->getDb()->insert('format', $formatData);
    }
	
	 /**
     * Add a Cameramediaformat into the database.
     *
     * @param \datatransfer\Manage\addREDrequest $addREDrequest The cameramediaformatformat to save
     */
    public function addCameraMediaformat(addREDrequest $addREDrequest) {
        $cameramediaformatData = array(
            'idformat' => $addREDrequest->getIdformat(),
            'idcamera' => $addREDrequest->getIdcamera(),
            'idmedia' => $addREDrequest->getIdmedia()
            );
            $this->getDb()->insert('cameramediaformat', $cameramediaformatData);
    }
	
	
	/**
     * Creates a addREDrequest object based on a DB row.
     *
     * @param array $row The DB row containing addREDrequest data.
     * @return \datatransfer\Manage\addREDrequest
     */
    protected function buildDomainObject($addREDrequest) {
        $addREDrequest = new addREDrequest();

        return $addREDrequest;
    }
	
	
	
    
}
