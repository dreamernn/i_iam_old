<?php

/**
 * 体验购物控制器
 */
class ShoppingController extends \BaseController {

    /**
     * @var ShoppingModel
     */
    private $model;

    public function init()
    {
        parent::init();
        $this->model = new ShoppingModel();
    }

    public function tagAction() {


        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $firstLevelTag = $this->model->getTagList(
            array(
                'hotelid' => $this->getHotelId(),
                'status' => Enum_System::ALL,
                'parentid' => 0,
                'limit' => 0,
            )
        );
        $this->_view->assign('firstLevelTag', $firstLevelTag['data']['list']);
        $this->_view->display('shopping/tag.phtml');
    }

    /**
     * 体验购物管理
     */
    public function listAction() {
        $tagList = $this->model->getTagList(
            array(
                'hotelid' => $this->getHotelId(),
                'status' => 0,
                'parentid' => 0,
                'withchild' => true,
                'limit' => 0,
            ), 3600 * 3);
        $this->_view->assign('tagList', $tagList['data']['list']);
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_PDF, 'allowTypePdf');
        $this->setAllowUploadFileType(Enum_Oss::OSS_PATH_IMAGE, 'allowTypeImage');
        $this->_view->display('shopping/shopping.phtml');
    }

    /**
     * 体验购物订单管理
     */
    public function orderAction()
    {
        $filterList = $this->model->getShoppingOrderFilterList(array('hotelid' => $this->getHotelId()), 3600);
        $shoppingList = $this->model->getShoppingList(array('hotelid' => $this->getHotelId()), 3600);

        $this->_view->assign('shoppingList', $shoppingList['data']['list']);
        $this->_view->assign('userId', $this->userInfo['id']);
        $this->_view->assign('userName', $this->userInfo['lname']);
        $this->_view->assign('userList', $filterList['data']['userlist']);
        $this->_view->assign('statusList', $filterList['data']['statuslist']);
        $this->_view->assign('noDeliver', false);

        $this->_view->display('shopping/order.phtml');

    }
}
