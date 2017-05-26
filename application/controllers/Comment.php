<?php

/**
 * 评论管理控制器
 */
class CommentController extends \BaseController {

    /**
     * 评论列表
     */
    public function listAction() {
        $commentModel = new CommentModel();
        $typeList = $commentModel->getTypeList(array(), 3600 * 3);
        $this->_view->assign('typeList', $typeList['data']['list']);
        $this->_view->display('comment/list.phtml');
    }
}
