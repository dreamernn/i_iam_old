<?php

/**
 * Class Convertor_Service
 */
class Convertor_Service extends Convertor_Base
{

    /**
     * @var array
     */
    protected $statusArray = array();

    /**
     * @var array
     */
    protected $orderStatusArray = array();

    public function __construct()
    {
        parent::__construct();
        $this->statusArray = array(
            0 => Enum_Lang::getPageText('service', 'disable'),
            1 => Enum_Lang::getPageText('service', 'enable'),
        );

        $this->orderStatusArray = array(
            1 => Enum_Lang::getPageText('service', 'open'),
            2 => Enum_Lang::getPageText('service', 'processing'),
            3 => Enum_Lang::getPageText('service', 'finish'),
        );
    }

    /**
     * Convert position list
     *
     * @param $list
     * @param null $model
     * @return array
     */
    public function positionListConvertor($list, $model = null)
    {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            foreach ($result['list'] as $key => $value) {
                $dataTemp = array();
                $dataTemp['id'] = $value['id'];
                $dataTemp['position'] = htmlentities($value['position']);
                $dataTemp['robot_position'] = htmlentities($value['robot_position']);
                $dataTemp['type'] = $value['type'];
                if ($model instanceof RobotModel) {
                    $dataTemp['typename'] = $model->getPositionTypeList()[$dataTemp['type']];
                }
                $tmp[] = $dataTemp;

            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }

    /**
     * @param $list
     */
    public function taskCategoryConvertor($list)
    {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );

        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            foreach ($result['list'] as $key => $value) {
                $item = array();
                $item['id'] = $value['id'];
                $item['titleLang1'] = $value['title_lang1'];
                $item['titleLang2'] = $value['title_lang2'];
                $item['titleLang3'] = $value['title_lang3'];
                $item['pic'] = Enum_Img::getPathByKeyAndType($value['pic']);
                $item['parentId'] = $value['parentid'];
                $tmp[] = $item;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }

    /**
     * Convert task category list to tree structure
     *
     * @param array $data
     * @return array
     */
    public function taskCategoryFilter(array $data): array
    {
        $bucket = array();
        if ($data['code'] == 0) {
            $list = $data['data']['list'];
            foreach ($list as $item) {
                $bucket[$item['parentid']][] = $item;
            }
            if (is_array($bucket[0])) {
                foreach ($bucket[0] as &$parent) {
                    $parent['subCategory'] = $bucket[$parent['id']];
                }
            }
        }
        return isset($bucket[0]) ? $bucket[0] : array();

    }

    public function taskListConvertor($list)
    {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );

        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            foreach ($result['list'] as $key => $value) {
                $item = array();
                $item['id'] = $value['id'];
                $item['titleLang1'] = $value['title_lang1'];
                $item['titleLang2'] = $value['title_lang2'];
                $item['titleLang3'] = $value['title_lang3'];
                $item['price'] = $value['price'];
                $item['pic'] = Enum_Img::getPathByKeyAndType($value['pic']);;
                $item['category_id'] = $value['category_id'];
                $item['category_title1'] = $value['category_title1'];
                $item['category_title2'] = $value['category_title2'];
                $item['status'] = $value['status'];
                $item['statusShow'] = $this->statusArray[$value['status']];
                $item['process_info'] = $value['process_info'];
                $tmp[] = $item;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            if ($result['limit'] > 0) {
                $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
            }
        }
        return $data;
    }

    public function taskOrderListConvertor($list)
    {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );

        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            foreach ($result['list'] as $key => $value) {
                $item = array();
                $item['id'] = $value['id'];
                $item['room_no'] = $value['room_no'];
                $item['taskTitleLang1'] = $value['tasks_title_lang1'];
                $item['taskTitleLang2'] = $value['tasks_title_lang2'];
                $item['taskTitleLang3'] = $value['tasks_title_lang3'];

                $item['count'] = $value['count'];
                $item['price'] = $value['price'];
                $item['pic'] = Enum_Img::getPathByKeyAndType($value['tasks_pic']);

                $item['created_at'] = $value['created_at'];
                $item['updated_at'] = $value['updated_at'];
                $item['delay'] = $value['delay'];
                $item['memo'] = $value['memo'];
                $item['status'] = $value['status'];
                $item['statusShow'] = $this->orderStatusArray[$value['status']];

                $item['admin_id'] = $value['admin_id'];
                $item['admin_name'] = $value['admin_name'];

                $tmp[] = $item;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            if ($result['limit'] > 0) {
                $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
            }
        }
        return $data;
    }


}