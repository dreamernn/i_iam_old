<?php

/**
 * 文章管理控制器
 */
class ArticleController extends \BaseController {

    /**
     * 文章编辑器
     */
    public function editorAction() {
        $dataId = intval($this->getGet('dataid'));
        $dataType = trim($this->getGet('datatype'));
        $article = trim($this->getGet('article'));

        $articleContent = '';
        if ($article) {
            $articleLink = Enum_Img::getPathByKeyAndType($article);
            $articleContent = Util_Http::fileGetContentsWithTimeOut($articleLink, 10);
        }
        $this->_view->assign('dataid', $dataId);
        $this->_view->assign('datatype', $dataType);
        $this->_view->assign('articleContent', $articleContent);
        $this->_view->assign('article', $article);
        $this->_view->display('article/editor.phtml');
    }

    /**
     * 保存文章
     */
    public function saveAction() {
        $paramList['dataid'] = intval($this->getPost('dataid'));
        $paramList['datatype'] = trim($this->getPost('datatype'));
        $paramList['article'] = trim($this->getPost('article'));
        $paramList['content'] = $this->getPost('content');
        $paramList['hotelid'] = $this->getHotelId();

        $articleModle = new ArticleModel();
        $result = $articleModle->saveArticleDataInfo($paramList);
        $this->echoJson($result);
    }

    /**
     * 上传文章图片
     */
    public function uploadImageAction() {
        $baseModel = new BaseModel();
        $uploadResult = $baseModel->uploadFile($_FILES['upload'], Enum_Oss::OSS_PATH_IMAGE);
        echo '<script type="text/javascript">';
        $callBack = $this->getGet('CKEditorFuncNum');
        if ($uploadResult['code']) {
            echo "window.parent.CKEDITOR.tools.callFunction(" . $callBack . ",'','" . $uploadResult['msg'] . "');";
        } else {
            echo "window.parent.CKEDITOR.tools.callFunction(" . $callBack . ",'" . Enum_Img::getPathByKeyAndType($uploadResult['data']['picKey']) . "','')";
        }
        echo '</script>';
    }
}
