<?php

/**
 * 电话黄页控制器
 */
class TelController extends \BaseController {

    /**
     * 电话黄页分类管理
     */
    public function telTypeAction() {
        $this->_view->display('tel/telType.phtml');
    }

    /**
     * 电话黄页管理
     */
    public function listAction() {
        $telModel = new TelModel();
        $typeList = $telModel->getTelTypeList(array('hotelid' => $this->getHotelId()), 3600 * 3);
        $this->_view->assign('typeList', $typeList['data']['list']);
        $this->_view->display('tel/tel.phtml');
    }
}
