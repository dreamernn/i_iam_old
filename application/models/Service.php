<?php

/**
 * Class ServiceModel
 */
class ServiceModel extends \BaseModel
{

    /**
     * Get task category list
     */
    public function getTaskCategoryList($paramList, $cacheTime = 0)
    {
        do {
            $params = array(
                'type' => Enum_Service::PERMISSION_TYPE_TASK,
            );
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            if ($cacheTime == 0) {
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('IS001', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * Create or update task category detail
     */
    public function saveCategory($params = array())
    {
        try {
            $interfaceId = $params['id'] ? 'IS003' : 'IS002';
            if (empty($params['title_lang1']) && empty($params['title_lang2'])) {
                $this->throwException("Lack of param", 1);
            }
            $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        } catch (Exception $e) {
            $result['code'] = $e->getCode();
            $result['msg'] = $e->getMessage();
        }
        return $result;
    }
}
