<?php

/**
 * Class RobotModel
 */
class RobotModel extends \BaseModel
{

    private $_positionTypeList = array(
        1 => '房间',
        2 => '楼层',
        3 => '其他公共区域'
    );

    public function getPositionTypeList()
    {
        return $this->_positionTypeList;
    }


    /**
     * Save position to DB
     *
     * @param $paramList
     * @return mixed|array
     */
    public function savePosition($paramList)
    {
        $params = $this->initParam($paramList);
        do {
            $result = array(
                'code' => 1,
                'msg' => '参数错误'
            );
            if (empty($params['position']) || empty($params['robot_position'])) {
                break;
            }
            $interfaceId = $params['id'] ? 'RT002' : 'RT001';
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
            if (!$result['code']) {
                $this->getPositionList(array('hotelid' => $params['hotelid']), -2);
            }
        } while (false);
        return $result;
    }


    /**
     * Get position list
     *
     * @param $paramList
     * @return array
     */
    public function getPositionList($paramList, $cacheTime = 0)
    {
        do {
            $paramList['id'] ? $params['id'] = $paramList['id'] : false;
            $paramList['type'] ? $params['type'] = $paramList['type'] : false;
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            $this->setPageParam($params, $paramList['page'], $paramList['limit'], 10);
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('RT003', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }
}
