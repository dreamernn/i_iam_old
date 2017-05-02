<?php

class AscottajaxController extends \BaseController {
	private $model;

	private $convertor;

	public function init() {
		parent::init();
		$this->model = new AscottModel();
		$this->convertor = new Convertor_Ascott();
	}

	/**
	 * 获取tag列表
	 */
	public function getTagListAction() {
		$paramList['page'] = $this->getPost('page');
		$paramList['limit'] = $this->getPost('limit');
		$paramList['hotelid'] = $this->getHotelId();
		$result = $this->model->getTagList($paramList);
		$result = $this->convertor->tagListConvertor($result);
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
		$result = $this->model->saveTagDataInfo($paramList);
		$this->echoJson($result);
	}

	/**
	 * 更新tag信息
	 */
	public function updateTagAction() {
		$paramList = $this->handlerTagSaveParams();
		$paramList['id'] = intval($this->getPost("id"));
		$result = $this->model->saveTagDataInfo($paramList);
		$this->echoJson($result);
	}

	/**
	 * 获取活动列表
	 * 
	 */
	public function getListAction() {
		$paramList['page'] = $this->getPost('page');
		$paramList['hotelid'] = $this->getHotelId();
		$paramList['id'] = intval($this->getPost('id'));
		$paramList['tagid'] = intval($this->getPost('tag'));
		$paramList['title'] = $this->getPost('title');
		$status = $this->getPost('status');
		$status !== 'all' && !is_null($status) ? $paramList['status'] = intval($status) : false;
		$result = $this->model->getList($paramList);
		$result = $this->convertor->getListConvertor($result);
		$this->echoJson($result);
	}

	private function handlerSaveParams() {
		$paramList = array();
		$paramList['title_lang1'] = trim($this->getPost("titleLang1"));
		$paramList['title_lang2'] = trim($this->getPost("titleLang2"));
		$paramList['title_lang3'] = trim($this->getPost("titleLang3"));
		$paramList['tagid'] = intval($this->getPost("tagid"));
		$paramList['status'] = intval($this->getPost("status"));
		$paramList['hotelid'] = intval($this->getHotelId());
		$paramList['groupid'] = intval($this->getGroupId());
		return $paramList;
	}

	public function createAction() {
		$paramList = $this->handlerSaveParams();
		$result = $this->model->saveDataInfo($paramList);
		$this->echoJson($result);
	}

	public function updateAction() {
		$paramList = $this->handlerSaveParams();
		$paramList['id'] = intval($this->getPost("id"));
		$result = $this->model->saveInfo($paramList);
		$this->echoJson($result);
	}
}
