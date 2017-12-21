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

    public function taskCategoryAction(){
        $this->_view->display('service/task_category.phtml');
    }


}
