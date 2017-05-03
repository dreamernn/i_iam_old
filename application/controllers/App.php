<?php

/**
 * Created by PhpStorm.
 */
class AppController extends \BaseController {

    public function pushAction() {
        $baseModel = new BaseModel();
        $platform = $baseModel->getPlatformList();
        $this->_view->assign('platform', $platform);
        $this->_view->display('app/push.phtml');
    }

    public function shortcutAction() {
        $this->_view->display('app/shortcut.phtml');
    }

    public function shareAction() {
        $this->_view->assign('hotelId', $this->getHotelId());
        $this->_view->display('app/share.phtml');
    }
}