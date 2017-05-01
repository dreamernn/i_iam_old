<?php

class Convertor_Room extends Convertor_Base {

    public function roomResListConvertor($list) {
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
                $dataTemp['icon'] = $value['icon'];
                $dataTemp['nameLang1'] = $value['name_lang1'];
                $dataTemp['nameLang2'] = $value['name_lang2'];
                $dataTemp['nameLang3'] = $value['name_lang3'];
                $dataTemp['pdf'] = Enum_Img::getPathByKeyAndType($value['pdf']);
                $dataTemp['introductLang1'] = $value['introduct_lang1'];
                $dataTemp['introductLang2'] = $value['introduct_lang2'];
                $dataTemp['introductLang3'] = $value['introduct_lang3'];
                $dataTemp['detailLang1'] = $value['detail_lang1'];
                $dataTemp['detailLang2'] = $value['detail_lang2'];
                $dataTemp['detailLang3'] = $value['detail_lang3'];
                $dataTemp['status'] = $value['status'];
                $dataTemp['statusShow'] = $value['status'] ? Enum_Lang::getPageText('room', 'enable') : Enum_Lang::getPageText('room', 'disable');
                $tmp[] = $dataTemp;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }

    public function roomTypeListConvertor($list) {
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
                $dataTemp['titleLang1'] = $value['title_lang1'];
                $dataTemp['titleLang2'] = $value['title_lang2'];
                $dataTemp['titleLang3'] = $value['title_lang3'];
                $dataTemp['size'] = $value['size'];
                $dataTemp['detailLang1'] = $value['detail_lang1'];
                $dataTemp['detailLang2'] = $value['detail_lang2'];
                $dataTemp['detailLang3'] = $value['detail_lang3'];
                $dataTemp['panoramic'] = $value['panoramic'];
                $dataTemp['bedtypeLang1'] = $value['bedtype_lang1'];
                $dataTemp['bedtypeLang2'] = $value['bedtype_lang2'];
                $dataTemp['bedtypeLang3'] = $value['bedtype_lang3'];
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
                $dataTemp['residList'] = $value['resid_list'];
                $tmp[] = $dataTemp;
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