<?php

/**
 * Class ServiceajaxController
 */
class ServiceajaxController extends \BaseController
{

    /**
     * @var RobotModel
     */
    private $_robotModel;

    /**
     * @var Convertor_Robot
     */
    private $_robotConvertor;

    public function init()
    {
        parent::init();
        $this->_robotModel = new RobotModel();
        $this->_robotConvertor = new Convertor_Robot();
    }

    /**
     * Get robot position list
     */
    public function getPositionListAction()
    {
        $paramList['page'] = $this->getPost('page');
        $paramList['limit'] = $this->getPost('limit');

        $paramList['hotelid'] = $this->getHotelId();

        $result = $this->_robotModel->getPositionList($paramList, 0);
        $result = $this->_robotConvertor->positionListConvertor($result, $this->_robotModel);
        $this->echoJson($result);
    }

    /**
     * Pre-process input param
     *
     * @return array
     */
    private function _handlerPositionSaveParams()
    {
        $paramList = array();
        $paramList['position'] = trim($this->getPost("position"));
        $paramList['robot_position'] = trim($this->getPost("robotposition"));
        $paramList['type'] = trim($this->getPost("positiontype"));
        !is_null($this->getPost("id")) ? $paramList['id'] = intval($this->getPost("id")) : false;
        $paramList['hotelid'] = intval($this->getHotelId());
        $paramList['userid'] = intval($this->userInfo['id']);
        return $paramList;
    }

    /**
     * Add new robot position
     */
    public function addRobotPositionAction()
    {
        $paramList = $this->_handlerPositionSaveParams();
        $result = $this->_robotModel->savePosition($paramList);
        $this->echoJson($result);
    }

    /**
     * Update position detail
     */
    public function updateRobotPositionAction()
    {
        $paramList = $this->_handlerPositionSaveParams();
        $result = $this->_robotModel->savePosition($paramList);
        $this->echoJson($result);
    }

}
