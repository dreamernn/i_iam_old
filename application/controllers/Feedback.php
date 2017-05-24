<?php

/**
 * 调查问卷控制器
 */
class FeedbackController extends \BaseController {

    /**
     * 表单列表
     */
    public function listAction() {
        $this->_view->display('feedback/list.phtml');
    }

    /**
     * 问题列表
     */
    public function questionAction() {
        $feedbackModel = new FeedbackModel();
        $feedbackList = $feedbackModel->getList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('feedbackList', $feedbackList['data']['list']);
        $this->_view->display('feedback/question.phtml');
    }

    /**
     * 提交的调查问卷
     */
    public function resultAction() {
        $this->_view->display('feedback/result.phtml');
    }
}
