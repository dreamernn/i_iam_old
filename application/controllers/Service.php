<?php

/**
 * Controller for interactive service
 */
class ServiceController extends \BaseController
{

    public function robotPositionAction()
    {
        $robotModel = new RobotModel();
        $positionTypeList = $robotModel->getPositionTypeList();

        $this->_view->assign('positionTypeList', $positionTypeList);
        $this->_view->display('service/robot_position.phtml');
    }

    public function taskCategoryAction()
    {
        $this->_view->display('service/task_category.phtml');
    }

    public function taskManagementAction()
    {
        $serviceModel = new ServiceModel();
        $hotelModel = new HotelModel();
        $convertor = new Convertor_Service();
        $categoryList = $serviceModel->getTaskCategoryList(array('hotelid' => $this->getHotelId()), 6 * 3600);
        $departmentAndLevel = $hotelModel->getDepartmentAndLevelListAction(array('hotelid' => $this->getHotelId()), 6 * 3600);
        $staffList = $hotelModel->getHotelAdministratorList(array(
            'hotelid' => $this->getHotelId(),
            'limit' => 0, //without pagination
        ), 6 * 3600);
        $categoryListFilter = $convertor->taskCategoryFilter($categoryList);

        $this->_view->assign('categoryList', $categoryListFilter);
        $this->_view->assign('departmentList', $departmentAndLevel['data']['department']);
        $this->_view->assign('levelList', $departmentAndLevel['data']['level']);
        $this->_view->assign('staffList', $staffList['data']['list']);
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_PDF, 'allowTypePdf');
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');

        $this->_view->display('service/task.phtml');
    }

    public function taskOrderAction()
    {
        $serviceModel = new ServiceModel();
        $hotelModel = new HotelModel();
        $userModel = new UserModel();

        $convertor = new Convertor_Service();
        $categoryList = $serviceModel->getTaskCategoryList(array('hotelid' => $this->getHotelId()), 6 * 3600);
        $taskList = $serviceModel->getTaskList(array(
            'hotelid' => $this->getHotelId(),
            'limit' => 0
        ), 6 * 3600);
        $categoryListFilter = $convertor->taskCategoryFilter($categoryList);

        $statusListFilter = $serviceModel->getTaskOrderStatusArr();

        $departmentAndLevel = $hotelModel->getDepartmentAndLevelListAction(array('hotelid' => $this->getHotelId()), 6 * 3600);
        $staffList = $hotelModel->getHotelAdministratorList(array(
            'hotelid' => $this->getHotelId(),
            'limit' => 0, //without pagination
        ), 6 * 3600);
        $guestList = $userModel->getList(array(
            'hotelid' => $this->getHotelId(),
            'limit' => 0
        ));


        $this->_view->assign('categoryList', $categoryListFilter);
        $this->_view->assign('departmentList', $departmentAndLevel['data']['department']);
        $this->_view->assign('statusList', $statusListFilter);
        $this->_view->assign('staffList', $staffList['data']['list']);
        $this->_view->assign('guestList', $guestList['data']['list']);
        $this->_view->assign('taskList', $taskList['data']['list']);

        $this->_view->display('service/task_order.phtml');
    }


}
