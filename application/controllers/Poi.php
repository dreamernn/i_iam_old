<?php

class PoiController extends BaseController {

    public function init() {
        parent::init();
    }

    /**
     * 获取标签列表
     */
    public function tagListAction() {
        $this->_view->display('poi/tag.phtml');
    }

    /**
     * 获取标签列表
     */
    public function listAction() {
        $poiModel = new PoiModel();
        $tagList = $poiModel->getTagList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('tagList', $tagList['data']['list']);
        $this->_view->display('poi/poi.phtml');
    }
}