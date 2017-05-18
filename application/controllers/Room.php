<?php

/**
 * 客房管理
 */
class RoomController extends \BaseController {

    /**
     * 房型管理
     */
    public function roomTypeAction() {
        $roomModel = new RoomModel();
        $resList = $roomModel->getRoomResList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('resList', $resList['data']['list']);
        $this->_view->display('room/roomType.phtml');
    }

    /**
     * 房间物品管理
     */
    public function roomResAction() {
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_PDF, 'allowTypePdf');
        $this->_view->display('room/roomRes.phtml');
    }

    /**
     * 房间管理
     */
    public function roomListAction() {
        $hotelModel = new HotelModel();
        $floorList = $hotelModel->getFloorList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('floorList', $floorList['data']['list']);
        $roomModel = new RoomModel();
        $roomTypeList = $roomModel->getRoomTypeList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('roomTypeList', $roomTypeList['data']['list']);
        $this->_view->display('room/room.phtml');
    }
}
