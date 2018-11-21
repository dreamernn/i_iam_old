<?php

/**
 * Staff config
 */
class StaffajaxController extends \BaseController
{

    /**
     * @var StaffModel
     */
    private $staffModel;


    public function init()
    {
        parent::init();
        $this->staffModel = new StaffModel();
    }


    public function updateStaffPermissionAction()
    {
        $paramList['id'] = intval($this->getPost("id"));
        $paramList['permission'] = trim($this->getPost("permission"));
        $result = $this->staffModel->updateStaffPermission($paramList);
        $this->echoJson($result);
    }
}