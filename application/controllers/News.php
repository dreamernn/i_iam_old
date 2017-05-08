<?php

class NewsController extends BaseController {

    public function init() {
        parent::init();
    }

    /**
     * 获取标签列表
     */
    public function tagListAction() {
        $this->_view->display('news/tag.phtml');
    }

    /**
     * 获取标签列表
     */
    public function listAction() {
        $newsModel = new NewsModel();
        $tagList = $newsModel->getTagList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('tagList', $tagList['data']['list']);
        $this->_view->display('news/news.phtml');
    }
}