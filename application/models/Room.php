<?php

class RoomModel extends \BaseModel {

    public function getRoomResList($paramList, $cacheTime = 0) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            if ($cacheTime == 0) {
                $paramList['id'] ? $params['id'] = $paramList['id'] : false;
                $paramList['icon'] ? $params['icon'] = $paramList['icon'] : false;
                $paramList['name'] ? $params['name'] = $paramList['name'] : false;
                isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('R001', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    public function saveRoomResDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['icon'] ? $params['icon'] = $paramList['icon'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['name_lang1'] ? $params['name_lang1'] = $paramList['name_lang1'] : false;
            $paramList['name_lang2'] ? $params['name_lang2'] = $paramList['name_lang2'] : false;
            $paramList['name_lang3'] ? $params['name_lang3'] = $paramList['name_lang3'] : false;
            $paramList['introduct_lang1'] ? $params['introduct_lang1'] = $paramList['introduct_lang1'] : false;
            $paramList['introduct_lang2'] ? $params['introduct_lang2'] = $paramList['introduct_lang2'] : false;
            $paramList['introduct_lang3'] ? $params['introduct_lang3'] = $paramList['introduct_lang3'] : false;
            !is_null($paramList['status']) ? $params['status'] = intval($paramList['status']) : false;

            if (empty($params['name_lang1']) || empty($params['icon'])) {
                break;
            }

            if ($paramList['pdf']) {
                $uploadResult = $this->uploadFile($paramList['pdf'], Enum_Oss::OSS_PATH_PDF);
                if ($uploadResult['code']) {
                    $result['msg'] = 'pdf上传失败:' . $uploadResult['msg'];
                    break;
                }
                $params['pdf'] = $uploadResult['data']['picKey'];
            }

            $interfaceId = $params['id'] ? 'R003' : 'R002';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            if (!$result['code']) {
                $this->getRoomResList(array('hotelid' => $params['hotelid']), -2);
            }
        } while (false);
        return $result;
    }

    public function getRoomTypeList($paramList) {
        do {
            $params['hotelid'] = $paramList['hotelid'];
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['title'] ? $params['title'] = $paramList['title'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            $result = $this->rpcClient->getResultRaw('R004', $params);
        } while (false);
        return (array)$result;
    }

    public function saveRoomTypeDataInfo($paramList) {
        $params = $this->initParam();
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );

            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['title_lang1'] ? $params['title_lang1'] = $paramList['title_lang1'] : false;
            $paramList['title_lang2'] ? $params['title_lang2'] = $paramList['title_lang2'] : false;
            $paramList['title_lang3'] ? $params['title_lang3'] = $paramList['title_lang3'] : false;
            $paramList['size'] ? $params['size'] = $paramList['size'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['panoramic'] ? $params['panoramic'] = $paramList['panoramic'] : false;
            $paramList['bedtype_lang1'] ? $params['bedtype_lang1'] = $paramList['bedtype_lang1'] : false;
            $paramList['bedtype_lang2'] ? $params['bedtype_lang2'] = $paramList['bedtype_lang2'] : false;
            $paramList['bedtype_lang3'] ? $params['bedtype_lang3'] = $paramList['bedtype_lang3'] : false;

            if (empty($params['title_lang1'])) {
                break;
            }

            $interfaceId = $params['id'] ? 'R006' : 'R005';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } while (false);
        return $result;
    }

    public function saveRoomTypeRes($paramList) {
        $params = $this->initParam($paramList);
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            if (empty($params['id'])) {
                break;
            }
            $result = $this->rpcClient->getResultRaw('R006', $params);
        } while (false);
        return $result;
    }
}
