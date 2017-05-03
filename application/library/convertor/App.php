<?php

class Convertor_App extends Convertor_Base {

    public function pushListConvertor($list) {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            $baseModel = new BaseModel();
            $platformList = $baseModel->getPlatformList();
            foreach ($result['list'] as $key => $value) {
                $dataTemp = array();
                $dataTemp['id'] = $value['id'];
                $dataTemp['type'] = $value['type'];
                $dataTemp['dataid'] = $value['dataid'];
                $dataTemp['cn_title'] = $value['cn_title'];
                $dataTemp['en_title'] = $value['en_title'];
                $dataTemp['url'] = $value['url'];
                $dataTemp['result'] = $value['result'];
                $dataTemp['resultShow'] = $value['result'] ? Enum_Lang::getPageText('app', 'resultFail') : Enum_Lang::getPageText('app', 'resultSuccess');
                $dataTemp['platform'] = $value['platform'];
                $dataTemp['platformShow'] = $platformList[$dataTemp['platform']];
                $dataTemp['createtime'] = $value['createtime'] ? date('Y-m-d H:i:s', $value['createtime']) : '';
                $tmp[] = $dataTemp;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }

    public function shortcutListConvertor($list) {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $tmp = array();
            $baseModel = new BaseModel();
            $platformList = $baseModel->getPlatformList();
            foreach ($result['list'] as $key => $value) {
                $dataTemp = array();
                $dataTemp['id'] = $value['id'];
                $dataTemp['key'] = $value['key'];
                $dataTemp['titleLang1'] = $value['title_lang1'];
                $dataTemp['titleLang2'] = $value['title_lang2'];
                $dataTemp['titleLang3'] = $value['title_lang3'];
                $dataTemp['sort'] = $value['sort'];
                $tmp[] = $dataTemp;
            }
            $data['data']['list'] = $tmp;
            $data['data']['pageData']['page'] = intval($result['page']);
            $data['data']['pageData']['rowNum'] = intval($result['total']);
            $data['data']['pageData']['pageNum'] = ceil($result['total'] / $result['limit']);
        }
        return $data;
    }

    public function shareListConvertor($list) {
        $data = array(
            'code' => intval($list['code']),
            'msg' => $list['msg']
        );
        if (isset($list['code']) && !$list['code']) {
            $result = $list['data'];
            $enableTmp = array();
            $disableTmp = array();
            $enableShare = array_column($result['list'], 'key');
            $shareName = Enum_App::getShareNameKeyList();
            foreach ($shareName as $shareKey) {
                $shareInfo = array('key' => $shareKey, 'title' => Enum_Lang::getPageText('share', $shareKey));
                in_array($shareKey, $enableShare) ? $enableTmp[] = $shareInfo : $disableTmp[] = $shareInfo;
            }
            $data['data'] = array(
                'enable' => $enableTmp,
                'disable' => $disableTmp,
            );
        }
        return $data;
    }
}

?>