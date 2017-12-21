<?php

/**
 * Class ServiceModel
 */
class ServiceModel extends \BaseModel
{

    const TASK_ORDER_STATUS_OPEN = 1;
    const TASK_ORDER_STATUS_PROCESSING = 2;
    const TASK_ORDER_STATUS_FINISH = 3;

    private $_taskOrderStatusArr;


    public function __construct()
    {
        parent::__construct();
        $this->_taskOrderStatusArr = array(
            self::TASK_ORDER_STATUS_OPEN => Enum_Lang::getPageText('service', 'open'),
            self::TASK_ORDER_STATUS_PROCESSING => Enum_Lang::getPageText('service', 'processing'),
            self::TASK_ORDER_STATUS_FINISH => Enum_Lang::getPageText('service', 'finish'),
        );
    }

    /**
     * @return array
     */
    public function getTaskOrderStatusArr(): array
    {
        return $this->_taskOrderStatusArr;
    }

    /**
     * Get task category list
     */
    public function getTaskCategoryList($paramList = array(), $cacheTime = 0)
    {
        do {
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
            if (!is_null($params['pic'])) {
                $uploadResult = $this->uploadFile($params['pic'], Enum_Oss::OSS_PATH_IMAGE);
                if ($uploadResult['code']) {
                    $errorMsg = '图上传失败:' . $uploadResult['msg'];
                    $this->throwException($errorMsg, $uploadResult['code']);
                }
                $params['pic'] = $uploadResult['data']['picKey'];
            }
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


    /**
     * Get task list
     */
    public function getTaskList($paramList = array(), $cacheTime = 0)
    {
        do {
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            if ($cacheTime == 0) {
                $paramList['id'] ? $params['id'] = intval($paramList['id']) : false;
                $paramList['category_id'] ? $params['category_id'] = intval($paramList['category_id']) : false;
                isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('IS004', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * Get task order list
     */
    public function getTaskOrderList($paramList = array(), $cacheTime = 0)
    {
        do {
            $paramList['hotelid'] ? $params['hotelid'] = $paramList['hotelid'] : false;
            if ($cacheTime == 0) {
                $paramList['id'] ? $params['id'] = intval($paramList['id']) : false;
                $paramList['category_id'] ? $params['category_id'] = intval($paramList['category_id']) : false;
                isset($paramList['status']) ? $params['status'] = $paramList['status'] : false;
                isset($paramList['userid']) ? $params['userid'] = $paramList['userid'] : false;
                $this->setPageParam($params, $paramList['page'], $paramList['limit'], 15);
            } else {
                $params['limit'] = 0;
            }
            $isCache = $cacheTime != 0 ? true : false;
            $result = $this->rpcClient->getResultRaw('IS007', $params, $isCache, $cacheTime);
        } while (false);
        return (array)$result;
    }

    /**
     * Create or update task category detail
     */
    public function saveTask($paramList = array())
    {
        $params = array();
        $paramList['title_lang1'] ? $params['title_lang1'] = $paramList['title_lang1'] : $this->throwException('Lack chinese title', 1);
        $paramList['title_lang2'] ? $params['title_lang2'] = $paramList['title_lang2'] : false;
        $paramList['title_lang3'] ? $params['title_lang3'] = $paramList['title_lang3'] : false;
        $paramList['category_id'] ? $params['category_id'] = $paramList['category_id'] : false;
        $paramList['id'] ? $params['id'] = $paramList['id'] : false;

        !is_null($paramList['price']) ? $params['price'] = floatval($paramList['price']) : false;
        !is_null($paramList['status']) ? $params['status'] = $paramList['status'] : false;

        if (!is_null($paramList['pic'])) {
            $uploadResult = $this->uploadFile($paramList['pic'], Enum_Oss::OSS_PATH_IMAGE);
            if ($uploadResult['code']) {
                $errorMsg = '图上传失败:' . $uploadResult['msg'];
                $this->throwException($errorMsg, $uploadResult['code']);
            }
            $params['pic'] = $uploadResult['data']['picKey'];
        }

        $interfaceId = $params['id'] ? 'IS006' : 'IS005';
        $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        if (!$result['code']) {
            $this->getTaskList(array('hotelid' => $params['hotelid']), -2);
        }

        return $result;
    }

    /**
     * Create or update task category detail
     */
    public function saveTaskProcess($paramList = array())
    {
        $params = array();
        $paramList['id'] ? $params['id'] = intval($paramList['id']) : $this->throwException("Lack of id", 1);
        !is_null($paramList['department_id']) ? $params['department_id'] = intval($paramList['department_id']) : false;
        !is_null($paramList['staff_id']) ? $params['staff_id'] = intval($paramList['staff_id']) : false;
        !is_null($paramList['highest_level']) ? $params['highest_level'] = intval($paramList['highest_level']) : false;
        !is_null($paramList['level_interval_1']) ? $params['level_interval_1'] = intval($paramList['level_interval_1']) : false;
        !is_null($paramList['level_interval_2']) ? $params['level_interval_2'] = intval($paramList['level_interval_2']) : false;
        !is_null($paramList['level_interval_3']) ? $params['level_interval_3'] = intval($paramList['level_interval_3']) : false;
        !is_null($paramList['level_interval_4']) ? $params['level_interval_4'] = intval($paramList['level_interval_4']) : false;
        !is_null($paramList['level_interval_5']) ? $params['level_interval_5'] = intval($paramList['level_interval_5']) : false;
        !is_null($paramList['sms']) ? $params['sms'] = intval($paramList['sms']) : false;
        !is_null($paramList['email']) ? $params['email'] = intval($paramList['email']) : false;


        $interfaceId = 'IS006';
        $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        if (!$result['code']) {
            $this->getTaskList(array('hotelid' => $params['hotelid']), -2);
        }

        return $result;
    }

    /**
     * Create or update task order detail
     */
    public function saveTaskOrder($paramList = array())
    {
        $params = array();
        $paramList['id'] ? $params['id'] = $paramList['id'] : false;
        $interfaceId = $params['id'] ? 'IS009' : 'IS008';

        $paramList['task_id'] ? $params['task_id'] = intval($paramList['task_id']) : false;
        $paramList['user_id'] ? $params['userid'] = intval($paramList['user_id']) : false;
        $paramList['room_no'] ? $params['room_no'] = trim($paramList['room_no']) : false;
        $paramList['admin_id'] ? $params['admin_id'] = intval($paramList['admin_id']) : false;
        $paramList['count'] ? $params['count'] = intval($paramList['count']) : false;
        $paramList['memo'] ? $params['memo'] = trim($paramList['memo']) : false;
        $paramList['status'] ? $params['status'] = intval($paramList['status']) : false;
        $paramList['updated_at'] ? $params['updated_at'] = intval($paramList['updated_at']) : false;
        $paramList['created_at'] ? $params['created_at'] = intval($paramList['created_at']) : false;
        $paramList['delay'] ? $params['delay'] = strtotime($paramList['delay']) : false;

        $result = $this->rpcClient->getResultRaw($interfaceId, $params);
        return $result;
    }

}
