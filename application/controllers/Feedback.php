<?php

/**
 * 调查问卷控制器
 */
class FeedbackController extends \BaseController {

    /**
     * 问题列表
     */
    public function questionAction() {
        $this->_view->display('feedback/question.phtml');
    }

    /**
     * 提交的调查问卷
     */
    public function resultAction() {
        $this->_view->display('feedback/result.phtml');
    }
}
