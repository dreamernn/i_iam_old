<?php

/**
 * Class TelController
 *
 */
class TelController extends \BaseController {

    public function telTypeAction() {
        $this->_view->display('tel/telType.phtml');
    }

    public function listAction() {
        $telModel = new TelModel();
        $typeList = $telModel->getTelTypeList(array('hotelid' => $this->getHotelId()), 3600 * 3);
        $this->_view->assign('typeList', $typeList['data']['list']);
        $this->_view->display('tel/tel.phtml');
    }
}
