<?php

/**
 * @author ZXM
 */
class AppajaxController extends \BaseController {

    /**
     * @var AppModel
     */
    private $appModel;

    /**
     * @var Convertor_App
     */
    private $appConvertor;

    public function init() {
        parent::init();
        $this->appModel = new AppModel();
        $this->appConvertor = new Convertor_App();
    }

    public function getPushListAction() {
        $paramList['id'] = intval($this->getPost('id'));
        $paramList['type'] = Enum_App::PUSH_TYPE_HOTEL;
        $paramList['dataid'] = $this->getHotelId();
        $result = $this->getPost('result');
        $result !== 'all' && !is_null($result) ? $paramList['result'] = intval($result) : false;
        $platform = $this->getPost('platform');
        $platform !== 'all' && !is_null($platform) ? $paramList['platform'] = intval($platform) : false;
        $result = $this->appModel->getPushList($paramList);
        $result = $this->appConvertor->pushListConvertor($result);
        $this->echoJson($result);
    }

    public function createPushAction() {
        $paramList = array();
        $paramList['type'] = Enum_App::PUSH_TYPE_HOTEL;
        $paramList['dataid'] = $this->getHotelId();
        $paramList['platform'] = intval($this->getPost("platform"));
        $paramList['cn_title'] = trim($this->getPost("cnTitle"));
        $paramList['cn_value'] = trim($this->getPost("cnValue"));
        $paramList['en_title'] = trim($this->getPost("enTitle"));
        $paramList['en_value'] = trim($this->getPost("enValue"));
        $paramList['url'] = trim($this->getPost("url"));
        $result = $this->appModel->createPush($paramList);
        $this->echoJson($result);
    }

    public function getShortCutListAction() {
        $paramList['hotelid'] = $this->getHotelId();
        $result = $this->appModel->getShortCutList($paramList);
        $result = $this->appConvertor->shortcutListConvertor($result);
        $this->echoJson($result);
    }

    private function handlerShortcutSaveParams() {
        $paramList = array();
        $paramList['key'] = trim($this->getPost("key"));
        $paramList['sort'] = intval($this->getPost("sort"));
        $paramList['title_lang1'] = trim($this->getPost("titleLang1"));
        $paramList['title_lang2'] = trim($this->getPost("titleLang2"));
        $paramList['title_lang3'] = trim($this->getPost("titleLang3"));
        $paramList['hotelid'] = intval($this->getHotelId());
        return $paramList;
    }

    public function createShortcutAction() {
        $paramList = $this->handlerShortcutSaveParams();
        $result = $this->appModel->saveShortcutDataInfo($paramList);
        $this->echoJson($result);
    }

    public function updateShortcutAction() {
        $paramList = $this->handlerShortcutSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->appModel->saveShortcutDataInfo($paramList);
        $this->echoJson($result);
    }

    public function getShareListAction() {
        $paramList['hotelid'] = $this->getHotelId();
        $result = $this->appModel->getShareList($paramList);
        $result = $this->appConvertor->shareListConvertor($result);
        $this->echoJson($result);
    }

    public function updateShareAction() {
        $paramList['hotelid'] = $this->getHotelId();
        $paramList['share'] = trim($this->getPost("share"));
        $result = $this->appModel->updateShare($paramList);
        $this->echoJson($result);
    }
}
