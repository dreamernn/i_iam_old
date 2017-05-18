<?php

/**
 * 雅士阁生活控制器
 */
class AscottController extends BaseController {

    public function init() {
        parent::init();
    }

    /**
     * 获取标签列表
     */
    public function typeListAction() {
        $this->_view->display('ascott/type.phtml');
    }

    /**
     * 获取雅士阁生活列表
     */
    public function listAction() {
        $ascottModel = new AscottModel();
        $typeList = $ascottModel->getTypeList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('typeList', $typeList['data']['list']);
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_PDF, 'allowTypePdf');
        $this->_view->display('ascott/ascott.phtml');
    }
}