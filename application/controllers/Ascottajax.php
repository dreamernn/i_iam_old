<?php

/**
 * 雅士阁生活请求控制器
 */
class AscottajaxController extends \BaseController {
    /**
     * @var AscottModel
     */
    private $model;

    /**
     * @var Convertor_Ascott
     */
    private $convertor;

    public function init() {
        parent::init();
        $this->model = new AscottModel();
        $this->convertor = new Convertor_Ascott();
    }

    /**
     * 获取type列表
     */
    public function getTypeListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['limit'] = $this->getPost('limit');
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
     * 获取雅士阁生活列表
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
     * 新建和编辑雅士阁生活信息
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
     * 新建雅士阁生活
     */
    public function createAction() {
        $paramList = $this->handlerSaveParams();
        $result = $this->model->saveInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 编辑雅士阁生活
     */
    public function updateAction() {
        $paramList = $this->handlerSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->model->saveInfo($paramList);
        $this->echoJson($result);
    }
}
