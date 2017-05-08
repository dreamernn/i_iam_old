<?php

class AscottController extends BaseController {

    public function init() {
        parent::init();
    }

    /**
     * 获取标签列表
     */
    public function tagListAction() {
        $this->_view->display('ascott/tag.phtml');
    }

    /**
     * 获取标签列表
     */
    public function listAction() {
        $ascottModel = new AscottModel();
        $tagList = $ascottModel->getTagList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('tagList', $tagList['data']['list']);
        $this->_view->display('ascott/ascott.phtml');
    }
}