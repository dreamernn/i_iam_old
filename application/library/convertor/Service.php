<?php

/**
 * Class Convertor_Service
 */
class Convertor_Service extends Convertor_Base
{

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
    public function taskCategoryConvertor($list){
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

}

?>