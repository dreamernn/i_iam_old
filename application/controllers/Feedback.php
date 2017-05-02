<?php

/**
 * Class FeedbackController
 */
class FeedbackController extends \BaseController {

    public function questionAction() {
        $this->_view->display('feedback/question.phtml');
    }

    public function resultAction() {
        $this->_view->display('feedback/result.phtml');
    }
}
