<?php

class AppModel extends \BaseModel {

    public function getPushList($paramList) {
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['type'] ? $params['type'] = $paramList['type'] : false;
            $paramList['dataid'] ? $params['dataid'] = $paramList['dataid'] : false;
            isset($paramList['result']) ? $params['result'] = $paramList['result'] : false;
            isset($paramList['platform']) ? $params['platform'] = $paramList['platform'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('APP004', $params);
        } while (false);
        return (array)$result;
    }

    public function createPush($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['platform'] ? $params['platform'] = $paramList['platform'] : false;
            $paramList['type'] ? $params['type'] = $paramList['type'] : false;
            $paramList['dataid'] ? $params['dataid'] = $paramList['dataid'] : false;
            $paramList['cn_title'] ? $params['cn_title'] = $paramList['cn_title'] : false;
            $paramList['cn_value'] ? $params['cn_value'] = $paramList['cn_value'] : false;
            $paramList['en_title'] ? $params['en_title'] = $paramList['en_title'] : false;
            $paramList['en_value'] ? $params['en_value'] = $paramList['en_value'] : false;
            $paramList['url'] ? $params['url'] = $paramList['url'] : false;

            $checkParams = Enum_App::getPushMustInput();
            foreach ($checkParams as $checkParamOne) {
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
            }
            $result = $this->rpcClient->getResultRaw('APP005', $params);
        } while (false);
        return $result;
    }

    public function getShortCutList($paramList) {
        do {
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $result = $this->rpcClient->getResultRaw('APP001', $params);
        } while (false);
        return (array)$result;
    }

    public function saveShortcutDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['key'] ? $params['key'] = $paramList['key'] : false;
            $paramList['sort'] ? $params['sort'] = $paramList['sort'] : false;
            $paramList['title_lang1'] ? $params['title_lang1'] = $paramList['title_lang1'] : false;
            $paramList['title_lang2'] ? $params['title_lang2'] = $paramList['title_lang2'] : false;
            $paramList['title_lang3'] ? $params['title_lang3'] = $paramList['title_lang3'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;

            $checkParams = Enum_App::getShortcutMustInput();
            foreach ($checkParams as $checkParamOne) {
                $checkParamOne = str_replace('Lang', '_lang', $checkParamOne);
                if (empty($params[$checkParamOne])) {
                    break 2;
                }
            }
            $interfaceId = $params['id'] ? 'APP003' : 'APP002';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }

    public function getShareList($paramList) {
        do {
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $result = $this->rpcClient->getResultRaw('APP006', $params);
        } while (false);
        return (array)$result;
    }

    public function updateShare($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['share'] ? $params['share'] = $paramList['share'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $result = $this->rpcClient->getResultRaw('APP007', $params);
        } while (false);
        return $result;
    }
}
