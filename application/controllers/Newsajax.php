<?php

/**
 * 物业新闻请求控制器
 */
class NewsajaxController extends \BaseController {
    /** @var  NewsModel */
    private $model;
    /** @var  Convertor_News */
    private $convertor;

    public function init() {
        parent::init();
        $this->model = new NewsModel();
        $this->convertor = new Convertor_News();
    }

    /**
     * 获取tag列表
     */
    public function getTagListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['hotelid'] = $this->getHotelId();
        $result = $this->model->getTagList($paramList);
        $result = $this->convertor->tagListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * 新建和编辑tag信息数据
     */
    private function handlerTagSaveParams() {
        $paramList = array();
        $paramList['title_lang1'] = trim($this->getPost("titleLang1"));
        $paramList['title_lang2'] = trim($this->getPost("titleLang2"));
        $paramList['title_lang3'] = trim($this->getPost("titleLang3"));
        $paramList['hotelid'] = intval($this->getHotelId());
        return $paramList;
    }

    /**
     * 新建tag信息
     */
    public function createTagAction() {
        $paramList = $this->handlerTagSaveParams();
        $result = $this->model->saveTagDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 更新tag信息
     */
    public function updateTagAction() {
        $paramList = $this->handlerTagSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->model->saveTagDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 获取新闻列表
     */
    public function getListAction()
    {
        $paramList['page'] = $this->getPost('page');
        $paramList['hotelid'] = $this->getHotelId();
        $paramList['id'] = intval($this->getPost('id'));
        $tag = $this->getPost('tag');
        ($tag !== 'all' && !is_null($tag)) ? $paramList['tagid'] = intval($tag) : false;
        $lang = $this->getPost('lang');
        if ($lang !== 'all' && !is_null($lang)) {
            $key = Enum_Lang::$langIndexList[$lang];
            if ($key > 0) {
                $paramList['lang'] = $lang;
            }
        }

        $paramList['title'] = $this->getPost('title');
        $status = $this->getPost('status');
        $status !== 'all' && !is_null($status) ? $paramList['status'] = intval($status) : false;
        $result = $this->model->getList($paramList);
        $result = $this->convertor->getListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * 新建和编辑物业新闻
     */
    private function handlerSaveParams()
    {
        $paramList = array();
        $paramList['title_lang1'] = trim($this->getPost("titleLang1"));
        $paramList['title_lang2'] = trim($this->getPost("titleLang2"));
        $paramList['title_lang3'] = trim($this->getPost("titleLang3"));
        $paramList['enable_lang1'] = trim($this->getPost("enableLang1"));
        $paramList['enable_lang2'] = trim($this->getPost("enableLang2"));
        $paramList['enable_lang3'] = trim($this->getPost("enableLang3"));
        $paramList['tagid'] = intval($this->getPost("tagid"));
        $paramList['status'] = intval($this->getPost("status"));
        $paramList['hotelid'] = intval($this->getHotelId());
        $paramList['groupid'] = intval($this->getGroupId());
        $paramList['pdf'] = $this->getFile('pdf');
        $paramList['pic'] = $this->getFile('pic');
        $paramList['video'] = trim($this->getPost("video"));
        $paramList['sort'] = intval($this->getPost("sort"));
        return $paramList;
    }

    /**
     * 新建物业新闻
     */
    public function createAction() {
        $paramList = $this->handlerSaveParams();
        $result = $this->model->saveInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 更新物业新闻
     */
    public function updateAction() {
        $paramList = $this->handlerSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->model->saveInfo($paramList);
        $this->echoJson($result);
    }
}
