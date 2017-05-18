<?php

/**
 * 活动管理控制器
 */
class ActivityController extends \BaseController {

    /**
     * 活动标签
     */
    public function tagAction() {
        $this->_view->display('activity/tag.phtml');
    }

    /**
     * 活动列表
     */
    public function listAction() {
        $activityModel = new ActivityModel();
        $tagList = $activityModel->getTagList(array('hotelid' => $this->getHotelId()), 3600 * 3);
        $this->_view->assign('tagList', $tagList['data']['list']);
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_PDF, 'allowTypePdf');
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->_view->display('activity/activity.phtml');
    }

    /**
     * 活动参与订单列表
     */
    public function orderAction() {
        $activityModel = new ActivityModel();
        $activityList = $activityModel->getActivityList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('activityList', $activityList['data']['list']);
        $this->_view->display('activity/order.phtml');
    }
}
