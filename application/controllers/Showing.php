<?php

/**
 * Class ShowingController
 *
 */
class ShowingController extends \BaseController {

    public function orderAction() {
        $this->_view->display('showing/order.phtml');
    }
}
