<?php

/**
 * 预约看房控制器
 */
class ShowingController extends \BaseController {

    /**
     * 预约看房订单
     */
    public function orderAction() {
        $this->_view->display('showing/order.phtml');
    }
}
