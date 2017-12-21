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
        $params['pic'] = $_FILES['pic'];

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
        $params['pic'] = $_FILES['pic'];

        $result = $this->_serviceModel->saveCategory($params);
        $this->echoJson($result);
    }

    /**
     * Ajax for getting task list
     */
    public function getTaskListAction()
    {
        $params = array();
        $params['page'] = intval($this->getPost('page'));
        $params['limit'] = intval($this->getPost('limit'));

        $params['hotelid'] = $this->getHotelId();
        $params['id'] = $this->getPost('id');
        $categoryId = $this->getPost('categoryid');
        $categoryId !== 'all' && !is_null($categoryId) ? $params['category_id'] = intval($categoryId) : false;

        $name = trim($this->getPost('name'));
        if (!empty($name)) {
            $langCode = $this->userInfo['useLanguage'] == Enum_Lang::LANG_KEY_ENGLISH ? 2 : 1;
            $params['title_lang' . $langCode] = $name;
        }
        $status = $this->getPost('status');
        $status !== 'all' && !is_null($status) ? $params['status'] = intval($status) : false;

        $result = $this->_serviceModel->getTaskList($params, 0);
        $result = $this->_serviceConvertor->taskListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * Ajax for creating a task
     */
    public function createTaskAction()
    {
        $params = $this->_handlerTaskSaveParams();
        $params['hotelid'] = $this->getHotelId();
        $result = $this->_serviceModel->saveTask($params);
        $this->echoJson($result);
    }

    /**
     * Ajax for update a task detail
     */
    public function updateTaskAction()
    {
        $params = $this->_handlerTaskSaveParams();
        $params['id'] = intval($this->getPost('id'));
        $params['hotelid'] = $this->getHotelId();
        $result = $this->_serviceModel->saveTask($params);
        $this->echoJson($result);
    }

    /**
     * Ajax for updating task process detail
     */
    public function updateTaskProcessAction()
    {
        $params = array();

        $params['id'] = $this->getPost('id');
        $params['department_id'] = $this->getPost('departmentid');
        $params['staff_id'] = $this->getPost('staffid');
        $params['highest_level'] = $this->getPost('highlevel');
        $params['level_interval_1'] = $this->getPost('levelinterval1');
        $params['level_interval_2'] = $this->getPost('levelinterval2');
        $params['level_interval_3'] = $this->getPost('levelinterval3');
        $params['level_interval_4'] = $this->getPost('levelinterval4');
        $params['level_interval_5'] = $this->getPost('levelinterval5');
        $params['sms'] = $this->getPost('sms');
        $params['email'] = $this->getPost('email');

        $result = $this->_serviceModel->saveTaskProcess($params);
        $this->echoJson($result);

    }


    public function getTaskOrderListAction()
    {
        $params = array();
        $params['page'] = intval($this->getPost('page'));
        $params['limit'] = intval($this->getPost('limit'));

        $params['hotelid'] = $this->getHotelId();
        $params['id'] = $this->getPost('id');
        $categoryId = $this->getPost('category_id');
        $categoryId !== 'all' && !is_null($categoryId) ? $params['category_id'] = intval($categoryId) : false;

        $status = $this->getPost('status');
        $status !== 'all' && !is_null($status) ? $params['status'] = intval($status) : false;

        $userId = $this->getPost('user_id');
        $userId !== 'all' && !is_null($userId) ? $params['userid'] = intval($userId) : false;

        $result = $this->_serviceModel->getTaskOrderList($params, 0);
        $result = $this->_serviceConvertor->taskOrderListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * Ajax for creating a task order
     */
    public function createTaskOrderAction()
    {
        $params = array();

        $params['hotelid'] = $this->getHotelId();
        $params['task_id'] = $this->getPost('taskid');
        $params['user_id'] = $this->getPost('userid');
        $params['room_no'] = $this->getPost('roomno');
        $params['admin_id'] = $this->getPost('adminid');
        $params['memo'] = $this->getPost('memo');

        $params['status'] = ServiceModel::TASK_ORDER_STATUS_OPEN;
        $params['count'] = $this->getPost('count') ? intval($this->getPost('count')) : 1;

        $result = $this->_serviceModel->saveTaskOrder($params);
        $this->echoJson($result);
    }

    /**
     * Ajax for updating task order
     */
    public function updateTaskOrderAction()
    {
        $params = array();

        $params['id'] = $this->getPost('id');
        $params['admin_id'] = $this->getPost('adminid');
        $params['delay'] = $this->getPost('delay');
        $params['status'] = $this->getPost('status');
        $params['memo'] = $this->getPost('memo');

        $result = $this->_serviceModel->saveTaskOrder($params);
        $this->echoJson($result);

    }

    /**
     * Get param from http request
     */
    private function _handlerTaskSaveParams()
    {
        $paramList = array();
        $paramList['title_lang1'] = trim($this->getPost("titleLang1"));
        $paramList['title_lang2'] = trim($this->getPost("titleLang2"));
        $paramList['title_lang3'] = trim($this->getPost("titleLang3"));
        $paramList['price'] = floatval($this->getPost("price"));
        $paramList['status'] = intval($this->getPost("status"));
        $paramList['category_id'] = intval($this->getPost("categoryid"));
        $paramList['pic'] = $_FILES['pic'];

        return $paramList;
    }


}
