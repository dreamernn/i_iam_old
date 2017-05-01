<?php
class PromotionController extends BaseController{
	
	public function init(){
		parent::init();
	}
	
	/**
	 * 获取标签列表
	 */
	public function tagListAction(){
		$this->_view->display('promotion/tag.phtml');
	}
	
	/**
	 * 获取标签列表
	 */
	public function listAction(){
		$this->_view->display('promotion/promotion.phtml');
	}
}