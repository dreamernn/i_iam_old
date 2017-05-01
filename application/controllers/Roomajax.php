<?php

/**
 * @author ZXM
 */
class RoomajaxController extends \BaseController {

    /**
     * @var RoomModel
     */
    private $roomModel;

    /**
     * @var Convertor_Room
     */
    private $roomConvertor;

    public function init() {
        parent::init();
        $this->roomModel = new RoomModel();
        $this->roomConvertor = new Convertor_Room();
    }

    public function getRoomResListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['hotelid'] = $this->getHotelId();
        $paramList['id'] = intval($this->getPost('id'));
        $paramList['icon'] = trim($this->getPost('icon'));
        $paramList['name'] = trim($this->getPost('name'));
        $status = $this->getPost('status');
        $status !== 'all' && !is_null($status) ? $paramList['status'] = intval($status) : false;
        $result = $this->roomModel->getRoomResList($paramList);
        $result = $this->roomConvertor->roomResListConvertor($result);
        $this->echoJson($result);
    }

    private function handlerRoomResSaveParams() {
        $paramList = array();
        $paramList['icon'] = trim($this->getPost("icon"));
        $paramList['name_lang1'] = trim($this->getPost("nameLang1"));
        $paramList['name_lang2'] = trim($this->getPost("nameLang2"));
        $paramList['name_lang3'] = trim($this->getPost("nameLang3"));
        $paramList['pdf'] = $_FILES['pdf'];
        $paramList['introduct_lang1'] = trim($this->getPost("introductLang1"));
        $paramList['introduct_lang2'] = trim($this->getPost("introductLang2"));
        $paramList['introduct_lang3'] = trim($this->getPost("introductLang3"));
        $paramList['hotelid'] = intval($this->getHotelId());
        $paramList['status'] = intval($this->getPost('status'));
        return $paramList;
    }

    public function createRoomResAction() {
        $paramList = $this->handlerRoomResSaveParams();
        $result = $this->roomModel->saveRoomResDataInfo($paramList);
        $this->echoJson($result);
    }

    public function updateRoomResAction() {
        $paramList = $this->handlerRoomResSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->roomModel->saveRoomResDataInfo($paramList);
        $this->echoJson($result);
    }

    public function getRoomTypeListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['hotelid'] = $this->getHotelId();
        $paramList['id'] = intval($this->getPost('id'));
        $paramList['title'] = $this->getPost('title');
        $result = $this->roomModel->getRoomTypeList($paramList);
        $result = $this->roomConvertor->roomTypeListConvertor($result);
        $this->echoJson($result);
    }

    private function handlerRoomTypeSaveParams() {
        $paramList = array();
        $paramList['title_lang1'] = trim($this->getPost("titleLang1"));
        $paramList['title_lang2'] = trim($this->getPost("titleLang2"));
        $paramList['title_lang3'] = trim($this->getPost("titleLang3"));
        $paramList['size'] = trim($this->getPost("size"));
        $paramList['panoramic'] = trim($this->getPost("panoramic"));
        $paramList['bedtype_lang1'] = trim($this->getPost("bedtypeLang1"));
        $paramList['bedtype_lang2'] = trim($this->getPost("bedtypeLang2"));
        $paramList['bedtype_lang3'] = trim($this->getPost("bedtypeLang3"));
        $paramList['hotelid'] = intval($this->getHotelId());
        return $paramList;
    }

    public function createRoomTypeAction() {
        $paramList = $this->handlerRoomTypeSaveParams();
        $result = $this->roomModel->saveRoomTypeDataInfo($paramList);
        $this->echoJson($result);
    }

    public function updateRoomTypeAction() {
        $paramList = $this->handlerRoomTypeSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->roomModel->saveRoomTypeDataInfo($paramList);
        $this->echoJson($result);
    }

    public function updateRoomTypeResAction() {
        $paramList['id'] = intval($this->getPost("id"));
        $paramList['resid_list'] = trim($this->getPost("typeres"));
        $result = $this->roomModel->saveRoomTypeRes($paramList);
        $this->echoJson($result);
    }
}
