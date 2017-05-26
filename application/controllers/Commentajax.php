<?php

/**
 * 评论请求控制器
 */
class CommentajaxController extends \BaseController {

    /**
     * @var CommentModel
     */
    private $CommentModel;

    /**
     * @var Convertor_Comment
     */
    private $CommentConvertor;

    public function init() {
        parent::init();
        $this->CommentModel = new CommentModel();
        $this->CommentConvertor = new Convertor_Comment();
    }

    /**
     * 获取评论列表
     */
    public function getListAction() {
        $paramList['page'] = $this->getPost('page');
        $paramList['hotelid'] = $this->getHotelId();
        $paramList['datatype'] = intval($this->getPost('datatype'));
        $paramList['dataid'] = intval($this->getPost('dataid'));
        $paramList['roomno'] = trim($this->getPost('roomno'));
        $paramList['status'] = intval($this->getPost('status'));
        $result = $this->CommentModel->getCommentList($paramList);
        $result = $this->CommentConvertor->CommentListConvertor($result);
        $this->echoJson($result);
    }

    /**
     * 更新评论信息
     */
    public function updateCommentAction() {
        $paramList['id'] = intval($this->getPost("id"));
        $paramList['status'] = intval($this->getPost("status"));
        $result = $this->CommentModel->saveCommentDataInfo($paramList);
        $this->echoJson($result);
    }

}
