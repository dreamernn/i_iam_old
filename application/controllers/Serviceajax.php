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
     * @var ServiceModel
     */
    private $_serviceModel;

    /**
     * @var Convertor_Robot
     */
    private $_robotConvertor;

    /**
     * @var Convertor_Service
     */
    private $_serviceConvertor;


    public function init()
    {
        parent::init();
        $this->_robotModel = new RobotModel();
        $this->_serviceModel = new ServiceModel();
        $this->_robotConvertor = new Convertor_Robot();
        $this->_serviceConvertor = new Convertor_Service();
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


    /**
     * Ajax for getting category list
     */
    public function getCategoryListAction()
    {
        $params = array();
        $params['page'] = intval($this->getPost('page'));
        $params['limit'] = intval($this->getPost('limit'));
        $params['hotelid'] = $this->getHotelId();
        $result = $this->_serviceModel->getTaskCategoryList($params);
        $result = $this->_serviceConvertor->taskCategoryConvertor($result);
        $this->echoJson($result);
    }

    /**
     * Ajax for creating a category
     */
    public function createTaskCategoryAction()
    {
        $params = array();
        $params['title_lang1'] = trim($this->getPost('titleLang1'));
        $params['title_lang2'] = trim($this->getPost('titleLang2'));
        $params['parentid'] = intval($this->getPost('parentId'));
        $params['hotelid'] = $this->getHotelId();
        $result = $this->_serviceModel->saveCategory($params);
        $this->echoJson($result);
    }

    /**
     * Ajax for update a task category detail
     */
    public function updateTaskCategoryAction()
    {
        $params = array();
        $params['title_lang1'] = $this->getPost('titleLang1');
        $params['title_lang2'] = $this->getPost('titleLang2');
        $params['parentid'] = intval($this->getPost('parentId'));
        $params['id'] = $this->getPost('id');
        $result = $this->_serviceModel->saveCategory($params);
        $this->echoJson($result);
    }


}
