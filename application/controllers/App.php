<?php

/**
 * APP管理
 */
class AppController extends \BaseController {

    /**
     * 物业推送
     */
    public function pushAction() {
        $baseModel = new BaseModel();
        $platform = $baseModel->getPlatformList();
        $this->_view->assign('platform', $platform);
        $this->_view->display('app/push.phtml');
    }

    /**
     * 快捷启动
     */
    public function shortcutAction() {
        $this->_view->display('app/shortcut.phtml');
    }

    /**
     * 分享平台
     */
    public function shareAction() {
        $this->_view->assign('hotelId', $this->getHotelId());
        $this->_view->display('app/share.phtml');
    }
}