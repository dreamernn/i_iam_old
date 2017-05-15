<?php

/**
 * 物业通知管理控制器
 */
class NoticController extends BaseController {

    public function init() {
        parent::init();
    }

    /**
     * 标签列表
     */
    public function tagListAction() {
        $this->_view->display('notic/tag.phtml');
    }

    /**
     * 物业通知管理
     */
    public function listAction() {
        $noticModel = new NoticModel();
        $tagList = $noticModel->getTagList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('tagList', $tagList['data']['list']);
        $this->_view->display('notic/notic.phtml');
    }
}