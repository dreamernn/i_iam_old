<?php

/**
 * Config Model
 */
class ConfigModel extends \BaseModel
{


    public function getConfigDetail($paramList)
    {
        do {
            $params = array();
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $paramList['userid'] ? $params['userid'] = $paramList['userid'] : false;
            $paramList['staffid'] ? $params['staffid'] = $paramList['staffid'] : false;
            $paramList['name'] ? $params['name'] = $paramList['name'] : false;
            $result = $this->rpcClient->getResultRaw('CG001', $params);
        } while (false);
        return (array)$result;
    }


    public function updateConfig($params)
    {
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            if (empty($params['id']) || empty($params['value'])) {
                break;
            }
            $result = $this->rpcClient->getResultRaw('CG002', $params);
        } while (false);
        return (array)$result;
    }

}
