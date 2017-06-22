<?php

/**
 * 本地攻略控制器
 */
class PoiController extends BaseController {

    public function init() {
        parent::init();
    }

    /**
     * 标签列表
     */
    public function typeListAction() {
        $this->_view->display('poi/type.phtml');
    }

    /**
     * 标签列表
     */
    public function tagAction() {
        $this->_view->display('poi/tag.phtml');
    }

    /**
     * 本地攻略列表
     */
    public function listAction() {
        $poiModel = new PoiModel();
        $typeList = $poiModel->getTypeList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('typeList', $typeList['data']['list']);
        $tagList = $poiModel->getTagList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('tagList', $tagList['data']['list']);
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_PDF, 'allowTypePdf');
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->_view->display('poi/poi.phtml');
    }
}