<?php

/**
 * @author ZXM
 */
class ShoppingajaxController extends \BaseController {

    /**
     * @var ShoppingModel
     */
    private $shoppingModel;

    /**
     * @var Convertor_Shopping
     */
    private $shoppingConvertor;

    public function init() {
        parent::init();
        $this->shoppingModel = new ShoppingModel();
        $this->shoppingConvertor = new Convertor_Shopping();
    }

    /**
     * 获取tag列表
     */
    public function getTagListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['hotelid'] = $this->getHotelId();
        $result = $this->shoppingModel->getTagList($paramList);
        $result = $this->shoppingConvertor->shoppingTagListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * 新建和编辑tag信息数据
     */
    private function handlerTagSaveParams() {
        $paramList = array();
        $paramList['title_lang1'] = trim($this->getPost("titleLang1"));
        $paramList['title_lang2'] = trim($this->getPost("titleLang2"));
        $paramList['title_lang3'] = trim($this->getPost("titleLang3"));
        $paramList['hotelid'] = intval($this->getHotelId());
        return $paramList;
    }

    /**
     * 新建tag信息
     */
    public function createTagAction() {
        $paramList = $this->handlerTagSaveParams();
        $result = $this->shoppingModel->saveTagDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 更新tag信息
     */
    public function updateTagAction() {
        $paramList = $this->handlerTagSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->shoppingModel->saveTagDataInfo($paramList);
        $this->echoJson($result);
    }

    public function getShoppingListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['hotelid'] = $this->getHotelId();
        $paramList['id'] = intval($this->getPost('id'));
        $paramList['tagid'] = intval($this->getPost('tag'));
        $paramList['title'] = $this->getPost('title');
        $status = $this->getPost('status');
        $status !== 'all' && !is_null($status) ? $paramList['status'] = intval($status) : false;
        $result = $this->shoppingModel->getShoppingList($paramList);
        $result = $this->shoppingConvertor->shoppingListConvertor($result);
        $this->echoJson($result);
    }

    private function handlerShoppingSaveParams() {
        $paramList = array();
        $paramList['title_lang1'] = trim($this->getPost("titleLang1"));
        $paramList['title_lang2'] = trim($this->getPost("titleLang2"));
        $paramList['title_lang3'] = trim($this->getPost("titleLang3"));
        $paramList['introduct_lang1'] = trim($this->getPost("introductLang1"));
        $paramList['introduct_lang2'] = trim($this->getPost("introductLang2"));
        $paramList['introduct_lang3'] = trim($this->getPost("introductLang3"));
        $paramList['tagid'] = intval($this->getPost("tagid"));
        $paramList['pic'] = $_FILES['pic'];
        $paramList['hotelid'] = intval($this->getHotelId());
        return $paramList;
    }

    public function createShoppingAction() {
        $paramList = $this->handlerShoppingSaveParams();
        $result = $this->shoppingModel->saveShoppingDataInfo($paramList);
        $this->echoJson($result);
    }

    public function updateShoppingAction() {
        $paramList = $this->handlerShoppingSaveParams();
        $paramList['id'] = intval($this->getPost("id"));
        $result = $this->shoppingModel->saveShoppingDataInfo($paramList);
        $this->echoJson($result);
    }

    public function getOrderListAction() {
        $paramList['id'] = intval($this->getPost('id'));
        $paramList['shoppingid'] = intval($this->getPost('shoppingid'));
        $paramList['hotelid'] = intval($this->getHotelId());
        $result = $this->shoppingModel->getOrderList($paramList);
        $result = $this->shoppingConvertor->orderListConvertor($result);
        $this->echoJson($result);
    }
}
