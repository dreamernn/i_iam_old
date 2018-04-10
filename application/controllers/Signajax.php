<?php

/**
 * Class SignajaxController
 */
class SignajaxController extends \BaseController
{

    /**
     * @var SignModel
     */
    private $_signModel;

    /**
     * @var Convertor_Sign
     */
    private $_signConvertor;


    public function init()
    {
        parent::init();
        $this->_signModel = new SignModel();
        $this->_signConvertor = new Convertor_Sign();
    }


    /**
     * Ajax for getting category list
     */
    public function getCategoryListAction()
    {
        $params = array();
        $params['page'] = intval($this->getPost('page'));
        $params['limit'] = intval($this->getPost('limit'));
        $params['hotelid'] = $this->getHotelId();
        $result = $this->_signModel->getSignCategoryList($params);
        $result = $this->_signConvertor->signCategoryConvertor($result);
        $this->echoJson($result);
    }

    public function addCategoryAction()
    {
        $params = $this->_handleCategoryParams();
        $result = $this->_signModel->saveCategory($params);
        $this->echoJson($result);
    }

    public function updateSignCategoryAction()
    {
        $params = $this->_handleCategoryParams();
        $result = $this->_signModel->saveCategory($params);
        $this->echoJson($result);
    }

    public function getItemListAction()
    {
        $params = array();
        $params['hotelid'] = $this->getHotelId();
        $status = $this->getPost('status');
        $status == 'all' || is_null($status) ? false : $params['status'] = intval($status);
        $categoryId = $this->getPost('categoryid');
        $categoryId == 'all' || is_null($categoryId) ? false : $params['category_id'] = intval($categoryId);
        $params['id'] = $this->getPost('id');

        $result = $this->_signModel->getItemList($params);
        $result = $this->_signConvertor->signItemListConvertor($result);
        $this->echoJson($result);
    }

    public function addItemAction()
    {
        $params = $this->_handleItemParams();
        $result = $this->_signModel->saveItem($params);
        $this->echoJson($result);

    }

    public function updateItemAction()
    {
        $params = $this->_handleItemParams();
        $result = $this->_signModel->saveItem($params);
        $this->echoJson($result);
    }

    private function _handleItemParams()
    {
        $params = array();
        $params['id'] = intval($this->getPost('id'));
        $params['hotelid'] = $this->getHotelId();
        $params['category_id'] = $this->getPost('categoryid');
        $params['title_lang1'] = trim($this->getPost('titleLang1'));
        $params['title_lang2'] = trim($this->getPost('titleLang2'));
        $params['title_lang3'] = trim($this->getPost('titleLang3'));
        $params['status'] = $this->getPost('status');

        return $params;
    }

    private function _handleCategoryParams()
    {
        $params = array();
        $params['id'] = intval($this->getPost('id'));
        $params['hotelid'] = $this->getHotelId();
        $params['title_lang1'] = trim($this->getPost('titleLang1'));
        $params['title_lang2'] = trim($this->getPost('titleLang2'));
        $params['title_lang3'] = trim($this->getPost('titleLang3'));
        $params['status'] = intval($this->getPost('status'));
        $params['pic'] = $this->getFile('pic');

        return $params;
    }


}
