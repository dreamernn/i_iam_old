<?php

class PromotionModel extends \BaseModel {

    public function getTagList($paramList, $cacheTime = 0) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            if ($cacheTime == 0) {
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('GA003', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    public function saveTagDataInfo($paramList) {
        $params = $this->initParam($paramList);
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            if (empty($params['title_lang1']) || empty($params['hotelid'])) {
                break;
            }
            $interfaceId = $params['id'] ? 'GA005' : 'GA004';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            if (!$result['code']) {
                $this->getTagList(array('hotelid' => $params['hotelid']), -2);
            }
        } while (false);
        return $result;
    }

    public function getList($paramList) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['tagid'] ? $params['tagid'] = $paramList['tagid'] : false;
            $paramList['title'] ? $params['title'] = $paramList['title'] : false;
            isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('GA001', $params);
        } while (false);
        return (array)$result;
    }

    public function saveInfo($paramList) {
        $params = $this->initParam($paramList);
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            if (empty($params['title_lang1']) || empty($params['hotelid'])) {
                break;
            }
            $interfaceId = $params['id'] ? 'GA007' : 'GA006';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }
}
