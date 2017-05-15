<?php

/**
 * 电话黄页请求控制器
 */
class TelajaxController extends \BaseController {

    /**
     * @var TelModel
     */
    private $TelModel;

    /**
     * @var Convertor_Tel
     */
    private $TelConvertor;

    public function init() {
        parent::init();
        $this->TelModel = new TelModel();
        $this->TelConvertor = new Convertor_Tel();
    }

    /**
     * 获取电话黄页分类列表
     */
    public function getTelTypeListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['hotelid'] = $this->getHotelId();
        $paramList['id'] = intval($this->getPost('id'));
        $paramList['title'] = trim($this->getPost('title'));
        $islogin = $this->getPost('islogin');
        $islogin !== 'all' && !is_null($islogin) ? $paramList['islogin'] = intval($islogin) : false;
        $result = $this->TelModel->getTelTypeList($paramList);
        $result = $this->TelConvertor->telTypeListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * 新建和编辑分类信息
     */
    private function handlerTelTypeSaveParams() {
        $paramList = array();
        $paramList['title_lang1'] = trim($this->getPost("titleLang1"));
        $paramList['title_lang2'] = trim($this->getPost("titleLang2"));
        $paramList['title_lang3'] = trim($this->getPost("titleLang3"));
        $paramList['islogin'] = intval($this->getPost("islogin"));
        $paramList['hotelid'] = intval($this->getHotelId());
        return $paramList;
    }

    /**
     * 新建电话黄页分类
     */
    public function createTelTypeAction() {
        $paramList = $this->handlerTelTypeSaveParams();
        $result = $this->TelModel->saveTelTypeDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 更新电话黄页分类信息
     */
    public function updateTelTypeAction() {
        $paramList = $this->handlerTelTypeSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->TelModel->saveTelTypeDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 获取电话黄页列表
     */
    public function getTelListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['hotelid'] = $this->getHotelId();
        $paramList['id'] = intval($this->getPost('id'));
        $paramList['title'] = $this->getPost('title');
        $paramList['tel'] = $this->getPost('tel');
        $paramList['typeid'] = intval($this->getPost('typeid'));
        $status = $this->getPost('status');
        $status !== 'all' && !is_null($status) ? $paramList['status'] = intval($status) : false;
        $result = $this->TelModel->getTelList($paramList);
        $result = $this->TelConvertor->telListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * 新建和编辑电话黄页列表
     */
    private function handlerTelSaveParams() {
        $paramList = array();
        $paramList['title_lang1'] = trim($this->getPost("titleLang1"));
        $paramList['title_lang2'] = trim($this->getPost("titleLang2"));
        $paramList['title_lang3'] = trim($this->getPost("titleLang3"));
        $paramList['tel'] = trim($this->getPost("tel"));
        $paramList['typeid'] = intval($this->getPost("typeid"));
        $paramList['status'] = intval($this->getPost("status"));
        $paramList['hotelid'] = intval($this->getHotelId());
        return $paramList;
    }

    /**
     * 新建电话
     */
    public function createTelAction() {
        $paramList = $this->handlerTelSaveParams();
        $result = $this->TelModel->saveTelDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 更新电话
     */
    public function updateTelAction() {
        $paramList = $this->handlerTelSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->TelModel->saveTelDataInfo($paramList);
        $this->echoJson($result);
    }
}
