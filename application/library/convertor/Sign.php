<?php

/**
 * Class Convertor_Sign
 */
class Convertor_Sign extends Convertor_Base
{
    private $_statusArray;

    public function __construct()
    {
        parent::__construct();
        $this->_statusArray = array(
            0 => Enum_Lang::getPageText('service', 'enable'),
            1 => Enum_Lang::getPageText('service', 'disable'),
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
    public function signCategoryConvertor($list)
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
                $item['pic'] = $value['pic'];
                $item['status'] = $value['status'];
                $item['statusShow'] = $this->_statusArray[$value['status']];
                $tmp[] = $item;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }

    public function signItemListConvertor($list)
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

                $item['status'] = $value['status'];
                $item['statusShow'] = $this->_statusArray[$value['status']];

                $item['categoryid'] = $value['category_id'];
                $item['categoryLang1'] = $value['category_name1'];
                $item['categoryLang2'] = $value['category_name2'];
                $item['categoryLang3'] = $value['category_name3'];

                $tmp[] = $item;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }


}