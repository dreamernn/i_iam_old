<?php

/**
 * APP管理
 */
class AppController extends \BaseController {

    /**
     * 房间推送
     */
    public function roomPushAction() {
        $userModel = new UserModel();
        $userList = $userModel->getList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('userList', $userList['data']['list']);
        $platform = $userModel->getPlatformList();
        $this->_view->assign('platform', $platform);
        $this->_view->display('app/roomPush.phtml');
    }

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

    /**
     * RSS管理
     */
    public function rssAction() {
        $appModel = new AppModel();
        $rssTypeList = $appModel->getRssTypeList(array(), 3600);
        $this->_view->assign('rssTypeList', $rssTypeList['data']['list']);
        $this->_view->display('app/rss.phtml');
    }
}