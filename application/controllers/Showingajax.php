<?php

/**
 * 预约看房请求控制器
 */
class ShowingajaxController extends \BaseController {

    /**
     * @var ShowingModel
     */
    private $showingModel;

    /**
     * @var Convertor_Showing
     */
    private $showingConvertor;

    public function init() {
        parent::init();
        $this->showingModel = new ShowingModel();
        $this->showingConvertor = new Convertor_Showing();
    }

    /**
     * 获取预约看房订单列表
     */
    public function getOrderListAction() {
        $paramList['id'] = intval($this->getPost('id'));
        $paramList['status'] = intval($this->getPost('status'));
        $paramList['name'] = trim($this->getPost('name'));
        $paramList['phone'] = trim($this->getPost('phone'));
        $paramList['hotelid'] = intval($this->getHotelId());
        $result = $this->showingModel->getOrderList($paramList);
        $result = $this->showingConvertor->orderListConvertor($result);
        $this->echoJson($result);
    }
}
