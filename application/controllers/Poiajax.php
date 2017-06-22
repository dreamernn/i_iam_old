<?php

/**
 * 本地攻略请求控制器
 */
class PoiajaxController extends \BaseController {
    /**
     * @var PoiModel
     */
    private $model;
    /**
     * @var Convertor_Poi
     */
    private $convertor;

    public function init() {
        parent::init();
        $this->model = new PoiModel();
        $this->convertor = new Convertor_Poi();
    }

    /**
     * 获取type列表
     */
    public function getTypeListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['hotelid'] = $this->getHotelId();
        $result = $this->model->getTypeList($paramList);
        $result = $this->convertor->typeListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * 新建和编辑type信息数据
     */
    private function handlerTypeSaveParams() {
        $paramList = array();
        $paramList['title_lang1'] = trim($this->getPost("titleLang1"));
        $paramList['title_lang2'] = trim($this->getPost("titleLang2"));
        $paramList['title_lang3'] = trim($this->getPost("titleLang3"));
        $paramList['hotelid'] = intval($this->getHotelId());
        return $paramList;
    }

    /**
     * 新建type信息
     */
    public function createTypeAction() {
        $paramList = $this->handlerTypeSaveParams();
        $result = $this->model->saveTypeDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 更新type信息
     */
    public function updateTypeAction() {
        $paramList = $this->handlerTypeSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->model->saveTypeDataInfo($paramList);
        $this->echoJson($result);
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
     * 获取本地攻略列表
     */
    public function getListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['hotelid'] = $this->getHotelId();
        $paramList['id'] = intval($this->getPost('id'));
        $paramList['typeid'] = intval($this->getPost('typeid'));
        $paramList['name'] = $this->getPost('name');
        $status = $this->getPost('status');
        $status !== 'all' && !is_null($status) ? $paramList['status'] = intval($status) : false;
        $result = $this->model->getList($paramList);
        $result = $this->convertor->getListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * 新建和编辑本地攻略信息
     */
    private function handlerSaveParams() {
        $paramList = array();
        $paramList['name_lang1'] = trim($this->getPost("nameLang1"));
        $paramList['name_lang2'] = trim($this->getPost("nameLang2"));
        $paramList['name_lang3'] = trim($this->getPost("nameLang3"));
        $paramList['address_lang1'] = trim($this->getPost("addressLang1"));
        $paramList['address_lang2'] = trim($this->getPost("addressLang2"));
        $paramList['address_lang3'] = trim($this->getPost("addressLang3"));
        $paramList['introduct_lang1'] = trim($this->getPost("introductLang1"));
        $paramList['introduct_lang2'] = trim($this->getPost("introductLang2"));
        $paramList['introduct_lang3'] = trim($this->getPost("introductLang3"));
        $paramList['tel'] = trim($this->getPost("tel"));
        $paramList['lat'] = trim($this->getPost("lat"));
        $paramList['lng'] = trim($this->getPost("lng"));
        $paramList['typeid'] = intval($this->getPost("typeid"));
        $paramList['tagid'] = intval($this->getPost("tagid"));
        $paramList['status'] = intval($this->getPost("status"));
        $paramList['hotelid'] = intval($this->getHotelId());
        $paramList['groupid'] = intval($this->getGroupId());
        $paramList['pdf'] = $_FILES['pdf'];
        $paramList['pic'] = $_FILES['pic'];
        $paramList['video'] = trim($this->getPost("video"));
        $paramList['sort'] = intval($this->getPost("sort"));
        return $paramList;
    }

    /**
     * 新建本地攻略
     */
    public function createAction() {
        $paramList = $this->handlerSaveParams();

        $result = $this->model->saveInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 更新本地攻略
     */
    public function updateAction() {
        $paramList = $this->handlerSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->model->saveInfo($paramList);
        $this->echoJson($result);
    }
}
