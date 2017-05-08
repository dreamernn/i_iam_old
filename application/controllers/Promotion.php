<?php

class PromotionController extends BaseController {

    public function init() {
        parent::init();
    }

    /**
     * 获取标签列表
     */
    public function tagListAction() {
        $this->_view->display('promotion/tag.phtml');
    }

    /**
     * 获取标签列表
     */
    public function listAction() {
        $promotionModel = new PromotionModel();
        $tagList = $promotionModel->getTagList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('tagList', $tagList['data']['list']);
        $this->_view->display('promotion/promotion.phtml');
    }
}