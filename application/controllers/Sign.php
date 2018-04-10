<?php

/**
 * Class SignController
 */
class SignController extends \BaseController
{

    public function categoryAction()
    {
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->_view->display('sign/sign_category.phtml');
    }

    public function itemAction()
    {
        $signModel = new SignModel();
        $categoryList = $signModel->getSignCategoryList(array(
            'hotelid' => $this->getHotelId(),
            'status' => 0 // status of enable
        ), 0);

        $this->_view->assign('categoryList', $categoryList['data']['list']);
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->_view->display('sign/item.phtml');
    }

}