<?php

/**
 * Class ActivityController
 *
 */
class ActivityController extends \BaseController {

    public function tagAction() {
        $this->_view->display('activity/tag.phtml');
    }

    public function listAction() {
        $activityModel = new ActivityModel();
        $tagList = $activityModel->getTagList(array('hotelid' => $this->getHotelId()), 3600 * 3);
        $this->_view->assign('tagList', $tagList['data']['list']);
        $this->_view->display('activity/activity.phtml');
    }

    public function orderAction() {
        $activityModel = new ActivityModel();
        $activityList = $activityModel->getActivityList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('activityList', $activityList['data']['list']);
        $this->_view->display('activity/order.phtml');
    }
}
