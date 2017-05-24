<?php

/**
 * 活动请求控制器
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

    /**
     * 获取房间推送列表
     */
    public function getRoomPushListAction() {
        $paramList['id'] = intval($this->getPost('id'));
        $paramList['type'] = Enum_App::PUSH_TYPE_USER;
        $paramList['dataid'] = intval($this->getPost('dataid'));
        $result = $this->getPost('result');
        $result !== 'all' && !is_null($result) ? $paramList['result'] = intval($result) : false;
        $platform = $this->getPost('platform');
        $platform !== 'all' && !is_null($platform) ? $paramList['platform'] = intval($platform) : false;
        $result = $this->appModel->getPushList($paramList);
        $result = $this->appConvertor->roomPushListConvertor($result, $this->getHotelId());
        $this->echoJson($result);
    }

    /**
     * 新建房间推送
     */
    public function createRoomPushAction() {
        $paramList = array();
        $paramList['type'] = Enum_App::PUSH_TYPE_USER;
        $paramList['dataid'] = intval($this->getPost('dataid'));
        $paramList['cn_title'] = trim($this->getPost("cnTitle"));
        $paramList['cn_value'] = trim($this->getPost("cnValue"));
        $paramList['en_title'] = trim($this->getPost("enTitle"));
        $paramList['en_value'] = trim($this->getPost("enValue"));
        $paramList['url'] = trim($this->getPost("url"));
        $result = $this->appModel->createPush($paramList);
        $this->echoJson($result);
    }

    /**
     * 获取物业推送列表
     */
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

    /**
     * 新建物业推送
     */
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

    /**
     * 获取快捷启动列表
     */
    public function getShortCutListAction() {
        $paramList['hotelid'] = $this->getHotelId();
        $result = $this->appModel->getShortCutList($paramList);
        $result = $this->appConvertor->shortcutListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * 新建和编辑快捷启动信息
     */
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

    /**
     * 新建快捷启动
     */
    public function createShortcutAction() {
        $paramList = $this->handlerShortcutSaveParams();
        $result = $this->appModel->saveShortcutDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 更新快捷启动
     */
    public function updateShortcutAction() {
        $paramList = $this->handlerShortcutSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->appModel->saveShortcutDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 获取分享平台列表
     */
    public function getShareListAction() {
        $paramList['hotelid'] = $this->getHotelId();
        $result = $this->appModel->getShareList($paramList);
        $result = $this->appConvertor->shareListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * 更新分享平台
     */
    public function updateShareAction() {
        $paramList['hotelid'] = $this->getHotelId();
        $paramList['share'] = trim($this->getPost("share"));
        $result = $this->appModel->updateShare($paramList);
        $this->echoJson($result);
    }
}
