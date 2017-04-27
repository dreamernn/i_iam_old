<?php

/**
 * @author ZXM
 */
class HotelajaxController extends \BaseController {

    /**
     * @var HotelModel
     */
    private $hotelModal;

    public function init() {
        parent::init();
        $this->hotelModal = new HotelModel();
    }

    /**
     * 更新集团信息
     */
    public function updateHotelAction() {
        $paramList = array();
        $paramList['id'] = intval($this->getPost("id"));
        $paramList['name_lang1'] = trim($this->getPost("nameLang1"));
        $paramList['name_lang2'] = trim($this->getPost("nameLang2"));
        $paramList['name_lang3'] = trim($this->getPost("nameLang3"));
        $paramList['cityid'] = intval($this->getPost("cityid"));
        $paramList['propertyinterfid'] = trim($this->getPost("propertyinterfid"));
        $paramList['lng'] = trim($this->getPost("lng"));
        $paramList['lat'] = trim($this->getPost("lat"));
        $paramList['tel'] = trim($this->getPost("tel"));
        $paramList['website'] = trim($this->getPost("website"));
        $paramList['logo'] = $_FILES['logo'];
        $paramList['index_background'] = $_FILES['indexBackground'];
        $paramList['voice_lang1'] = $_FILES['voiceLang1'];
        $paramList['voice_lang2'] = $_FILES['voiceLang2'];
        $paramList['voice_lang3'] = $_FILES['voiceLang3'];
        $paramList['status'] = intval($this->getPost("status"));
        $paramList['bookurl'] = trim($this->getPost("bookurl"));
        $paramList['address_lang1'] = trim($this->getPost("addressLang1"));
        $paramList['address_lang2'] = trim($this->getPost("addressLang2"));
        $paramList['address_lang3'] = trim($this->getPost("addressLang3"));
        $paramList['introduction_lang1'] = trim($this->getPost("introductionLang1"));
        $paramList['introduction_lang2'] = trim($this->getPost("introductionLang2"));
        $paramList['introduction_lang3'] = trim($this->getPost("introductionLang3"));
        $result = $this->hotelModal->saveHotelDataInfo($paramList);
        $this->echoJson($result);
    }
}
