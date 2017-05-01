<?php

/**
 * Class ShoppingController
 * @author ZXM
 */
class ShoppingController extends \BaseController {

    public function tagAction() {
        $this->_view->display('shopping/tag.phtml');
    }

    public function listAction() {
        $shoppingModel = new ShoppingModel();
        $tagList = $shoppingModel->getTagList(array('hotelid' => $this->getHotelId()), 3600 * 3);
        $this->_view->assign('tagList', $tagList['data']['list']);
        $this->_view->display('shopping/shopping.phtml');
    }

    public function orderAction() {
        $shoppingModel = new ShoppingModel();
        $shoppingList = $shoppingModel->getShoppingList(array('hotelid' => $this->getHotelId()), 3600);
        $this->_view->assign('shoppingList', $shoppingList['data']['list']);
        $this->_view->display('shopping/order.phtml');
    }
}
