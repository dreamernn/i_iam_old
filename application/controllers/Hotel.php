<?php

/**
 * 物业管理控制器
 */
class HotelController extends \BaseController {

    /**
     * 物业信息管理
     */
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

    /**
     * 楼层管理
     */
    public function floorAction() {
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->_view->display('hotel/floor.phtml');
    }

    /**
     * 物业设施管理
     */
    public function facilitiesAction() {
        $this->_view->display('hotel/facilities.phtml');
    }

    /**
     * 交通管理
     */
    public function trafficAction() {
        $this->_view->display('hotel/traffic.phtml');
    }

    /**
     * 物业全景管理
     */
    public function panoramicAction() {
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->_view->display('hotel/panoramic.phtml');

    }

    /**
     * 物业图片管理
     */
    public function picAction() {
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->_view->display('hotel/pic.phtml');
    }

    /**
     * 物业多语言标题管理
     */
    public function titleAction() {
        $this->_view->display('hotel/title.phtml');
    }

}
