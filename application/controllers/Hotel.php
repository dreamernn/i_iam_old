<?php

/**
 * Class HotelController
 * @author ZXM
 */
class HotelController extends \BaseController {

    public function infoAction() {
        $hotelModel = new HotelModel();
        $hotelInfo = $hotelModel->getHotelDetail($this->getHotelId());
        $this->_view->assign('hotelInfo', $hotelInfo['data']['list'][0]);

        $cityModel = new CityModel();
        $cityList = $cityModel->getCityList(array(), 3600 * 3);
        $this->_view->assign('cityList', $cityList['data']['list']);

        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_VOICE, 'allowTypeVoice');
        $this->_view->display('hotel/info.phtml');
    }

    public function floorAction() {
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->_view->display('hotel/floor.phtml');
    }

    public function facilitiesAction() {
        $this->_view->display('hotel/facilities.phtml');
    }

    public function trafficAction() {
        $this->_view->display('hotel/traffic.phtml');
    }

    public function panoramicAction() {
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->_view->display('hotel/panoramic.phtml');

    }

    public function picAction() {
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->_view->display('hotel/pic.phtml');
    }

}
